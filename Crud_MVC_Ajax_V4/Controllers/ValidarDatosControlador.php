<?php

class ValidarDatosControlador {

    private $patronPasswordUsuario = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
    private $patronDireccion = '/^[a-zA-Z0-9 \t\r\n\-\.,]+$/';
    private $patronNombreUsuario = '/^[a-zA-Z0-9]*$/';
    private $patronCarateres = "/^[A-Za-z0-9\s]+$/";
    private $patronNumeros = '/^[[:digit:]]+$/';

    public function validarPasswordUsuario($clave) {
        if (!preg_match($this->patronPasswordUsuario, $clave)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarNombreUsuarioControlador($cadena) {
        if (!preg_match($this->patronNombreUsuario, $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarNombreEmpresaControlador($cadena) {
        if (!preg_match($this->patronNombreUsuario, $cadena)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function validarDireccionControlador($cadena) {
        if (!preg_match($this->patronDireccion, $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarCaracteresControlador($cadena) {
        if (!preg_match($this->patronCarateres, $cadena)) {
            return true;
        } else {
            return false;
        }
    }


    public function validarNumerosControlador($cadena) {
        if (!preg_match($this->patronNumeros, $cadena)) {
            return true;
        } else {
            return false;
        }
    }

}
