<?php

require_once '../modelo/ConexionBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peces = $_POST['peces'];
    $tiburones = $_POST['tiburones'];
    $tiempo = $_POST['tiempo'];
    $nombre = $_POST['nombre'];

    // Crear instancia del modelo
    $baseDatos = new ConexionBaseDatos();
    // Llamar al método para insertar datos
    $baseDatos->insertarResultadoConsumidor($nombre, $peces, $tiburones, $tiempo);
    // Cerrar conexión
    $baseDatos->cerrarConexion();

    header("Location: ../vista/index.php");
    exit();

}
?>