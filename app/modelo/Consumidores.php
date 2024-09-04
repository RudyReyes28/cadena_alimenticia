<?php
class Consumidores {
    public $idConsumidores;
    public $idUsuario;
    public $nombreUsuario;
    public $nombreJuego;
    public $peces;
    public $tiburones;
    public $tiempo;

    public function __construct($idConsumidores, $idUsuario, $nombreUsuario, $nombreJuego, $peces, $tiburones, $tiempo) {
        $this->idConsumidores = $idConsumidores;
        $this->idUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->nombreJuego = $nombreJuego;
        $this->peces = $peces;
        $this->tiburones = $tiburones;
        $this->tiempo = $tiempo;
    }
}
?>