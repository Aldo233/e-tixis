<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'kuota' => 'required|integer',
        ]);

        Event::create($request->only([
            'nama_event',
            'tanggal',
            'lokasi',
            'kuota',
        ]));

        return redirect('/events')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
{
    return view('events.edit', compact('event'));
}

public function update(Request $request, Event $event)
{
    $request->validate([
        'nama_event' => 'required',
        'tanggal' => 'required|date',
        'lokasi' => 'required',
        'kuota' => 'required|integer',
    ]);

    $event->update($request->only([
        'nama_event',
        'tanggal',
        'lokasi',
        'kuota',
    ]));

    return redirect('/events')->with('success', 'Event berhasil diperbarui.');
}

public function destroy(Event $event)
{
    $event->delete();

    return redirect('/events')->with('success', 'Event berhasil dihapus.');
}
}