<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Pesca</title>
    <link rel="stylesheet" href="../../../public/css/consumidores.css">
</head>
<body>


    <div class="contenedor-centro">
        <div class="contenedor">
            
            <h1>Juego de Pesca</h1>
            <div id="mapa-pesca">
                <!-- La cuadrícula del mapa se genera dinámicamente -->
            </div>
            <button id="boton-pescar">Pescar</button>
            <div id="resultado"></div>
            <div id="puntos">Peces Atrapados: 0</div>
            <div id="tibA">Tiburones Atrapados: 0</div>
            <div id="tempo">Tiempo: 0</div>
            
        </div>
        
    </div>

    <form method="post" action="../../controlador/TerminarJuegoConsumidor.php">
                <input type="hidden" name="peces" id="peces">
                <input type="hidden" name="tiburones" id="tiburones">
                <input type="hidden" name="tiempo" id="tiempo">
                <input type="hidden" name="nombre" id="nombre">
                <button type="submit" id="terminar-juego">Terminar Juego</button>
     </form>
            
    
    
    <script src="../../../public/js/animacionConsumidor.js"></script> 
</body>
</html>