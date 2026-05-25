<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function events()
    {
        $events = Event::latest()->get();

        return view('tickets.events', compact('events'));
    }

    public function eventList()
    {
        $events = Event::latest()->get();

        return view('tickets.events', compact('events'));
    }

    public function create(Event $event)
    {
        return view('tickets.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        // Cek apakah kuota masih cukup
        if ($request->jumlah_tiket > $event->kuota) {
            return back()->with('error', 'Kuota tidak mencukupi.');
        }

        // Membuat data pemesanan
        $order = Order::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'tanggal_pesan' => now(),
            'status' => 'paid',
        ]);

        // Membuat tiket sesuai jumlah yang dipesan
        for ($i = 1; $i <= $request->jumlah_tiket; $i++) {
            Ticket::create([
                'order_id' => $order->id,
                'kode_unik' => 'ETX-' . strtoupper(Str::random(8)),
                'status_tiket' => 'valid',
            ]);
        }

        // Mengurangi kuota event
        $event->kuota -= $request->jumlah_tiket;
        $event->save();

        return redirect('/tiket-saya')->with('success', 'Tiket berhasil dipesan. Silakan lihat tiket kamu di sini.');
    }

    public function myTickets()
    {
        $orders = Order::with(['event', 'tickets'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('tickets.my', compact('orders'));
    }
}