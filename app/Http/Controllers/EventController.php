<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    'deskripsi' => 'nullable|string',
    'kuota' => 'required|integer|min:1',
    'harga' => 'required|integer|min:0',
    'gambar_event' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
]);

        $gambarPath = null;

        if ($request->hasFile('gambar_event')) {
            $gambarPath = $request->file('gambar_event')->store('event-images', 'public');
        }

        Event::create([
    'nama_event' => $request->nama_event,
    'tanggal' => $request->tanggal,
    'lokasi' => $request->lokasi,
    'deskripsi' => $request->deskripsi,
    'kuota' => $request->kuota,
    'harga' => $request->harga,
    'gambar_event' => $gambarPath,
]);

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
    'deskripsi' => 'nullable|string',
    'kuota' => 'required|integer|min:1',
    'harga' => 'required|integer|min:0',
    'gambar_event' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
]);

        $gambarPath = $event->gambar_event;

        if ($request->hasFile('gambar_event')) {
            if ($event->gambar_event) {
                Storage::disk('public')->delete($event->gambar_event);
            }

            $gambarPath = $request->file('gambar_event')->store('event-images', 'public');
        }

       $event->update([
    'nama_event' => $request->nama_event,
    'tanggal' => $request->tanggal,
    'lokasi' => $request->lokasi,
    'deskripsi' => $request->deskripsi,
    'kuota' => $request->kuota,
    'harga' => $request->harga,
    'gambar_event' => $gambarPath,
]);
        return redirect('/events')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->gambar_event) {
            Storage::disk('public')->delete($event->gambar_event);
        }

        $event->delete();

        return redirect('/events')->with('success', 'Event berhasil dihapus.');
    }
}