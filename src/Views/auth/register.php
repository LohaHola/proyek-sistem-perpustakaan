<?php
$title = 'Register - Sistem Perpustakaan';
ob_start();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-white">Registrasi Akun</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="/register" method="POST" class="register-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                            <div class="form-text">Password minimal 6 karakter</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="anggota">Anggota</option>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        
                        <!-- Member information (required for all users) -->
                        <div class="mb-3">
                            <label for="nama_anggota" class="form-label">Nama Lengkap (Anggota)</label>
                            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon">
                        </div>
                        
                        <!-- Additional fields for Petugas/Admin -->
                        <div id="staff-fields" style="display: none;">
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan (Petugas/Admin)</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan jabatan">
                                <div class="form-text">Untuk petugas dan administrator</div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const staffFields = document.getElementById('staff-fields');
    
    roleSelect.addEventListener('change', function() {
        // Hide staff fields by default
        staffFields.style.display = 'none';
        
        // Show staff fields for petugas and admin roles
        if (this.value === 'petugas' || this.value === 'admin') {
            staffFields.style.display = 'block';
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/master.php';
?>