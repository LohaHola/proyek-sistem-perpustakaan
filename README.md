# 📚 Sistem Manajemen Perpustakaan

<p align="center">
  <img src="public/assets/logo..webp" alt="Logo Perpustakaan" width="200">
</p>

<p align="center">
  <a href="#-fitur-utama"><img src="https://img.shields.io/badge/Features-List-blue"></a>
  <a href="#-teknologi-yang-digunakan"><img src="https://img.shields.io/badge/Tech-Stack-green"></a>
  <a href="#-instalasi"><img src="https://img.shields.io/badge/Setup-Guide-orange"></a>
  <a href="https://github.com/LohaHola/proyek-sistem-perpustakaan"><img src="https://img.shields.io/badge/GitHub-Repository-lightgrey"></a>
</p>

## 📖 Daftar Isi

- [Deskripsi Proyek](#-deskripsi-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Struktur Database](#-struktur-database)
- [Instalasi](#-instalasi)
- [Struktur Direktori](#-struktur-direktori)
- [Routing](#-routing)
- [Lisensi](#-lisensi)

---

## 📝 Deskripsi Proyek

**Sistem Manajemen Perpustakaan** adalah aplikasi berbasis web yang dikembangkan dengan arsitektur MVC menggunakan PHP. Sistem ini dirancang untuk memudahkan pengelolaan perpustakaan, mulai dari manajemen inventaris hingga transaksi peminjaman dan pengembalian buku.

🔗 **Demo Aplikasi**: [https://proyeksistempustaka.infinityfreeapp.com/](https://proyeksistempustaka.infinityfreeapp.com/)

---

## 🌟 Fitur Utama

### 1. **Manajemen Inventaris Ganda**
- Memisahkan data Master Karya (Judul) dari Inventaris Fisik (Eksemplar)
- Menjamin akurasi stok dan mempermudah pelacakan buku

### 2. **Otomasi Transaksi**
- Peminjaman buku dengan sistem antrian
- Pengembalian buku otomatis
- Perhitungan denda berdasarkan tanggal jatuh tempo

### 3. **Layanan Publik & Analisis Kunjungan**
- Pencarian katalog untuk non-anggota
- Pencatatan kunjungan dan tujuan kunjungan
- Statistik pengunjung harian/bulanan

### 4. **Kontrol Akses Berbasis Peran**
- Tiga peran pengguna: Anggota, Petugas, dan Admin
- Otorisasi fungsionalitas berdasarkan peran
- Sistem autentikasi yang aman

---

## 💻 Teknologi yang Digunakan

| Komponen | Teknologi |
|---------|-----------|
| **Backend** | PHP 8.0+ |
| **Frontend** | Bootstrap 5, HTML5, CSS3 |
| **Database** | MySQL |
| **Arsitektur** | MVC (Model-View-Controller) |
| **Autoloading** | PSR-4 Standard |
| **Dependency Management** | Composer |

---

## 🗃️ Struktur Database

Sistem ini menggunakan 12 tabel utama:

1. `KATEGORI` - Menyimpan kategori buku
2. `PENERBIT` - Data penerbit buku
3. `PENGARANG` - Informasi pengarang
4. `BUKU` - Data master buku
5. `PENULISAN` - Relasi antara buku dan pengarang
6. `EKSEMPLAR` - Inventaris fisik buku
7. `ANGGOTA` - Data anggota perpustakaan
8. `PETUGAS` - Data petugas perpustakaan
9. `AKUN_LOGIN` - Informasi autentikasi pengguna
10. `LOG_KUNJUNGAN` - Riwayat kunjungan
11. `TRANSAKSI_PEMINJAMAN` - Transaksi peminjaman
12. `DENDA` - Catatan denda

---

## ⚙️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan sistem secara lokal:

### Prasyarat
- PHP 8.0+
- MySQL Server
- Web Server (Apache/Nginx)
- Composer

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/LohaHola/proyek-sistem-perpustakaan.git
   cd proyek-sistem-perpustakaan
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   - Buat database baru di MySQL
   - Import file SQL: `src/db/if0_40428442_perpustakaan.sql`
   - Konfigurasi koneksi database di `src/Config/Database.php`

4. **Jalankan Aplikasi**
   - Pastikan web server sudah berjalan
   - Akses aplikasi melalui browser

---

## 📁 Struktur Direktori

```
APSI_SistemPerpustakaan/
├── src/
│   ├── Config/           # Konfigurasi database
│   ├── Controllers/      # Kontrol alur aplikasi
│   ├── Core/             # Base class dan router
│   ├── Models/           # Logika bisnis dan database
│   ├── Views/            # Tampilan antarmuka pengguna
│   └── db/               # File SQL database
├── public/
│   ├── assets/           # Gambar, CSS, dan file statis
│   ├── index.php         # Entry point aplikasi
│   └── logout.php        # Handler logout
├── vendor/               # Package dari Composer
├── composer.json         # Konfigurasi Composer
└── README.md             # Dokumentasi proyek
```

---

## 🔄 Routing

Sistem menggunakan routing berbasis `.htaccess` dengan struktur URL:
```
/controller/method/parameters
```

Contoh:
- `/auth/login` → Halaman login
- `/dashboard/index` → Dashboard utama
- `/buku/detail/123` → Detail buku dengan ID 123

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan pembelajaran dan portofolio.

---

<p align="center">
  Developed with ❤️ | Sistem Perpustakaan © 2025
</p>