<?php

/* CONTROLADORES */
include_once 'Controllers/Controlador.php';
include_once 'Controllers/UsuarioControlador.php';
include_once 'Controllers/EmpresaGuardiasControlador.php';
include_once 'Controllers/ProductoControlador.php';
include_once 'Controllers/ValidarDatosControlador.php';
include_once 'Controllers/CategoriaControlador.php';


/* MODELOS */
include_once 'Models/EnlacesPaginasModelo.php';
include_once 'Models/UsuarioDAO.php';
include_once 'Models/EmpresaGuardiasDAO.php';
include_once 'Models/EmpresaGuardias.php';
include_once 'Models/Usuario.php';
include_once 'Models/ProductoDAO.php';
include_once 'Models/Producto.php';
include_once 'Models/CategoriaDAO.php';

$controlador = new Controlador();
$controlador->cargarTemplate();
?>


