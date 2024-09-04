<?php

if (isset($_GET['juego'])) {
    $reporte = $_GET['juego'];

    echo "<h1>Bienvenido, $usuario</h1>";



    // Redirigir al juego correspondiente
    if ($reporte == 'reporte1') {
        // Redirige a la página del juego "Productores"
        header("Location: ../vista/reportes/reportes_uno.php");
        exit();
    } elseif ($reporte == 'reporte2') {
        // Redirige a la página del juego 2
        header("Location:../vista/reportes/reportes_dos.php");
        exit();
    } elseif ($reporte == 'reporte3') {
        // Redirige a la página del juego 3
        header("Location: juego3.php");
        exit();
    }elseif ($reporte == 'reporte4') {
        // Redirige a la página del juego 3
        header("Location: ../vista/reportes/reportes_index.php");
        exit();
    }  else {
        echo "<p>Juego no encontrado.</p>";
    }
} else {
    echo "<p>Error: No se recibió la información del juego o usuario.</p>";
}
?>