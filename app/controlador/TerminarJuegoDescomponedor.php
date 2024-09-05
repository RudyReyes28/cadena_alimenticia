<?php
header('Content-Type: application/json');
require_once '../modelo/InsersionesBD.php';
try {
    // Crear instancia del modelo
    $baseDatos = new InsersionReportesJuegos();
    
    // Recuperar los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nombre = $data['nombre'];
    $score = $data['score'];
    $temporizador = $data['temporizador'];

    // Llamar al método para insertar datos
    $baseDatos->insertarResultadoDescomponedor($nombre, $score, $temporizador);
    
    // Cerrar conexión
    $baseDatos->cerrarConexion();

    echo json_encode(['status' => 'success', 'message' => 'Datos guardados exitosamente']);
    exit();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit();
}
?>