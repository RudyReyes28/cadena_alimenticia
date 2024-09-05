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
            <p class="game-description">Evita los consumidores y captura soles para producir oxigeno.</p>

        </div>
        <div class="game-box" onclick="seleccionarJuego('consumidores')">
            <img src="../../public/imagenes/index_consumidor.jpg" alt="Consumidores" class="game-image">
            <div class="game-title">Consumidores</div>
            <p class="game-description">Prueba suerte al capturar peces pero ten cuidado con los tiburones.</p>

        </div>
        <div class="game-box" onclick="seleccionarJuego('descomponedor')">
            <img src="../../public/imagenes/index_descomponedor.jpg" alt="descomponedor" class="game-image">
            <div class="game-title">Descomponedor</div>
            <p class="game-description">Descompone toda la materia organica que encuentras, cuidado con la inorganica.</p>

        </div>
        <div class="game-box" onclick="seleccionarJuego('reportes')">
            <img src="../../public/imagenes/index_reportes.jpg" alt="Reportes" class="game-image">
            <div class="game-title">Reportes</div>
            <p class="game-description">Revisa las puntaciones de cada juego, ¿eres el mejor?.</p>

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