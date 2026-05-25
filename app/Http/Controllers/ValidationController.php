<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index()
    {
        return view('validation.index');
    }

    // Validasi tiket secara manual
    public function check(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required'
        ]);

        $kodeUnik = strtoupper(trim($request->kode_unik));

        $ticket = Ticket::with(['order.event', 'order.user'])
            ->where('kode_unik', $kodeUnik)
            ->first();

        if (!$ticket) {
            return back()->with('error', 'Tiket tidak ditemukan atau kode tiket palsu.');
        }

        if ($ticket->status_tiket === 'used') {
            return back()->with('error', 'Tiket dengan kode ' . $ticket->kode_unik . ' sudah pernah digunakan.');
        }

        $ticket->update([
            'status_tiket' => 'used'
        ]);

        return back()->with('success', 'Tiket valid. Pengguna boleh masuk. Kode tiket: ' . $ticket->kode_unik);
    }

    // Halaman scan QR Code
    public function scan()
    {
        return view('validation.scan');
    }

    // Validasi tiket dari hasil scan QR Code
    public function scanCheck(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required'
        ]);

        $kodeUnik = strtoupper(trim($request->kode_unik));

        $ticket = Ticket::with(['order.event', 'order.user'])
            ->where('kode_unik', $kodeUnik)
            ->first();

        if (!$ticket) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket tidak ditemukan atau kode tiket palsu.',
                'kode' => $kodeUnik
            ]);
        }

        if ($ticket->status_tiket === 'used') {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket sudah digunakan sebelumnya.',
                'kode' => $ticket->kode_unik,
                'status_tiket' => $ticket->status_tiket,
                'event' => $ticket->order->event->nama_event ?? '-',
            ]);
        }

        $ticket->update([
            'status_tiket' => 'used'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tiket valid. Pengguna boleh masuk.',
            'kode' => $ticket->kode_unik,
            'status_tiket' => 'used',
            'event' => $ticket->order->event->nama_event ?? '-',
            'tanggal' => $ticket->order->event->tanggal ?? '-',
            'lokasi' => $ticket->order->event->lokasi ?? '-',
            'pemilik' => $ticket->order->user->name ?? '-',
        ]);
    }
}