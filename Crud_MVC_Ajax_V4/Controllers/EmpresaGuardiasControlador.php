<?php

class EmpresaGuardiasControlador {

    public function registrarEmpresaControlador() {
        //Validar los datos///

        $validarControlador = new ValidarDatosControlador();

        $patronNumeros = '/^\d{10}$/';
        $patronDireccion = '/^[a-zA-Z0-9 \t\r\n\-\.,]+$/';
        $patronNombre = '/^[a-zA-Z0-9]*$/';

        if (isset($_POST["nombre"]) && isset($_POST["direccion"]) && isset($_POST["telefono"]) && isset($_POST["email"])) {

            $_SESSION['nombre'] = $_POST["nombre"];
            $_SESSION['direccion'] = $_POST["direccion"];
            $_SESSION['telefono'] = $_POST["telefono"];
            $_SESSION['email'] = $_POST["email"];

            if ($validarControlador->validarNombreEmpresaControlador($_POST['nombre'])) {
                header("location:" . SERVERURL . "empresaGuardias/registrar/regNom");
                exit;
            } else if ($validarControlador->validarDireccionControlador($_POST['direccion'])) {
                header("location:" . SERVERURL . "usuario/registrar/regDir");
                exit;
            } else if ($validarControlador->validarNumerosControlador($_POST['telefono'])) {
                header("location:" . SERVERURL . "usuario/registrar/regEmail");
                exit;
            } else if ($validarControlador->validarEmail($_POST['email'])) {
                header("location:" . SERVERURL . "usuario/registrar/regEmail");
                exit;
           
            } else {
                
                $empresa = new EmpresaGuardias();
                $empresa->setNombre($_POST['nombre']);
                $empresa->setDireccion($_POST['nombre']);
                $empresa->setTelefono($_POST['nombre']);
                $empresa->setEmail($_POST['email']);
               

                $empresaDao = new EmpresaGuardiasDAO();
                $respuesta = $empresaDao->registrarEmpresaModelo($empresa);

                if ($respuesta == true) {
                    header("location:" . SERVERURL . "empresaGuardias/registrar/okEmp");
                } else {
                    header("location:" . SERVERURL . "empresaGuardias/registrar/erEmp");
                }

            }
        }
    }

    public function actualizarEmpresaControlador() {

        $patronNombre = '/^[a-zA-Z0-15]*$/';
        $patronDireccion = '/^[a-zA-Z0-9 \t\r\n\-\.,]+$/';
        $patronNumeros = '/^\d{10}$/';

        if (isset($_POST["nombre"]) && isset($_POST["direccion"]) && isset($_POST["telefono"]) && isset($_POST["email"])) {
            if (!preg_match($patronNombre, $_POST['nombre'])) {
                header("location:" . SERVERURL . "empresaGuardias/editar/" . $_POST['id'] . "/regNom");
                exit;
            } else if (!preg_match($patronNumeros, $_POST['direccion'])) {
                header("location:" . SERVERURL . "empresaGuardias/editar/" . $_POST['id'] . "/regDir");
                exit;
            } else if (!preg_match($_POST['telefono'])) {
                header("location:" . SERVERURL . "empresaGuardias/editar/" . $_POST['id'] . "/regTel");
                exit;
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                header("location:" . SERVERURL . "empresaGuardias/editar/" . $_POST['id'] . "/regEmail");
                exit;
            
            } else {
                
                $datos = array("nombre" => $_POST["nombre"],
                    "direccion" => $_POST["direccion"],
                    "telefono" => $_POST["telefono"],
                    "email" => $_POST["email"],
                    "id" => $_POST['id']);

                $empresaDao = new EmpresaGuardiasDAO();
                $respuesta = $empresaDao->actualizarEmpresaModelo($datos);

                if ($respuesta == "success") {
                    header("location:" . SERVERURL . "empresaGuardias/editar/" . $_POST['id'] . "/okUp");
                } else {
                    header("location:" . SERVERURL . "empresaGuardias/editar/" . $_POST['id'] . "/erUp");
                }
            }
        }
    }

    public function listarEmpresaControlador() {
        $empresaDao = new EmpresaGuardiasDAO();
        $listado = $empresaDao->listarEmpresaModelo();
        return $listado;
    }

    public function listarEmpresaByIdControlador($id) {
        $empresaDao = new EmpresaGuardiasDAO();
        $resultado = $empresaDao->listarEmpresaByIdModelo($id);
        return $resultado;
    }

    public function eliminarEmpresaControlador($id) {
        $empresaDao = new EmpresaGuardiasDAO();
        $respuesta = $empresaDao->eliminarEmpresaModelo($id);
        return $respuesta;
    }

    public function validarEmpresaControlador($nombre) {
        $empresaDao = new EmpresaGuardiasDAO();
        $respuesta = $empresaDao->validarEmpresaModelo($nombre);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarDireccionControlador($direccion) {
        $empresaDao = new EmpresaGuardiasDAO();
        $respuesta = $empresaDao->validarDireccionModelo($direccion);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarTelefonoControlador($telefono) {
        $empresaDao = new EmpresaGuardiasDAO();
        $respuesta = $empresaDao->validarTelefonoModelo($telefono);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarEmailControlador($email) {
        $empresaDao = new EmpresaGuardiasDAO();
        $respuesta = $empresaDao->validarEmailModelo($email);
        if ($respuesta > 0) {
            return "si";
        } else {
            return "no";
        }
    }

    public function validarEmpresaUpdateControlador($nombre, $id) {
        $respuesta = $this->listarEmpresaByIdControlador($id);
        if ($respuesta[1] == $nombre) {
            return "no";
        } else {
            return $this->validarEmpresaControlador($nombre);
        }
    }

    public function validarDireccionUpdateControlador($direccion, $id) {
        $respuesta = $this->listarEmpresaByIdControlador($id);
        if ($respuesta[1] == $direccion) {
            return "no";
        } else {
            return $this->validarDireccionControlador($direccion);
        }
    }

    public function validarTelefonoUpdateControlador($telefono, $id) {
        $respuesta = $this->listarEmpresaByIdControlador($id);
        if ($respuesta[1] == $telefono) {
            return "no";
        } else {
            return $this->validarTelefonoControlador($telefono);
        }
    }

    public function validarEmailUpdateControlador($email, $id) {
        $empresaDao = new EmpresaGuardiasDAO();
        $respuesta = $this->listarEmpresaByIdControlador($id);
        if ($respuesta[2] != $email) {
            $respuesta = $empresaDao->validarEmailModelo($email);
            if ($respuesta > 0) {
                return "si";
            } else {
                return "no";
            }
        } else {
            return "no";
        }
    }

    public function buscarEmpresaControlador() {
        if (isset($_POST['datoBuscar'])) {
            $empresaDao = new EmpresaGuardiasDAO();
            $empresa = $empresaDao->buscarEmpresaModelo($_POST['datoBuscar']);
            return $empresa;
        }
    }
}
