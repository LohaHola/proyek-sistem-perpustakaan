<?php

namespace Arya\SistemPerpustakaan\Config;

class Database {
    private static $host = 'sql309.infinityfree.com';
    private static $databaseName = 'if0_40428442_perpustakaan';
    private static $username = 'if0_40428442';
    private static $password = 'rY2VzNp5fGuOE';
    
    public static function getHost() {
        return self::$host;
    }
    
    public static function getDatabaseName() {
        return self::$databaseName;
    }
    
    public static function getUsername() {
        return self::$username;
    }
    
    public static function getPassword() {
        return self::$password;
    }
}
?>