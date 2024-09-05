<?php
require_once 'Conexion.php';
class InsersionReportesJuegos {
    
    private $conexion;

    public function __construct() {
        $conectar = new Conexion();
        $this->conexion = $conectar->getConexion();
    }

    public function insertarResultadoConsumidor($nombre, $peces, $tiburones, $tiempo) {
        $idMinijuego = 2;
        $stmt = $this->conexion->prepare("INSERT INTO consumidores (idminijuego, idusuario, peces, tiburones, tiempo) VALUES (?,?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $idMinijuego ,$nombre, $peces, $tiburones, $tiempo);
        
        if ($stmt->execute()) {
            echo "Datos guardados exitosamente.";
        } else {
            echo "Error al guardar los datos: " . $this->conexion->error;
        }

        $stmt->close();
    }

    public function insertarResultadoProductor($nombre, $score, $soles, $temporizador) {
        $idMinijuego = 1;
        $stmt = $this->conexion->prepare("INSERT INTO productores (idminijuego, idusuario, soles, puntaje, tiempo) VALUES (?,?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $idMinijuego ,$nombre, $soles, $score, $temporizador);
        
        if (!$stmt->execute()) {
            // Maneja el error si ocurre
            throw new Exception("Error al guardar los datos: " . $this->conexion->error);
        }

        $stmt->close();
    }

    public function insertarResultadoDescomponedor($nombre, $score, $temporizador) {
        $idMinijuego = 3;
        $stmt = $this->conexion->prepare("INSERT INTO descomponedores (idminijuego, idusuario, puntaje, tiempo) VALUES (?,?, ?, ?)");
        $stmt->bind_param("iiii", $idMinijuego ,$nombre, $score, $temporizador);
        
        if (!$stmt->execute()) {
            // Maneja el error si ocurre
            throw new Exception("Error al guardar los datos: " . $this->conexion->error);
        }

        $stmt->close();
    }


    public function getConexion() {
        return $this->conexion;
    }


    public function cerrarConexion() {
        $this->conexion->close();
    }
}

?>