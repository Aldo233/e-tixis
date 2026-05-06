<h1>Edit Event</h1>

<form action="/events/{{ $event->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Event</label><br>
    <input type="text" name="nama_event" value="{{ $event->nama_event }}"><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="{{ $event->tanggal }}"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi" value="{{ $event->lokasi }}"><br><br>

    <label>Kuota</label><br>
    <input type="number" name="kuota" value="{{ $event->kuota }}"><br><br>

    <button type="submit">Update</button>
</form>

<br>

<a href="/events">Kembali</a>