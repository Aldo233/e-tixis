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

    // Validasi manual lama
    public function check(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required'
        ]);

        $ticket = Ticket::where('kode_unik', $request->kode_unik)->first();

        if (!$ticket) {
            return back()->with('error', 'Tiket tidak ditemukan atau palsu.');
        }

        if ($ticket->status_tiket === 'used') {
            return back()->with('error', 'Tiket sudah digunakan sebelumnya.');
        }

        $ticket->update([
            'status_tiket' => 'used'
        ]);

        return back()->with('success', 'Tiket valid. Pengguna boleh masuk.');
    }

    // Halaman scan QR Code
    public function scan()
    {
        return view('validation.scan');
    }

    // Validasi dari hasil scan QR Code
    public function scanCheck(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required'
        ]);

        $ticket = Ticket::where('kode_unik', $request->kode_unik)->first();

        if (!$ticket) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket tidak ditemukan atau palsu.',
                'kode' => $request->kode_unik
            ]);
        }

        if ($ticket->status_tiket === 'used') {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket sudah digunakan sebelumnya.',
                'kode' => $ticket->kode_unik
            ]);
        }

        $ticket->update([
            'status_tiket' => 'used'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tiket valid. Pengguna boleh masuk.',
            'kode' => $ticket->kode_unik
        ]);
    }
}