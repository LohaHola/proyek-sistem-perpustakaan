<?php
$title = 'Peminjaman Buku - Sistem Perpustakaan';
ob_start();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Form Peminjaman Buku</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($bookInfo)): ?>
                        <div class="alert alert-info">
                            <strong>Buku yang akan dipinjam:</strong> <?php echo htmlspecialchars($bookInfo['Judul'] ?? ''); ?>
                            <?php if (isset($bookInfo['Nama_Pengarang'])): ?>
                                oleh <?php echo htmlspecialchars($bookInfo['Nama_Pengarang']); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="/pinjaman/pinjam" method="POST">
                        <?php if (isset($bookId)): ?>
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($bookId); ?>">
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="id_anggota" class="form-label">ID Anggota</label>
                            <input type="number" class="form-control" id="id_anggota" name="id_anggota" 
                                   placeholder="Contoh: 1" required>
                        </div>
                        
                        <?php if (isset($availableEksemplar) && !empty($availableEksemplar)): ?>
                            <div class="mb-3">
                                <label for="id_eksemplar" class="form-label">Pilih Eksemplar</label>
                                <select class="form-control" id="id_eksemplar" name="id_eksemplar" required>
                                    <option value="">-- Pilih Eksemplar --</option>
                                    <?php foreach ($availableEksemplar as $eksemplar): ?>
                                        <option value="<?php echo htmlspecialchars($eksemplar['ID_Eksemplar']); ?>">
                                            <?php echo htmlspecialchars($eksemplar['No_Induk_Inventaris']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text">Terdapat <?php echo count($availableEksemplar); ?> eksemplar yang tersedia untuk buku ini</div>
                            </div>
                            
                            <?php 
                            // Get the first eksemplar for hidden fields
                            $firstEksemplar = reset($availableEksemplar);
                            ?>
                            <input type="hidden" name="id_buku" value="<?php echo htmlspecialchars($firstEksemplar['ID_Buku'] ?? ''); ?>">
                            <input type="hidden" name="no_induk_inventaris" value="<?php echo htmlspecialchars($firstEksemplar['No_Induk_Inventaris'] ?? ''); ?>">
                        <?php else: ?>
                            <div class="mb-3">
                                <label for="id_eksemplar" class="form-label">ID Eksemplar</label>
                                <input type="number" class="form-control" id="id_eksemplar" name="id_eksemplar" 
                                       placeholder="Contoh: 1" required>
                            </div>
                        <?php endif; ?>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/pinjaman/aktif" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">PINJAM BUKU</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/master.php';
?>