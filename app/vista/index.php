<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice de Juegos</title>
    <link href="../../public/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>Índice de Juegos</h1>
    <div class="game-container">
        <div class="game-box" onclick="seleccionarJuego('productores')">
            <img src="../../public/imagenes/index_productor.jpg" alt="Productores" class="game-image">
            <div class="game-title">Productores</div>
        </div>
        <div class="game-box" onclick="seleccionarJuego('consumidores')">
            <img src="../../public/imagenes/index_consumidor.jpg" alt="Consumidores" class="game-image">
            <div class="game-title">Consumidores</div>
        </div>
        <div class="game-box" onclick="seleccionarJuego('juego3')">
            <img src="ruta_a_imagen_juego3.jpg" alt="Juego 3" class="game-image">
            <div class="game-title">Juego 3</div>
        </div>
        <div class="game-box" onclick="seleccionarJuego('reportes')">
            <img src="ruta_a_imagen_juego3.jpg" alt="Reportes" class="game-image">
            <div class="game-title">Reportes</div>
        </div>
    </div>

    <script>
        function seleccionarJuego(juego) {
            const username = prompt("Por favor, ingresa tu nombre de usuario:");
            if (username) {
                window.location.href = `../controlador/juego.php?juego=${juego}&usuario=${username}`;
            }
        }
    </script>
</body>
</html>