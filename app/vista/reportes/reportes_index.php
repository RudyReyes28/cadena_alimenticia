<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link href="../../../public/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Reporte de Juegos</h1>
    <div class="game-container">
        <div class="game-box" onclick="seleccionarReporte('reporte1')">
            <img src="../../../public/imagenes/index_productor.jpg" alt="reporte1" class="game-image">
            <div class="game-title">Reporte 1</div>
            <p class="game-description">Reportes de todos los usuarios que jugaron el juego de 'Productores'.</p>

        </div>
        <div class="game-box" onclick="seleccionarReporte('reporte2')">
            <img src="../../../public/imagenes/index_consumidor.jpg" alt="reporte2" class="game-image">
            <div class="game-title">Reporte 2</div>
            <p class="game-description">Aqui encontraras los reportes de todos los usuarios que jugaron el juego de 'Consumidores'.</p>

        </div>
        <div class="game-box" onclick="seleccionarReporte('reporte3')">
            <img src="../../../public/imagenes/index_descomponedor.jpg" alt="reporte3" class="game-image">
            <div class="game-title">Reporte 3</div>
            <p class="game-description">Aqui encontraras los reportes de todos los usuarios que jugaron el juego de 'Descomponedores'.</p>

        </div>
    </div>

    <br>
    <a href="../index.php"><button>Regresar a Juegos</button></a>

    <script>
        function seleccionarReporte(juego) {
          
                window.location.href = `../../controlador/AdministrarReportes.php?juego=${juego}`;
           
        }
    </script>
</body>
</html>