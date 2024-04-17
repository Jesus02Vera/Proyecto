<?php

class ProductoControlador {

    public function registrarProductoControlador() {
        //Validar los datos///
        $validarControlador = new ValidarDatosControlador();

        if (isset($_POST["nombre"]) && isset($_POST["cantidad"])) {

            $_SESSION['nombre'] = $_POST["nombre"];
            $_SESSION['cantidad'] = $_POST["cantidad"];
            $_SESSION['categoria_id'] = $_POST['categoria_id'];

            if ($validarControlador->validarCaracteresControlador($_POST['nombre'])) {
                header("location:" . SERVERURL . "producto/registrar/regNom");
                exit;
            } else if ($validarControlador->validarNumerosControlador($_POST['cantidad'])) {
                header("location:" . SERVERURL . "producto/registrar/regCant");
                exit;
            } 
            else if (!isset ($_POST['categoria_id'])){
                header("location:" . SERVERURL . "producto/registrar/regCate");
                exit;                
            }
            else {
                $productoModelo = new Producto();
                $productoModelo->setProductoNombre($_POST["nombre"]);
                $productoModelo->setProcudtoCantidad($_POST["cantidad"]);
                $productoModelo->setProductoCategoria_id($_POST['categoria_id']);

                $productoDao = new ProductoDAO();
                $respuesta = $productoDao->registrarProductoModelo($productoModelo);
                
                if ($respuesta == true) {
                    header("location:" . SERVERURL . "producto/registrar/okProd");
                } else {
                    header("location:" . SERVERURL . "producto/registrar/erProd");
                }
            }
        }
    }

    public function ingresarProductoControlador() {

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $patronCantidad = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
            $patronNombre = '/^[a-zA-Z0-9]*$/';

            if (!preg_match($patronNombre, $_POST['login'])) {
                header("location:" . SERVERURL . "producto/ingresar/ingNom");
                exit;
            } else if (!preg_match($patronCantidad, $_POST['password'])) {
                header("location:" . SERVERURL . "producto/ingresar/ingCla");
                exit;
            } else {
                $claveCryt = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("login" => $_POST['login']);

                $productoDAO = new ProductoDAO();
                $resultado = $productoDAO->ingresarProductoModelo($datos);


                $id = $resultado['producto_id'];
                $intentos = $resultado['intentos'];

                if ($intentos < 3) {
                    if ($resultado['producto_clave'] == $claveCryt) {
                        ///session_start();
                        $_SESSION['validado'] = true;
                        $_SESSION['user'] = $_POST['login'];
                        $productoDAO->actualizarIntentosModelo(0, $id);
                        header("location:" . SERVERURL . "producto/productos");
                    } else {
                        $productoDAO->actualizarIntentosModelo($intentos + 1, $id);
                        header("location:" . SERVERURL . "producto/ingresar/errval");
                    }
                } else {
                    header("location:" . SERVERURL . "producto/ingresar/erInt");
                }
            }
        }
    }

    public function actualizarProductoControlador() {
        $validarControlador = new ValidarDatosControlador();
        if (isset($_POST["nombre"]) && isset($_POST["cantidad"])) {
            if ($validarControlador->validarCaracteresControlador($_POST['nombre'])) {
                header("location:" . SERVERURL . "producto/editar/" . $_POST['id'] . "/regNom");
                exit;
            } else if ($validarControlador->validarNumerosControlador($_POST['cantidad'])) {
                header("location:" . SERVERURL . "producto/editar/" . $_POST['id'] . "/regCan");
                exit;
            } else {
                $datos = array("nombre" => $_POST["nombre"],
                    "cantidad" => $_POST["cantidad"],
                    "id" => $_POST['id']);

                $productoDao = new ProductoDAO();
                $respuesta = $productoDao->actualizarProductoModelo($datos);

                if ($respuesta == "success") {
                    header("location:" . SERVERURL . "producto/editar/" . $_POST['id'] . "/okUp");
                } else {
                    header("location:" . SERVERURL . "producto/editar/" . $_POST['id'] . "/erUp");
                }
            }
        }
    }

    public function listarProductosControlador() {
        $productoDao = new ProductoDAO();
        $listado = $productoDao->listarProductoModelo();
        return $listado;
    }

    public function listarProductoByIdControlador($id) {
        $productoDao = new ProductoDAO();
        $resultado = $productoDao->listarProductoByIdModelo($id);
        return $resultado;
    }

    public function eliminarProductoControlador($id) {
        $productoDao = new ProductoDAO();
       $respuesta = $productoDao->eliminarProductoModelo($id);
        return $respuesta;
    }

    public function validarProductoControlador($nombre) {
        $productoDao = new ProductoDAO();
        $respuesta = $productoDao->validarProductoModelo($nombre);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarEmailControlador($cantidad) {
        $productoDao = new ProductoDAO();
        $respuesta = $productoDao->validarEmailModelo($cantidad);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarProductoUpdateControlador($nombre, $id) {
        $respuesta = $this->listarProductoByIdControlador($id);
        if ($respuesta[1] == $nombre) {
            return "no";
        } else {
            return $this->validarProductoControlador($nombre);
        }
    }

    public function validarEmailUpdateControlador($cantidad, $id) {
        $productoDao = new ProductoDAO();
        $respuesta = $this->listarProductoByIdControlador($id);
        if ($respuesta[2] != $cantidad) {
            $respuesta = $productoDao->validarEmailModelo($cantidad);
            if ($respuesta > 0) {
                return "si";
            } else {
                return "no";
            }
        } else {
            return "no";
        }
    }

    public function buscarProductoControlador() {
        if(isset($_POST['buscarProducto'])){
            $productoDao = new ProductoDAO();
            return $productoDao->buscarProductoModelo($_POST['buscarProducto']);
        }
    }

}
