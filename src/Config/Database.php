<?php

namespace Arya\SistemPerpustakaan\Config;

class Database {
    private static $host = 'localhost';
    private static $dbname = 'perpustakaan';
    private static $username = 'root';
    private static $password = '';
    
    public static function getHost() {
        return self::$host;
    }
    
    public static function getDatabaseName() {
        return self::$dbname;
    }
    
    public static function getUsername() {
        return self::$username;
    }
    
    public static function getPassword() {
        return self::$password;
    }
}