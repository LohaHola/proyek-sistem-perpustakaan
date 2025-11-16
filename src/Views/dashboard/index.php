<?php
$title = 'Dashboard - Sistem Perpustakaan';
ob_start();
?>

<div class="container mt-4">
    <h3>📚 Daftar Buku Master</h3>
    
    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Buku</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Inventaris</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($books) && is_array($books)): ?>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($book['ID_Buku'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($book['Judul'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($book['Nama_Pengarang'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($book['Nama_Penerbit'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($book['Tahun_Terbit'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($book['Nama_Kategori'] ?? ''); ?></td>
                                    <td>
                                        <span class="badge bg-success">Tersedia: <?php echo $book['available_inventory'] ?? 0; ?></span>
                                        <span class="badge bg-warning">Dipinjam: <?php echo $book['borrowed_inventory'] ?? 0; ?></span>
                                        <span class="badge bg-primary">Total: <?php echo $book['total_inventory'] ?? 0; ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data buku</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/master.php';
?>