<?php

class Database
{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    function __construct()
    {
        $this->host = DB_HOST;
        $this->db = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASS;
        $this->charset = DB_CHARSET;
    }


    function connect()
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        );
        try {
            $pdo = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db, $this->user, $this->password, $options);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            die("Error de conexión es: " . $e->getMessage());
        }
    }
}
