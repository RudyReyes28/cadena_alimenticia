<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice de Juegos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .game-title {
            margin: 20px;
            font-size: 24px;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Índice de Juegos</h1>
    <div class="game-title" onclick="seleccionarJuego('productores')">Productores</div>
    <div class="game-title" onclick="seleccionarJuego('consumidores')">Consumidores</div>
    <div class="game-title" onclick="seleccionarJuego('juego3')">Juego 3</div>

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