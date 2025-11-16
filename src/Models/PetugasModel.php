<?php

namespace Arya\SistemPerpustakaan\Models;

use Arya\SistemPerpustakaan\Core\Model;

class PetugasModel extends Model {
    private $table = 'PETUGAS';
    
    public function getAll() {
        try {
            $sql = "SELECT * FROM {$this->table} ORDER BY Nama_Petugas";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Return empty array if there's an error
            return [];
        }
    }
    
    public function getById($id) {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE ID_Petugas = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Return null if there's an error
            return null;
        }
    }
    
    public function getByIdWithAnggotaData($id) {
        try {
            // This would require joining with the AKUN_LOGIN and ANGGOTA tables
            // For now, we'll return the basic petugas data
            // In a real implementation, we would need to join with the related Anggota data
            $sql = "SELECT p.*, a.Tgl_Lahir, a.No_Telp FROM {$this->table} p 
                    LEFT JOIN AKUN_LOGIN al ON p.ID_Petugas = al.ID_Petugas 
                    LEFT JOIN ANGGOTA a ON al.ID_Anggota = a.ID_Anggota 
                    WHERE p.ID_Petugas = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Return null if there's an error
            return null;
        }
    }
    
    public function getAllWithAnggotaData() {
        try {
            // This would require joining with the AKUN_LOGIN and ANGGOTA tables
            // For now, we'll return the basic petugas data
            // In a real implementation, we would need to join with the related Anggota data
            $sql = "SELECT p.*, a.Tgl_Lahir, a.No_Telp FROM {$this->table} p 
                    LEFT JOIN AKUN_LOGIN al ON p.ID_Petugas = al.ID_Petugas 
                    LEFT JOIN ANGGOTA a ON al.ID_Anggota = a.ID_Anggota 
                    ORDER BY p.Nama_Petugas";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Return empty array if there's an error
            return [];
        }
    }
    
    public function create($data) {
        try {
            $sql = "INSERT INTO {$this->table} (Nama_Petugas, Jabatan) VALUES (:nama, :jabatan)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'nama' => $data['Nama_Petugas'],
                'jabatan' => $data['Jabatan']
            ]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    public function update($id, $data) {
        try {
            $sql = "UPDATE {$this->table} SET Nama_Petugas = :nama, Jabatan = :jabatan WHERE ID_Petugas = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'nama' => $data['Nama_Petugas'],
                'jabatan' => $data['Jabatan'],
                'id' => $id
            ]);
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    public function updateAnggotaData($id_petugas, $anggotaData) {
        try {
            // First, get the ID_Anggota associated with this petugas through AKUN_LOGIN
            $sql = "SELECT al.ID_Anggota FROM AKUN_LOGIN al WHERE al.ID_Petugas = :id_petugas";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id_petugas' => $id_petugas]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$result) {
                return false;
            }
            
            $id_anggota = $result['ID_Anggota'];
            
            // Update the Anggota data
            $anggotaModel = new AnggotaModel();
            return $anggotaModel->update($id_anggota, $anggotaData);
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    public function delete($id) {
        try {
            $sql = "DELETE FROM {$this->table} WHERE ID_Petugas = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
}