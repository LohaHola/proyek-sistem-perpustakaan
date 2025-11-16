<?php
// Pastikan session sudah dimulai sebelumnya
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil data role dari session login
$role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : 'guest'; 
$username = isset($_SESSION['user']) ? $_SESSION['user']['username'] : 'User';
?>
<header class="main-header">
    <div class="header-top">
        <div class="logo-area">
            <img src="/assets/logo.png" class="logo">
        </div>

        <div class="search-area">
            <form action="/cari" method="GET" class="d-flex">
                <input type="text" name="q" placeholder="Cari judul buku..." class="search-input" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                <button type="submit" class="search-btn">🔍</button>
            </form>
        </div>

        <div class="profile-area">
            <span class="username"><?php echo htmlspecialchars($username); ?></span>
            <a href="/profil/edit" class="profile-icon">
                <img src="/assets/profile_icon.png">
            </a>
            <a href="/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <nav class="nav-menu">
        <!-- MENU UNTUK SEMUA (anggota, petugas, admin) -->
        <a href="/dashboard">Dashboard</a>
        <a href="/cari">Lihat Buku</a>
        <a href="/pinjaman/riwayat">Riwayat Pinjaman</a>
        <a href="/pinjaman/aktif">Pinjaman Aktif</a>

        <!-- MENU UNTUK PETUGAS DAN ADMIN -->
        <?php if ($role === 'petugas' || $role === 'admin'): ?>
            <a href="/eksemplar">Kelola Data Eksemplar</a>
            <a href="/anggota">Kelola Data Anggota</a>
        <?php endif; ?>

        <!-- MENU KHUSUS ADMIN -->
        <?php if ($role === 'admin'): ?>
            <a href="/staff">Kelola Data Staff</a>
            <a href="/bibliografi">Kelola Master Bibliografi</a>
            <a href="/kunjungan">Log Kunjungan</a>
        <?php endif; ?>
    </nav>
</header>