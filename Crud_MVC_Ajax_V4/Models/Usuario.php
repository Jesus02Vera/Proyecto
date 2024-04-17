<?php

class Usuario {
    
    private $id;
    private $nombre;
    private $email;
    private $clave;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setClave($clave): void {
        $this->clave = $clave;
    }


}
