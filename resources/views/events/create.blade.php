<h1>Tambah Event</h1>

<form action="/events" method="POST">
    @csrf

    <label>Nama Event</label><br>
    <input type="text" name="nama_event"><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi"><br><br>

    <label>Kuota</label><br>
    <input type="number" name="kuota"><br><br>

    <button type="submit">Simpan</button>
</form>

<br>

<a href="/events">Kembali</a>