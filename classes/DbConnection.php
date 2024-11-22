<?php

class DbConnection {
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'shadowx';

    private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    private static ?PDO $db = null;

    public static function connect() {      
        try {
            self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
        } catch (Exception $e) {
            die('Error al conectar con MySQL.');
        }
    }

    /**
     * Función que devuelve una conexión PDO lista para usar
     * @return PDO
     */
    public static function getConexion(): PDO {
        if(self::$db === null){
            self::connect();
        }
        return self::$db;
    }
}

?>