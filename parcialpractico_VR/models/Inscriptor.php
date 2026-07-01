<?php
require_once __DIR__ . '/../config/myConexionPDO.php';

class Inscriptor {
    private $db;

    public function __construct() {
        $conexion = new mod_db();
        $this->db = $conexion->getConexion();
    }

    public function guardar($identidad, $nombre, $apellido, $edad, $sexo, $pais_id, $nacionalidad_id, $correo, $celular, $observaciones, $firma, $temas) {
        try {
            $this->db->beginTransaction();

            // Insertar inscriptor
            $sql = "INSERT INTO inscriptores (identidad, nombre, apellido, edad, sexo, pais_residencia_id, nacionalidad_id, correo, celular, observaciones, firma_integridad) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$identidad, $nombre, $apellido, $edad, $sexo, $pais_id, $nacionalidad_id, $correo, $celular, $observaciones, $firma]);
            
            $inscriptor_id = $this->db->lastInsertId();

            // Insertar temas de interés
            if(!empty($temas)) {
                $sqlTemas = "INSERT INTO inscriptor_temas (inscriptor_id, area_interes_id) VALUES (?, ?)";
                $stmtTemas = $this->db->prepare($sqlTemas);
                foreach($temas as $tema_id) {
                    $stmtTemas->execute([$inscriptor_id, $tema_id]);
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getReporte() {
        $sql = "SELECT i.*, 
                p1.nombre AS pais_residencia, 
                p2.nombre AS nacionalidad,
                GROUP_CONCAT(a.nombre SEPARATOR ', ') AS temas_interes
                FROM inscriptores i
                LEFT JOIN paises p1 ON i.pais_residencia_id = p1.id
                LEFT JOIN paises p2 ON i.nacionalidad_id = p2.id
                LEFT JOIN inscriptor_temas it ON i.id = it.inscriptor_id
                LEFT JOIN areas_interes a ON it.area_interes_id = a.id
                GROUP BY i.id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>