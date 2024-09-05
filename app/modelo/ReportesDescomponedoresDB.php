<?php
require_once 'Descomponedores.php';
require_once 'Conexion.php';
class ReportesDescomponedoresDB {
    private $conexion;

    public function __construct() {
        $conectar = new Conexion();
        $this->conexion = $conectar->getConexion();
    }

    public function obtenerTodosDescomponedores() {
        $query = "SELECT u.idusuario, d.iddescomponedores, u.nombre_usuario, m.nombre_juego,  d.puntaje, d.tiempo 
                  FROM descomponedores d 
                  INNER JOIN usuario u ON u.idusuario = d.idusuario
                  INNER JOIN minijuegos m ON m.idminijuegos = d.idminijuego";
        $result = $this->conexion->query($query);

        $descomponedores = [];
        while ($row = $result->fetch_assoc()) {
            $descomponedores[] = new Descomponedores(
                $row['iddescomponedores'],
                $row['idusuario'],
                $row['nombre_usuario'],
                $row['nombre_juego'],
                $row['puntaje'],
                $row['tiempo']
            );
        }

        return $descomponedores;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>