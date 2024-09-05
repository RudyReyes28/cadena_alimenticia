var time = new Date();
var deltaTime = 0;

if (document.readyState === "complete" || document.readyState === "interactive") {
    setTimeout(Init, 1);
} else {
    document.addEventListener("DOMContentLoaded", Init);
}

function Init() {
    time = new Date();
    Start();
    Loop();
}

function Loop() {
    deltaTime = (new Date() - time) / 1000;
    time = new Date();
    Update();
    requestAnimationFrame(Loop);
}

var posicionDesc = 70;

var descPosY = 50;

var sueloX = 0;
var velEscenario = 1280 / 3;
var gameVel = 0.5;
var score = 0;

var parado = false;

var tiempoHastaObstaculo = 2;
var tiempoObstaculoMin = 0.7;
var tiempoObstaculoMax = 1.8;
var obstaculos = [];

var tiempoHastaMateria = 5;
var tiempoMateriaMin = 0.7;
var tiempoMateriaMax = 1.8;
var obstaculosMateria = [];

var tiempoInicio; // Variable para almacenar el tiempo de inicio
var tiempoTranscurrido = 0; // Tiempo total transcurrido en segundos
var textoTemporizador;

var contenedor;
var desc;
var textoScore;
var textoTemporizador;
var suelo;
var gameOver;

function Start() {
    tiempoInicio = new Date();
    gameOver = document.querySelector(".game-over");
    suelo = document.querySelector(".suelo");
    contenedor = document.querySelector(".contenedor");
    textoScore = document.querySelector(".score");
    textoTemporizador = document.querySelector(".temp");
    desc = document.querySelector(".descomponedor");
    document.addEventListener("keydown", moverDesc);
}


function Update() {
    if (parado) return;

    DecidirCrearObstaculos();
    DecidirCrearMateria();
    MoverMateria();
    MoverObstaculos();
    DetectarColision();
    DetectarColisionMateria();
    IniciarTemporizador();


    
}
function moverDesc(ev) {
    let izquierda= desc.offsetLeft;
    
    if (ev.key === 'ArrowRight') {
        desc.style.left = izquierda +20 + "px";
    }else if(ev.key === 'ArrowLeft') {
        desc.style.left = izquierda -20 + "px";
    }
}

function IniciarTemporizador() {
    var tiempoAhora = new Date();
    tiempoTranscurrido = Math.floor((tiempoAhora - tiempoInicio) / 1000); // Calcula el tiempo en segundos
    textoTemporizador.innerText = tiempoTranscurrido;

}

function DecidirCrearObstaculos() {
    tiempoHastaObstaculo -= deltaTime;
    if (tiempoHastaObstaculo <= 0) {
        CrearObstaculo();
    }
}


function DecidirCrearMateria() {
    tiempoHastaMateria -= deltaTime;
    if (tiempoHastaMateria <= 0) {
        CrearMateria();
    }
}


function CrearObstaculo() {
    var obstaculo = document.createElement("div");
    contenedor.appendChild(obstaculo);
    obstaculo.classList.add("plastico");
    if (Math.random() > 0.5) obstaculo.classList.add("plastico2");
    
    obstaculo.posX =   (Math.random() * (contenedor.clientWidth - obstaculo.clientWidth));
    obstaculo.style.left = obstaculo.posX + "px";
    obstaculo.posY = contenedor.clientHeight;
    obstaculo.style.bottom = contenedor.clientWidth + "px";

    obstaculos.push(obstaculo);
    tiempoHastaObstaculo = tiempoObstaculoMin + Math.random() * (tiempoObstaculoMax - tiempoObstaculoMin) / gameVel;
}

function CrearMateria() {
    var materia = document.createElement("div");
    contenedor.appendChild(materia);
    materia.classList.add("materia");
    if (Math.random() > 0.5) materia.classList.add("materia2");
    materia.style.left = (Math.random() * (contenedor.clientWidth - materia.clientWidth)) + "px";
    materia.posY = contenedor.clientHeight;
    materia.style.bottom = contenedor.clientWidth + "px";

    obstaculosMateria.push(materia);
    tiempoHastaMateria = tiempoMateriaMin + Math.random() * (tiempoMateriaMax - tiempoMateriaMin) / gameVel;
}


function MoverObstaculos() {
    for (var i = obstaculos.length - 1; i >= 0; i--) {
        if (obstaculos[i].posY < -obstaculos[i].clientHeight) {
            obstaculos[i].parentNode.removeChild(obstaculos[i]);
            obstaculos.splice(i, 1);
            //GanarPuntos();
        } else {
            obstaculos[i].posY -= CalcularDesplazamiento();
            obstaculos[i].style.bottom = obstaculos[i].posY + "px";
        }
    }
}

function MoverMateria() {
    for (var i = obstaculosMateria.length - 1; i >= 0; i--) {
        if (obstaculosMateria[i].posY < -obstaculosMateria[i].clientHeight) {
            obstaculosMateria[i].parentNode.removeChild(obstaculosMateria[i]);
            obstaculosMateria.splice(i, 1);
            //GanarPuntos();
        } else {
            obstaculosMateria[i].posY -= CalcularDesplazamiento();
            obstaculosMateria[i].style.bottom = obstaculosMateria[i].posY + "px";
        }
    }
}

function GanarPuntos() {
    score++;
    textoScore.innerText = score;
    if (score == 5) {
        gameVel = 1.1;

    } else if (score == 10) {
        gameVel = 1.3;

    } else if (score == 20) {
        gameVel = 1.5;

    } else if (score == 40) {
        gameVel = 2;

    }
    suelo.style.animationDuration = (3 / gameVel) + "s";
}

function DetectarColision() {
    for (var i = 0; i < obstaculos.length; i++) {
        if (obstaculos[i].posY >  descPosY + desc.clientHeight) {
            //EVADE
            break; //al estar en orden, no puede chocar con más
        } else {
            if (IsCollision(desc, obstaculos[i], 10, 30, 15, 20)) {
                GameOver();
            }
        }
    }
}

function DetectarColisionMateria() {
    for (var i = 0; i < obstaculosMateria.length; i++) {
        if (obstaculosMateria[i].posY > descPosY + desc.clientHeight) {
            //EVADE
            break; //al estar en orden, no puede chocar con más
        } else {
            if (IsCollision(desc, obstaculosMateria[i], 10, 30, 15, 20)) {
                GanarPuntos();
                obstaculosMateria[i].remove();
                obstaculosMateria.splice(i, 1);
            }
        }
    }
}


function IsCollision(a, b, paddingTop, paddingRight, paddingBottom, paddingLeft) {
    var aRect = a.getBoundingClientRect();
    var bRect = b.getBoundingClientRect();

    return !(
        ((aRect.top + aRect.height - paddingBottom) < (bRect.top)) ||
        (aRect.top + paddingTop > (bRect.top + bRect.height)) ||
        ((aRect.left + aRect.width - paddingRight) < bRect.left) ||
        (aRect.left + paddingLeft > (bRect.left + bRect.width))
    );
}

function GameOver() {
    Estrellarse();

    const gameOverPopup = document.getElementById('gameOverPopup');
    gameOverPopup.style.display = "block";
    const nombreUsuario = obtenerNombreUsuario();

    const data = {
        score: score,
        temporizador: tiempoTranscurrido,
        nombre: nombreUsuario
    };

    // Enviar los datos al servidor usando AJAX
    fetch('../../../app/controlador/TerminarJuegoDescomponedor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            console.log('Datos guardados:', data);

            // Manejar el botón de reinicio
            document.getElementById('restartButton').addEventListener('click', function () {


                gameOverPopup.style.display = "none"; // Ocultar la ventana emergente



                obstaculos.forEach(obstaculo => obstaculo.remove());
                obstaculosMateria.forEach(materia => materia.remove());
                
                velY = 0;


                sueloX = 0;
                velEscenario = 1280 / 3;
                gameVel = 0.5;
                score = 0;
                
                tiempoTranscurrido = 0;

                parado = false;
                
                obstaculos = [];

                obstaculosMateria = [];

                textoScore.innerText = score;
                textoTemporizador.innerText = tiempoTranscurrido;
                Init(); // Reiniciar el juego


            });

            // Manejar el botón de salida
            document.getElementById('quitButton').addEventListener('click', function () {
                // Lógica para salir o detener el juego
                gameOverPopup.style.display = "none"; // Ocultar la ventana emergente
                window.location.href = '../../../app/vista/index.php';

            });

        })
        .catch((error) => {
            console.log('Error al guardar los datos:', error);
            console.log('Error al guardar los datos:', data);
        });
    
}

function Estrellarse() {
    parado = true;
}




function CalcularDesplazamiento() {
    return velEscenario * deltaTime * gameVel;
}

function obtenerNombreUsuario() {
    const params = new URLSearchParams(window.location.search);
    return params.get('usuario');
}