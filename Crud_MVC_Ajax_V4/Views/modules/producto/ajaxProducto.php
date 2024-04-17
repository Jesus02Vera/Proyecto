<?php

include_once '../../../Controllers/productoControlador.php';
include_once '../../../Models/ProductoDAO.php';

class AjaxProducto {

    public $producto;
    public $email;
    public $url;
    public $ope;
    public $id;

    public function validarProducto() {
        $this->producto;
        $productoControlador = new ProductoControlador();
        $respuesta = $productoControlador->validarProductoControlador($this->producto);
        print $respuesta;
    }

    public function validarEmail() {
        $email = $this->email;
        $productoControlador = new ProductoControlador();
        $respuesta = $productoControlador->validarEmailControlador($email);
        print $respuesta;
    }

    public function validarProductoUpdate() {
        $url = explode("/", $this->url);
        $id = $url[3];
        $productoControlador = new ProductoControlador();
        $respuesta = $productoControlador->validarProductoUpdateControlador($this->producto, $id);
        print $respuesta;
    }

    public function eliminarProducto() {
        $productoControlador = new ProductoControlador();
        $respuesta = $productoControlador->eliminarProductoControlador($this->id);
        print $respuesta;
    }

}

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

$ajaxProducto = new AjaxProducto();

/*
  if (isset($_POST['nombre']) && !isset($_POST['url'])) {
  $ajaxProducto->producto = $_POST['nombre'];
  $ajaxProducto->validarProducto();
  }

  if (isset($_POST['url']) && isset($_POST['nombre'])) {
  $ajaxProducto->url = $_POST['url'];
  $ajaxProducto->producto = $_POST['nombre'];
  $ajaxProducto->validarProductoUpdate();
  } */

if (isset($_POST['id']) && isset($_POST['ope'])) {
    $ajaxProducto->id = $_POST['id'];
    $ajaxProducto->ope = $_POST['ope'];
    $ajaxProducto->eliminarProducto();
}
