<h1>Tiket Saya</h1>

@foreach($orders as $order)
    <h3>{{ $order->event->nama_event }}</h3>
    <p>Tanggal: {{ $order->event->tanggal }}</p>
    <p>Lokasi: {{ $order->event->lokasi }}</p>

    <ul>
        @foreach($order->tickets as $ticket)
            <li>
                Kode: {{ $ticket->kode_unik }} 
                | Status: {{ $ticket->status_tiket }}
            </li>
        @endforeach
    </ul>

    <hr>
@endforeach

<a href="/daftar-event">Kembali</a>