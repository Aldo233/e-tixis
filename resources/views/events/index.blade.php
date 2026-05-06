<h1>Daftar Event E-TIXIS</h1>

<a href="/events/create">Tambah Event</a>
<a href="/tiket-saya">Tiket Saya</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
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
            <a href="/events/{{ $event->id }}/edit">Edit</a>

            <form action="/events/{{ $event->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus event ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>