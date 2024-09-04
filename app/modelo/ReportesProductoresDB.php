<?php
require_once 'Productores.php';

class ReportesProductoresDB {
    private $conexion;

    public function __construct() {
        $host = 'localhost'; 
        $usuario = 'root';
        $password = '1234';
        $base_datos = 'cadena_alimenticia';

        $this->conexion = new mysqli($host, $usuario, $password, $base_datos);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
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