<?php

namespace Arya\SistemPerpustakaan\Core;

use Arya\SistemPerpustakaan\Config\Database;

class Model {
    protected $db;
    
    public function __construct() {
        // Database connection
        $host = Database::getHost();
        $dbname = Database::getDatabaseName();
        $username = Database::getUsername();
        $password = Database::getPassword();
        
        try {
            $this->db = new \PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}