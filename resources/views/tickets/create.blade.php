<h1>Pesan Tiket</h1>

<h2>{{ $event->nama_event }}</h2>
<p>Tanggal: {{ $event->tanggal }}</p>
<p>Lokasi: {{ $event->lokasi }}</p>
<p>Kuota: {{ $event->kuota }}</p>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="/pesan-tiket/{{ $event->id }}" method="POST">
    @csrf

    <label>Jumlah Tiket</label><br>
    <input type="number" name="jumlah_tiket" min="1" max="{{ $event->kuota }}" required><br><br>

    <button type="submit">Pesan Tiket</button>
</form>

<br>

<a href="/daftar-event">Kembali</a>