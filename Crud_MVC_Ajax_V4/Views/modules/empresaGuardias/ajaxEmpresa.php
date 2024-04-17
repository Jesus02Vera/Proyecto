<?php

include_once '../../../Controllers/EmpresaGuardiasControlador.php';
include_once '../../../Models/EmpresaGuardiasDAO.php';

class AjaxEmpresa {

    public $empresaValidar;
    public $direccion;
    public $telefono;
    public $email;
    public $url;
    public $ope;
    public $id;

    public function validarEmpresa() {
        $empresa = $this->empresaValidar;
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarEmpresaControlador($empresa);
        print $respuesta;
    }

    public function validarDireccion() {
        $direccion = $this->direccion;
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarEmpresaControlador($direccion);
        print $respuesta;
    }

    public function validarTelefono() {
        $telefono = $this->telefono;
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarEmpresaControlador($telefono);
        print $respuesta;
    }

    public function validarEmail() {
        $email = $this->email;
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarEmailControlador($email);
        print $respuesta;
    }

    public function validarEmpresaUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarEmpresaUpdateControlador($this->empresaValidar, $id);
        print $respuesta;
    }

    public function validarDireccionUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarDireccionUpdateControlador($this->direccion, $id);
        print $respuesta;
    }

    public function validarTelefonoUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarTelefonoUpdateControlador($this->telefono, $id);
        print $respuesta;
    }

    public function validarEmailUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->validarEmailUpdateControlador($this->email,$id);
        print $respuesta;
    }
    
    public function eliminarEmpresa() {
        $empresaControlador = new EmpresaGuardiasControlador();
        $respuesta = $empresaControlador->eliminarEmpresaControlador($this->id);
        print $respuesta;
    }

}


///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

$ajaxEmpresa = new AjaxEmpresa();
if (isset($_POST['nombre']) && !isset($_POST['url'])) {
    $ajaxEmpresa->empresaValidar = $_POST['nombre'];
    $ajaxEmpresa->validarEmpresa();
}

if (isset($_POST['direccion'])) {
    $ajaxEmpresa->direccion = $_POST['direccion'];
    if (isset($_POST['operacion'])) {
        $ajaxEmpresa->url = $_POST['url'];
        $ajaxEmpresa->validarDireccionUpdate();
    } else {
        $ajaxEmpresa->validarDireccion();
    }
}

if (isset($_POST['telefono'])) {
    $ajaxEmpresa->telefono = $_POST['telefono'];
    if (isset($_POST['operacion'])) {
        $ajaxEmpresa->url = $_POST['url'];
        $ajaxEmpresa->validarTelefonoUpdate();
    } else {
        $ajaxEmpresa->validarTelefono();
    }
}

if (isset($_POST['email'])) {
    $ajaxEmpresa->email = $_POST['email'];
    if (isset($_POST['operacion'])) {
        $ajaxEmpresa->url = $_POST['url'];
        $ajaxEmpresa->validarEmailUpdate();
    } else {
        $ajaxEmpresa->validarEmail();
    }
}

if (isset($_POST['url']) && isset($_POST['nombre'])) {
    $ajaxEmpresa->url = $_POST['url'];
    $ajaxEmpresa->empresaValidar = $_POST['nombre'];
    $ajaxEmpresa->validarEmpresaUpdate();
}

if(isset($_POST['id']) && isset($_POST['ope'])){
    $ajaxEmpresa->id = $_POST['id'];
    $ajaxEmpresa->ope = $_POST['ope'];
    $ajaxEmpresa->eliminarEmpresa();    
}
