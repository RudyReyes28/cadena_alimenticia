<?php
require_once 'Consumidores.php';
require_once 'Conexion.php';
class ReportesConsumidoresDB {
    private $conexion;

    public function __construct() {
        $conectar = new Conexion();
        $this->conexion = $conectar->getConexion();
    }

    public function obtenerTodosConsumidores() {
        $query = "SELECT u.idusuario, c.idconsumidores, u.nombre_usuario, m.nombre_juego, c.peces, c.tiburones, c.tiempo 
                  FROM consumidores c 
                  INNER JOIN usuario u ON u.idusuario = c.idusuario
                  INNER JOIN minijuegos m ON m.idminijuegos = c.idminijuego";
        $result = $this->conexion->query($query);

        $consumidores = [];
        while ($row = $result->fetch_assoc()) {
            $consumidores[] = new Consumidores(
                $row['idconsumidores'],
                $row['idusuario'],
                $row['nombre_usuario'],
                $row['nombre_juego'],
                $row['peces'],
                $row['tiburones'],
                $row['tiempo']
            );
        }

        return $consumidores;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}

?>