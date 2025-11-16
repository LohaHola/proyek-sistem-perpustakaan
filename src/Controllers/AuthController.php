<?php

namespace Arya\SistemPerpustakaan\Controllers;

use Arya\SistemPerpustakaan\Core\Controller;
use Arya\SistemPerpustakaan\Models\AkunLoginModel;
use Arya\SistemPerpustakaan\Models\AnggotaModel;
use Arya\SistemPerpustakaan\Models\PetugasModel;

class AuthController extends Controller {
    public function showLoginForm() {
        // Get any error message from session and clear it
        $error = $this->getSession('login_error');
        $this->setSession('login_error', null);
        
        // Get any success message from session and clear it
        $success = $this->getSession('login_success');
        $this->setSession('login_success', null);
        
        $this->render('auth/login', [
            'title' => 'Login - Sistem Perpustakaan',
            'error' => $error,
            'success' => $success
        ]);
    }
    
    public function login() {
        // Handle login logic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Validate credentials against database
            $akunModel = new AkunLoginModel();
            $user = $akunModel->getByUsername($username);
            
            if ($user && password_verify($password, $user['Password_Hash'])) {
                // Clear any existing error
                $this->setSession('login_error', null);
                $this->setSession('login_success', null);
                
                // Set session data
                $this->setSession('user', [
                    'id' => $user['ID_Akun'],
                    'username' => $user['Username'],
                    'role' => $user['Role'],
                    'id_anggota' => $user['ID_Anggota'],
                    'id_petugas' => $user['ID_Petugas']
                ]);
                
                // Log the login event
                $logController = new LogKunjunganController();
                $logController->logUserLogin($user['ID_Anggota']);
                
                // Redirect back to the original page if it was stored in session
                // Otherwise redirect to dashboard
                $redirectUrl = $this->getSession('redirect_after_login') ?? '/dashboard';
                $this->setSession('redirect_after_login', null);
                $this->redirect($redirectUrl);
            } else {
                // Set error message and redirect back to login
                $this->setSession('login_error', 'Username atau password salah. Silakan coba lagi.');
                $this->redirect('/login');
            }
        } else {
            // If not POST request, show login form
            $this->showLoginForm();
        }
    }
    
    public function logout() {
        // Log the logout event before destroying the session
        $user = $this->getSession('user');
        if ($user) {
            $logController = new LogKunjunganController();
            $logController->logUserLogout($user['id_anggota']);
        }
        
        $this->destroySession();
        $this->redirect('/login');
    }
    
    public function showRegisterForm() {
        // Get any error message from session and clear it
        $error = $this->getSession('register_error');
        $this->setSession('register_error', null);
        
        $this->render('auth/register', [
            'title' => 'Register - Sistem Perpustakaan',
            'error' => $error
        ]);
    }
    
    public function register() {
        // Handle registration logic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? '';
            $nama_anggota = $_POST['nama_anggota'] ?? '';
            $tgl_lahir = $_POST['tgl_lahir'] ?? null;
            $no_telp = $_POST['no_telp'] ?? null;
            $jabatan = $_POST['jabatan'] ?? '';
            
            // Validate input
            if (empty($username) || empty($password) || empty($confirmPassword) || empty($role) || empty($nama_anggota)) {
                $this->setSession('register_error', 'Semua field wajib diisi.');
                $this->redirect('/register');
                return;
            }
            
            if ($password !== $confirmPassword) {
                $this->setSession('register_error', 'Password dan konfirmasi password tidak cocok.');
                $this->redirect('/register');
                return;
            }
            
            if (strlen($password) < 6) {
                $this->setSession('register_error', 'Password minimal 6 karakter.');
                $this->redirect('/register');
                return;
            }
            
            // Check if username already exists
            $akunModel = new AkunLoginModel();
            $existingUser = $akunModel->getByUsername($username);
            if ($existingUser) {
                $this->setSession('register_error', 'Username sudah digunakan. Silakan pilih username lain.');
                $this->redirect('/register');
                return;
            }
            
            // Create new anggota record for all users
            $anggotaModel = new AnggotaModel();
            $anggotaData = [
                'Nama_Anggota' => $nama_anggota,
                'Tgl_Lahir' => $tgl_lahir,
                'No_Telp' => $no_telp,
                'Tanggal_Daftar' => date('Y-m-d')
            ];
            
            $id_anggota = $anggotaModel->create($anggotaData);
            if (!$id_anggota) {
                $this->setSession('register_error', 'Gagal membuat data anggota.');
                $this->redirect('/register');
                return;
            }
            
            // Create petugas record if role is petugas or admin
            $id_petugas = null;
            if ($role === 'petugas' || $role === 'admin') {
                $petugasModel = new PetugasModel();
                $petugasData = [
                    'Nama_Petugas' => $nama_anggota, // Use the same name as anggota
                    'Jabatan' => $jabatan ?: ($role === 'admin' ? 'Administrator' : 'Petugas')
                ];
                
                $id_petugas = $petugasModel->create($petugasData);
                if (!$id_petugas) {
                    // Clean up the anggota record we just created
                    $anggotaModel->delete($id_anggota);
                    $this->setSession('register_error', 'Gagal membuat data petugas.');
                    $this->redirect('/register');
                    return;
                }
            }
            
            // Create account with new structure
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $accountData = [
                'Username' => $username,
                'Password_Hash' => $hashedPassword,
                'Role' => $role,
                'ID_Anggota' => $id_anggota,
                'ID_Petugas' => $id_petugas
            ];
            
            $accountId = $akunModel->createNew($accountData);
            if (!$accountId) {
                // Clean up the records we just created
                $anggotaModel->delete($id_anggota);
                if ($id_petugas) {
                    $petugasModel->delete($id_petugas);
                }
                $this->setSession('register_error', 'Gagal membuat akun.');
                $this->redirect('/register');
                return;
            }
            
            // Registration successful, redirect to login with success message
            $this->setSession('login_success', 'Registrasi berhasil. Silakan login.');
            $this->redirect('/login');
        } else {
            // If not POST request, show registration form
            $this->showRegisterForm();
        }
    }
}