<?php
require_once 'Productores.php';
require_once 'Conexion.php';
class ReportesProductoresDB {
    private $conexion;

    public function __construct() {
        $conectar = new Conexion();
        $this->conexion = $conectar->getConexion();
    }

    public function obtenerTodosProductores() {
        $query = "SELECT u.idusuario, p.idproductores, u.nombre_usuario, m.nombre_juego, p.soles, p.puntaje, p.tiempo 
                  FROM productores p 
                  INNER JOIN usuario u ON u.idusuario = p.idusuario
                  INNER JOIN minijuegos m ON m.idminijuegos = p.idminijuego";
        $result = $this->conexion->query($query);

        $productores = [];
        while ($row = $result->fetch_assoc()) {
            $productores[] = new Productores(
                $row['idproductores'],
                $row['idusuario'],
                $row['nombre_usuario'],
                $row['nombre_juego'],
                $row['soles'],
                $row['puntaje'],
                $row['tiempo']
            );
        }

        return $productores;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>