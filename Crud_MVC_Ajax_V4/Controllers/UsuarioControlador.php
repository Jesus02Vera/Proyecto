<?php

class UsuarioControlador {

    public function registrarUsuarioControlador() {
        //Validar los datos///

        $validarControlador = new ValidarDatosControlador();

        $patronClave = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
        $patronNombre = '/^[a-zA-Z0-9]*$/';

        if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"])) {

            $_SESSION['nombre'] = $_POST["nombre"];
            $_SESSION['email'] = $_POST["email"];

            if ($validarControlador->validarNombreUsuarioControlador($_POST['nombre'])) {
                header("location:" . SERVERURL . "usuario/registrar/regNom");
                exit;
            } else if ($validarControlador->validarEmail($_POST['email'])) {
                header("location:" . SERVERURL . "usuario/registrar/regEmail");
                exit;
            } else if ($validarControlador->validarPasswordUsuario($_POST['password'])) {
                header("location:" . SERVERURL . "usuario/registrar/regCla");
                exit;
            } else if (!isset($_POST['terminos'])) {
                header("location:" . SERVERURL . "usuario/registrar/regTer");
                exit;
            } else {
                $claveCryt = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $usuario = new Usuario();
                $usuario->setNombre($_POST['nombre']);
                $usuario->setEmail($_POST['email']);
                $usuario->setClave($claveCryt);

                $usuarioDao = new UsuarioDAO();
                $respuesta = $usuarioDao->registrarUsuarioModelo($usuario);

                if ($respuesta == true) {
                    header("location:" . SERVERURL . "usuario/registrar/okUser");
                } else {
                    header("location:" . SERVERURL . "usuario/registrar/erUser");
                }
            }
        }
    }

    public function ingresarUsuarioControlador() {

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $patronClave = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
            $patronNombre = '/^[a-zA-Z0-9]*$/';

            if (!preg_match($patronNombre, $_POST['login'])) {
                header("location:" . SERVERURL . "usuario/ingresar/ingNom");
                exit;
            } else if (!preg_match($patronClave, $_POST['password'])) {
                header("location:" . SERVERURL . "usuario/ingresar/ingCla");
                exit;
            } else {
                $claveCryt = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("login" => $_POST['login']);

                $usuarioDAO = new UsuarioDAO();
                $resultado = $usuarioDAO->ingresarUsuarioModelo($datos);


                $id = $resultado['usuario_id'];
                $intentos = $resultado['intentos'];

                if ($intentos < 3) {
                    if ($resultado['usuario_clave'] == $claveCryt) {
                        ///session_start();
                        $_SESSION['validado'] = true;
                        $_SESSION['user'] = $_POST['login'];
                        $usuarioDAO->actualizarIntentosModelo(0, $id);
                        header("location:" . SERVERURL . "usuario/usuarios");
                    } else {
                        $usuarioDAO->actualizarIntentosModelo($intentos + 1, $id);
                        header("location:" . SERVERURL . "usuario/ingresar/errval");
                    }
                } else {
                    header("location:" . SERVERURL . "usuario/ingresar/erInt");
                }
            }
        }
    }

    public function actualizarUsuarioControlador() {
        $patronClave = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
        $patronNombre = '/^[a-zA-Z0-9]*$/';

        if (isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            if (!preg_match($patronNombre, $_POST['nombre'])) {
                header("location:" . SERVERURL . "usuario/editar/" . $_POST['id'] . "/regNom");
                exit;
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                header("location:" . SERVERURL . "usuario/editar/" . $_POST['id'] . "/regEmail");
                exit;
            } else if (!preg_match($patronClave, $_POST['password'])) {
                header("location:" . SERVERURL . "usuario/editar/" . $_POST['id'] . "/regCla");
                exit;
            } else {
                $claveCryt = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos = array("nombre" => $_POST["nombre"],
                    "email" => $_POST["email"],
                    "password" => $claveCryt,
                    "id" => $_POST['id']);

                $usuarioDao = new UsuarioDAO();
                $respuesta = $usuarioDao->actualizarUsuarioModelo($datos);

                if ($respuesta == "success") {
                    header("location:" . SERVERURL . "usuario/editar/" . $_POST['id'] . "/okUp");
                } else {
                    header("location:" . SERVERURL . "usuario/editar/" . $_POST['id'] . "/erUp");
                }
            }
        }
    }

    public function listarUsuariosControlador() {
        $usuarioDao = new UsuarioDAO();
        $listado = $usuarioDao->listarUsuarioModelo();
        return $listado;
    }

    public function listarUsuarioByIdControlador($id) {
        $usuarioDao = new UsuarioDAO();
        $resultado = $usuarioDao->listarUsuarioByIdModelo($id);
        return $resultado;
    }

    public function eliminarUsuarioControlador($id) {
        $usuarioDao = new UsuarioDAO();
        $respuesta = $usuarioDao->eliminarUsuarioModelo($id);
        return $respuesta;
    }

    public function validarUsuarioControlador($nombre) {
        $usuarioDao = new UsuarioDAO();
        $respuesta = $usuarioDao->validarUsuarioModelo($nombre);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarEmailControlador($email) {
        $usuarioDao = new UsuarioDAO();
        $respuesta = $usuarioDao->validarEmailModelo($email);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarUsuarioUpdateControlador($nombre, $id) {
        $respuesta = $this->listarUsuarioByIdControlador($id);
        if ($respuesta[1] == $nombre) {
            return "no";
        } else {
            return $this->validarUsuarioControlador($nombre);
        }
    }

    public function validarEmailUpdateControlador($email, $id) {
        $usuarioDao = new UsuarioDAO();
        $respuesta = $this->listarUsuarioByIdControlador($id);
        if ($respuesta[2] != $email) {
            $respuesta = $usuarioDao->validarEmailModelo($email);
            if ($respuesta > 0) {
                return "si";
            } else {
                return "no";
            }
        } else {
            return "no";
        }
    }

    public function buscarUsuarioControlador() {
        if (isset($_POST['datoBuscar'])) {
            $usuarioDao = new UsuarioDAO();
            $usuarios = $usuarioDao->buscarUsuarioModelo($_POST['datoBuscar']);
            return $usuarios;
        }
    }

}
