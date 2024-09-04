<?php
class NuevoUsuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearUsuario($nombre) {
        // Lógica para crear un usuario o devolver el ID si ya existe
        $stmt = $this->conexion->prepare("INSERT INTO usuario (nombre_usuario) VALUES (?) ON DUPLICATE KEY UPDATE idusuario=LAST_INSERT_ID(idusuario)");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }
}



?>