<?php
class mod_db {
    private $conexion;

    public function __construct() {
        $host = "localhost";
        $dbname = "parcial_itechbd";
        $user = "root"; 
        $pass = ""; 

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->conexion = new PDO($dsn, $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>