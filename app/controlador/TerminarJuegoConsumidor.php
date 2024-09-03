<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peces = $_POST['peces'];
    $tiburones = $_POST['tiburones'];
    $tiempo = $_POST['tiempo'];
    $nombre = $_POST['nombre'];

    // Aquí puedes guardar estos datos en una base de datos, archivo, etc.
    
    // Ejemplo de guardar en base de datos (asumiendo que ya tienes una conexión establecida)
    // $stmt = $pdo->prepare("INSERT INTO resultados (nombre, peces, tiburones, tiempo) VALUES (?, ?, ?, ?)");
    // $stmt->execute([$nombre, $peces, $tiburones, $tiempo]);

    echo "Juego terminado. Datos guardados exitosamente.";
    echo "cantidad peces " . $peces . " nombre" . $nombre . " cantidad tib" . $tiburones ." tiempo ".$tiempo;
    // Redirigir a una página de agradecimiento o mostrar un mensaje
}
?>