<?php

include_once '../../../Controllers/usuarioControlador.php';
include_once '../../../Models/UsuarioDAO.php';

class AjaxUsuario {

    public $usuarioValidar;
    public $email;
    public $url;
    public $ope;
    public $id;

    public function validarUsuario() {
        $nombre = $this->usuarioValidar;
        $usuarioControlador = new UsuarioControlador();
        $respuesta = $usuarioControlador->validarUsuarioControlador($nombre);
        print $respuesta;
    }

    public function validarEmail() {
        $email = $this->email;
        $usuarioControlador = new UsuarioControlador();
        $respuesta = $usuarioControlador->validarEmailControlador($email);
        print $respuesta;
    }

    public function validarUsuarioUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $usuarioControlador = new UsuarioControlador();
        $respuesta = $usuarioControlador->validarUsuarioUpdateControlador($this->usuarioValidar, $id);
        print $respuesta;
    }

    public function validarEmailUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $usuarioControlador = new UsuarioControlador();
        $respuesta = $usuarioControlador->validarEmailUpdateControlador($this->email,$id);
        print $respuesta;
    }
    
    public function eliminarUsuario() {
        $usuarioControlador = new UsuarioControlador();
        $respuesta = $usuarioControlador->eliminarUsuarioControlador($this->id);
        print $respuesta;
    }

}


///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

$ajaxUsuario = new AjaxUsuario();
if (isset($_POST['nombre']) && !isset($_POST['url'])) {
    $ajaxUsuario->usuarioValidar = $_POST['nombre'];
    $ajaxUsuario->validarUsuario();
}

if (isset($_POST['email'])) {
    $ajaxUsuario->email = $_POST['email'];
    if (isset($_POST['operacion'])) {
        $ajaxUsuario->url = $_POST['url'];
        $ajaxUsuario->validarEmailUpdate();
    } else {
        $ajaxUsuario->validarEmail();
    }
}

if (isset($_POST['url']) && isset($_POST['nombre'])) {
    $ajaxUsuario->url = $_POST['url'];
    $ajaxUsuario->usuarioValidar = $_POST['nombre'];
    $ajaxUsuario->validarUsuarioUpdate();
}

if(isset($_POST['id']) && isset($_POST['ope'])){
    $ajaxUsuario->id = $_POST['id'];
    $ajaxUsuario->ope = $_POST['ope'];
    $ajaxUsuario->eliminarUsuario();    
}
