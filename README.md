# Sistem Perpustakaan

Sistem Manajemen Perpustakaan berbasis web dengan arsitektur MVC menggunakan PHP.

## Teknologi yang Digunakan

- **Backend**: PHP 8.0+
- **Frontend**: Bootstrap 5, HTML5, CSS3
- **Database**: MySQL
- **Arsitektur**: MVC (Model-View-Controller)
- **Autoloading**: PSR-4 Standard
- **Dependency Management**: Composer

## Fitur Utama

1. **Manajemen Inventaris Ganda**
   - Memisahkan data Master Karya (Judul) dari Inventaris Fisik (Eksemplar)
   - Menjamin akurasi stok

2. **Otomasi Transaksi**
   - Peminjaman buku
   - Pengembalian buku
   - Perhitungan denda berdasarkan tanggal jatuh tempo

3. **Layanan Publik & Analisis Kunjungan**
   - Pencarian katalog untuk non-anggota
   - Pencatatan kunjungan dan tujuan kunjungan

4. **Kontrol Akses Berbasis Peran**
   - Tiga peran pengguna: Anggota, Petugas, dan Admin
   - Otorisasi fungsionalitas berdasarkan peran

## Struktur Database

Sistem ini menggunakan 12 tabel utama:

1. KATEGORI
2. PENERBIT
3. PENGARANG
4. BUKU
5. PENULISAN
6. EKSEMPLAR
7. ANGGOTA
8. PETUGAS
9. AKUN_LOGIN
10. LOG_KUNJUNGAN
11. TRANSAKSI_PEMINJAMAN
12. DENDA

## Instalasi

1. Clone repository ini
2. Jalankan `composer install` untuk menginstal dependensi
3. Buat database MySQL
4. Jalankan script SQL di `database/create_tables_mariadb.sql`
5. Konfigurasi koneksi database di `src/Core/Model.php`
6. Jalankan aplikasi melalui web server

## Struktur Direktori

```
APSI_SistemPerpustakaan/
├── src/
│   ├── Controllers/
│   ├── Core/
│   ├── Models/
│   └── Views/
├── public/
│   ├── assets/
│   └── index.php
├── database/
└── vendor/
```

## Routing

Sistem menggunakan routing berbasis `.htaccess` dengan struktur URL:
- `/controller/method/parameters`

## Lisensi

Proyek ini dikembangkan untuk keperluan pembelajaran dan portofolio.