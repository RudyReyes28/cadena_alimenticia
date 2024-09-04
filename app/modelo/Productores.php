<?php
class Productores {
    public $idProductores;
    public $idUsuario;
    public $nombreUsuario;
    public $nombreJuego;
    public $soles;
    public $puntaje;
    public $tiempo;

    public function __construct($idProductores, $idUsuario, $nombreUsuario, $nombreJuego, $soles, $puntaje, $tiempo) {
        $this->idProductores = $idProductores;
        $this->idUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->nombreJuego = $nombreJuego;
        $this->soles = $soles;
        $this->puntaje = $puntaje;
        $this->tiempo = $tiempo;
    }
}
?>