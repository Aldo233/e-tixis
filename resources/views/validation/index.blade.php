<h1>Validasi Tiket E-TIXIS</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="/validasi-tiket" method="POST">
    @csrf

    <label>Masukkan Kode Tiket</label><br>
    <input type="text" name="kode_unik" placeholder="Contoh: ETX-ABC12345" required><br><br>

    <button type="submit">Validasi Tiket</button>
</form>

<br>

<a href="/dashboard">Kembali Ke Dashboard</a>