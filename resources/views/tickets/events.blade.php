<h1>Daftar Event Tersedia</h1>

<a href="/dashboard">Dashboard</a> |
<a href="/tiket-saya">Tiket Saya</a>

<br><br>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Event</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Kuota</th>
        <th>Aksi</th>
    </tr>

    @foreach($events as $event)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $event->nama_event }}</td>
        <td>{{ $event->tanggal }}</td>
        <td>{{ $event->lokasi }}</td>
        <td>{{ $event->kuota }}</td>
        <td>
            <a href="/pesan-tiket/{{ $event->id }}">Pesan Tiket</a>
        </td>
    </tr>
    @endforeach
</table>