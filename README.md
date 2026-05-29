# E-TIXIS - Web Ticketing System

E-TIXIS adalah aplikasi web ticketing berbasis Laravel yang dibuat untuk membantu proses pengelolaan event, pemesanan tiket, dan validasi tiket secara digital. Project ini dikembangkan sebagai implementasi pengembangan aplikasi web berbasis database dan dapat dijalankan secara lokal/offline.

## Fitur Utama

* Autentikasi pengguna melalui login dan register
* Role pengguna: admin, user, dan petugas
* Admin dapat mengelola data event
* User dapat melihat event dan melakukan pemesanan tiket
* Sistem menghasilkan tiket dengan kode unik
* Petugas dapat melakukan validasi tiket
* Data tersimpan dan dikelola menggunakan database MySQL

## Teknologi yang Digunakan

* Laravel
* PHP
* MySQL
* Blade Template
* HTML
* CSS
* JavaScript
* Laragon
* Visual Studio Code
* phpMyAdmin

## Role Pengguna

### Admin

Admin memiliki akses untuk mengelola data event, melihat data pemesanan, dan mengatur kebutuhan utama pada sistem.

### User

User dapat melihat daftar event, melakukan pemesanan tiket, dan melihat tiket yang telah dipesan.

### Petugas

Petugas memiliki akses untuk melakukan validasi tiket berdasarkan kode tiket yang dimiliki oleh user.

## Struktur Fitur

```text
Login / Register
        |
        v
Dashboard
        |
        |-- Admin   -> Kelola Event
        |-- User    -> Lihat Event, Pesan Tiket, Tiket Saya
        |-- Petugas -> Validasi Tiket
```

## Cara Menjalankan Project

1. Clone repository ini:

```bash
git clone https://github.com/Aldo233/e-tixis.git
```

2. Masuk ke folder project:

```bash
cd e-tixis
```

3. Install dependency Laravel:

```bash
composer install
```

4. Install dependency frontend:

```bash
npm install
```

5. Salin file `.env.example` menjadi `.env`.

```bash
copy .env.example .env
```

6. Atur konfigurasi database pada file `.env`, contoh:

```env
DB_DATABASE=e_tixis
DB_USERNAME=root
DB_PASSWORD=
```

7. Generate application key:

```bash
php artisan key:generate
```

8. Jalankan migration:

```bash
php artisan migrate
```

9. Jalankan server Laravel:

```bash
php artisan serve
```

10. Jalankan Vite:

```bash
npm run dev
```

11. Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## Status Project

Project ini sudah dapat dijalankan secara lokal/offline dan memiliki fitur utama untuk pengelolaan event, pemesanan tiket, serta validasi tiket.

## Tampilan Aplikasi

### Halaman Login
![Halaman Login](screenshots/login-etixis.png)

### Beranda
![Beranda E-TIXIS](screenshots/beranda-etixis.png)

### Daftar Event
![Daftar Event](screenshots/daftarevent-etixis.png)

### Kelola Event
![Kelola Event](screenshots/kelolaevent-etixis.png)

### Scan Tiket
![Scan Tiket](screenshots/scanticket.png)

## Catatan

Project ini masih dapat dikembangkan lebih lanjut, seperti menambahkan fitur pembayaran, scan QR code, dashboard statistik, dan deployment ke hosting agar dapat diakses secara online.

## Developer

Aldo Riyantama, Delvina Nurahmatika, Aisha Indha Fajrani
Mahasiswa Teknik Informatika
Universitas Lampung
GitHub: [Aldo233](https://github.com/Aldo233)
