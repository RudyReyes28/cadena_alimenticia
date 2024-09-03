var time = new Date();
var deltaTime = 0;

if(document.readyState === "complete" || document.readyState === "interactive"){
    setTimeout(Init, 1);
}else{
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


var sueloY = 70;
var velY = 0;
var impulso = 900;
var gravedad = 2500;

var plantaPosX = 70;
var plantaPosY = sueloY; 

var sueloX = 0;
var velEscenario = 1280/3;
var gameVel = 1;
var score = 0;
var soles = 0;

var parado = false;
var saltando = false;

var tiempoHastaObstaculo = 2;
var tiempoObstaculoMin = 0.7;
var tiempoObstaculoMax = 1.8;
var obstaculoPosY = 16;
var obstaculos = [];

var tiempoHastaSol = 5;
var tiempoSolMin = 0.7;
var tiempoSolMax = 1.8;
var obstaculoSolPosY = 90;
var obstaculosSol = [];

var contenedor;
var planta;
var textoScore;
var textoSoles;
var suelo;
var gameOver;

function Start() {
    gameOver = document.querySelector(".game-over");
    suelo = document.querySelector(".suelo");
    contenedor = document.querySelector(".contenedor");
    textoScore = document.querySelector(".score");
    textoSoles = document.querySelector(".soles");
    planta = document.querySelector(".planta");
    document.addEventListener("keydown", HandleKeyDown);
}


function Update() {
    if(parado) return;
    
    MoverPlanta();
    MoverSuelo();
    DecidirCrearObstaculos();
    DecidirCrearSol();
    MoverSoles();
    MoverObstaculos();
    DetectarColision();
    DetectarColisionSol();

    velY -= gravedad * deltaTime;
}

function HandleKeyDown(ev){
    if(ev.keyCode == 32){
        Saltar();
    }
}

function Saltar(){
    if(plantaPosY === sueloY){
        saltando = true;
        velY = impulso;
    }
}

function MoverPlanta() {
    plantaPosY += velY * deltaTime;
    if(plantaPosY < sueloY){
        
        TocarSuelo();
    }
    planta.style.bottom = plantaPosY+"px";
}

function TocarSuelo() {
    plantaPosY = sueloY;
    velY = 0;
    if(saltando){
        //planta.classList.add("dino-corriendo");
    }
    saltando = false;
}

function MoverSuelo() {
    sueloX += CalcularDesplazamiento();
    suelo.style.left = -(sueloX % contenedor.clientWidth) + "px";
}

function CalcularDesplazamiento() {
    return velEscenario * deltaTime * gameVel;
}

function Estrellarse() {
    parado = true;
}

function DecidirCrearObstaculos() {
    tiempoHastaObstaculo -= deltaTime;
    if(tiempoHastaObstaculo <= 0) {
        CrearObstaculo();
    }
}

function DecidirCrearSol() {
    tiempoHastaSol -= deltaTime;
    if(tiempoHastaSol <= 0) {
        CrearSol();
    }
}


function CrearObstaculo() {
    var obstaculo = document.createElement("div");
    contenedor.appendChild(obstaculo);
    obstaculo.classList.add("conejo");
    if(Math.random() > 0.5) obstaculo.classList.add("conejo2");
    obstaculo.posX = contenedor.clientWidth;
    obstaculo.style.left = contenedor.clientWidth+"px";

    obstaculos.push(obstaculo);
    tiempoHastaObstaculo = tiempoObstaculoMin + Math.random() * (tiempoObstaculoMax-tiempoObstaculoMin) / gameVel;
}

function CrearSol() {
    var solecito = document.createElement("div");
    contenedor.appendChild(solecito);
    solecito.classList.add("sol");
    if(Math.random() > 0.5) solecito.classList.add("sol");
    solecito.posX = contenedor.clientWidth;
    solecito.style.left = contenedor.clientWidth+"px";

    obstaculosSol.push(solecito);
    tiempoHastaSol = tiempoSolMin + Math.random() * (tiempoSolMax-tiempoSolMin) / gameVel;
}


function MoverObstaculos() {
    for (var i = obstaculos.length - 1; i >= 0; i--) {
        if(obstaculos[i].posX < -obstaculos[i].clientWidth) {
            obstaculos[i].parentNode.removeChild(obstaculos[i]);
            obstaculos.splice(i, 1);
            GanarPuntos();
        }else{
            obstaculos[i].posX -= CalcularDesplazamiento();
            obstaculos[i].style.left = obstaculos[i].posX+"px";
        }
    }
}

function MoverSoles() {
    for (var i = obstaculosSol.length - 1; i >= 0; i--) {
        if(obstaculosSol[i].posX < -obstaculosSol[i].clientWidth) {
            obstaculosSol[i].parentNode.removeChild(obstaculosSol[i]);
            obstaculosSol.splice(i, 1);
        }else{
            obstaculosSol[i].posX -= CalcularDesplazamiento();
            obstaculosSol[i].style.left = obstaculosSol[i].posX+"px";
        }
    }
}

function GanarPuntos() {
    score++;
    textoScore.innerText = score;
    if(score == 5){
        gameVel = 1.1;
        //contenedor.classList.add("mediodia");
    }else if(score == 10) {
        gameVel = 1.5;
        //contenedor.classList.add("tarde");
    } else if(score == 20) {
        gameVel = 2;
        //contenedor.classList.add("noche");
    } else if(score == 40) {
        gameVel = 3;
        //contenedor.classList.add("noche");
    }
    suelo.style.animationDuration = (3/gameVel)+"s";
}

function GanarSoles() {
    soles++;
    textoSoles.innerText = soles;
    
    
}


/*function GameOver() {
    Estrellarse();
    gameOver.style.display = "block";


}*/

function GameOver() {
    Estrellarse();
    const gameOverPopup = document.getElementById('gameOverPopup');
    gameOverPopup.style.display = "block";

    // Manejar el botón de reinicio
    document.getElementById('restartButton').addEventListener('click', function() {
        gameOverPopup.style.display = "none"; // Ocultar la ventana emergente
      
        obstaculos.forEach(obstaculo => obstaculo.remove());
        obstaculosSol.forEach(sol => sol.remove());
sueloY = 70;
 velY = 0;
 impulso = 900;
 gravedad = 2500;

 plantaPosX = 70;
 plantaPosY = sueloY; 

 sueloX = 0;
 velEscenario = 1280/3;
 gameVel = 1;
 score = 0;
 soles = 0;

 parado = false;
 saltando = false;

 obstaculos = [];

 obstaculosSol = [];

 textoScore.innerText = score;
        textoSoles.innerText = soles;
        Init(); // Reiniciar el juego
    });

    // Manejar el botón de salida
    document.getElementById('quitButton').addEventListener('click', function() {
        // Lógica para salir o detener el juego
        gameOverPopup.style.display = "none"; // Ocultar la ventana emergente
    });
}


function DetectarColision() {
    for (var i = 0; i < obstaculos.length; i++) {
        if(obstaculos[i].posX > plantaPosX + planta.clientWidth) {
            //EVADE
            break; //al estar en orden, no puede chocar con más
        }else{
            if(IsCollision(planta, obstaculos[i], 10, 30, 15, 20)) {
                GameOver();
            }
        }
    }
}

function DetectarColisionSol() {
    for (var i = 0; i < obstaculosSol.length; i++) {
        if(obstaculosSol[i].posX > plantaPosX + planta.clientWidth) {
            //EVADE
            break; //al estar en orden, no puede chocar con más
        }else{
            if(IsCollision(planta, obstaculosSol[i], 10, 30, 15, 20)) {
                GanarSoles();
                obstaculosSol[i].remove();
                obstaculosSol.splice(i, 1);
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