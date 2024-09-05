<?php
class Descomponedores {
    public $idDescomponedores;
    public $idUsuario;
    public $nombreUsuario;
    public $nombreJuego;
    public $puntaje;
    public $tiempo;

    public function __construct($idDescomponedores, $idUsuario, $nombreUsuario, $nombreJuego, $puntaje, $tiempo) {
        $this->idDescomponedores = $idDescomponedores;
        $this->idUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->nombreJuego = $nombreJuego;
        $this->puntaje = $puntaje;
        $this->tiempo = $tiempo;
    }
}
?>