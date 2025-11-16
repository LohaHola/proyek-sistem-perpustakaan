<?php

namespace Arya\SistemPerpustakaan\Models;

use Arya\SistemPerpustakaan\Core\Model;

class AkunLoginModel extends Model {
    private $table = 'AKUN_LOGIN';
    
    public function getAll() {
        try {
            $sql = "SELECT * FROM {$this->table} ORDER BY Username";
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
            $sql = "SELECT * FROM {$this->table} WHERE ID_Akun = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Return null if there's an error
            return null;
        }
    }
    
    public function getByUsername($username) {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE Username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['username' => $username]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Return null if there's an error
            return null;
        }
    }
    
    public function create($data) {
        try {
            $sql = "INSERT INTO {$this->table} (Username, Password_Hash, Role, ID_Terkait) VALUES (:username, :password_hash, :role, :id_terkait)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'username' => $data['Username'],
                'password_hash' => $data['Password_Hash'],
                'role' => $data['Role'],
                'id_terkait' => $data['ID_Terkait']
            ]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    public function createNew($data) {
        try {
            $sql = "INSERT INTO {$this->table} (Username, Password_Hash, Role, ID_Anggota, ID_Petugas) VALUES (:username, :password_hash, :role, :id_anggota, :id_petugas)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'username' => $data['Username'],
                'password_hash' => $data['Password_Hash'],
                'role' => $data['Role'],
                'id_anggota' => $data['ID_Anggota'],
                'id_petugas' => $data['ID_Petugas']
            ]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    public function update($id, $data) {
        try {
            $sql = "UPDATE {$this->table} SET Username = :username, Password_Hash = :password_hash, Role = :role, ID_Anggota = :id_anggota, ID_Petugas = :id_petugas WHERE ID_Akun = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'username' => $data['Username'],
                'password_hash' => $data['Password_Hash'],
                'role' => $data['Role'],
                'id_anggota' => $data['ID_Anggota'],
                'id_petugas' => $data['ID_Petugas'],
                'id' => $id
            ]);
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    public function delete($id) {
        try {
            $sql = "DELETE FROM {$this->table} WHERE ID_Akun = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
    
    // Delete account by related ID (for anggota or petugas)
    public function deleteByRelatedId($relatedId) {
        try {
            $sql = "DELETE FROM {$this->table} WHERE ID_Anggota = :id_anggota OR ID_Petugas = :id_petugas";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'id_anggota' => $relatedId,
                'id_petugas' => $relatedId
            ]);
        } catch (\PDOException $e) {
            // Return false if there's an error
            return false;
        }
    }
}