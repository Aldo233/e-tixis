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

    public function check(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required'
        ]);

        $ticket = Ticket::where('kode_unik', $request->kode_unik)->first();

        if (!$ticket) {
            return back()->with('error', 'Tiket tidak ditemukan atau palsu.');
        }

        if ($ticket->status_tiket == 'used') {
            return back()->with('error', 'Tiket sudah digunakan sebelumnya.');
        }

        $ticket->update([
            'status_tiket' => 'used'
        ]);

        return back()->with('success', 'Tiket valid. Pengguna boleh masuk.');
    }
}