<?php
require_once '../modelo/NuevoUsuarioDB.php';

if (isset($_GET['juego']) && isset($_GET['usuario'])) {
    $juego = $_GET['juego'];
    $usuario = htmlspecialchars($_GET['usuario']);

    echo "<h1>Bienvenido, $usuario</h1>";
    echo "<p>Estás a punto de jugar: $juego</p>";

    //deberia revisar la conexion y crear un usuario
    $usuarioDB = new NuevoUsuario();

    $idUsuario = $usuarioDB->crearUsuario($usuario);

    $usuarioDB->cerrarConexion();

    // Redirigir al juego correspondiente
    if ($juego == 'productores') {
        // Redirige a la página del juego "Productores"
        header("Location: ../vista/html/juego_productores.html?usuario=$idUsuario");
        exit();
    } elseif ($juego == 'consumidores') {
        // Redirige a la página del juego 2
        header("Location:../vista/html/juego_consumidores.php?usuario=$idUsuario");
        exit();
    } elseif ($juego == 'descomponedor') {
        // Redirige a la página del juego 3
        header("Location: ../vista/html/juego_descomponedores.html?usuario=$idUsuario");
        exit();
    }elseif ($juego == 'reportes') {
        // Redirige a la página del juego 3
        header("Location: ../vista/reportes/reportes_index.php?usuario=$idUsuario");
        exit();
    }  else {
        echo "<p>Juego no encontrado.</p>";
    }
} else {
    echo "<p>Error: No se recibió la información del juego o usuario.</p>";
}
?>