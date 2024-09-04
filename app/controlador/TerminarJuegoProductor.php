<?php
header('Content-Type: application/json');
require_once '../modelo/ConexionBD.php';
try {
    // Crear instancia del modelo
    $baseDatos = new ConexionBaseDatos();
    
    // Recuperar los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nombre = $data['nombre'];
    $score = $data['score'];
    $soles = $data['soles'];
    $temporizador = $data['temporizador'];

    // Llamar al método para insertar datos
    $baseDatos->insertarResultadoProductor($nombre, $score, $soles, $temporizador);
    
    // Cerrar conexión
    $baseDatos->cerrarConexion();

    echo json_encode(['status' => 'success', 'message' => 'Datos guardados exitosamente']);
    exit();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit();
}
?>