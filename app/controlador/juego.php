<?php
if (isset($_GET['juego']) && isset($_GET['usuario'])) {
    $juego = $_GET['juego'];
    $usuario = htmlspecialchars($_GET['usuario']);

    echo "<h1>Bienvenido, $usuario</h1>";
    echo "<p>Estás a punto de jugar: $juego</p>";

    // Redirigir al juego correspondiente
    if ($juego == 'productores') {
        // Redirige a la página del juego "Productores"
        header("Location: ../vista/html/juego_productores.html?usuario=$usuario");
        exit();
    } elseif ($juego == 'consumidores') {
        // Redirige a la página del juego 2
        header("Location:../vista/html/juego_consumidores.php?usuario=$usuario");
        exit();
    } elseif ($juego == 'juego3') {
        // Redirige a la página del juego 3
        header("Location: juego3.php?usuario=$usuario");
        exit();
    } else {
        echo "<p>Juego no encontrado.</p>";
    }
} else {
    echo "<p>Error: No se recibió la información del juego o usuario.</p>";
}
?>