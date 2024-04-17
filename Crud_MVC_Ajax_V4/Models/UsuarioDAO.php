<?php

if (!file_exists('config/Conexion.php')) {
    require_once '../../../config/Conexion.php';
} else {
    require_once 'config/Conexion.php';
}

class UsuarioDAO extends Conexion {

    public function registrarUsuarioModelo(Usuario $usuario) {
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $clave = $usuario->getClave();
        
        $sql = "insert into usuario 
            (usuario_nombre, usuario_email, usuario_clave)
            values(:nombre,:email,:password)";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $clave, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $conexion = null;
                $stmt = null;
                return "success";
            } else {
                return "error";
            }
        } catch (Exception $ex) {
            print "<p>Fallo<p>";
        }
    }

    public function ingresarUsuarioModelo($datos) {
        $sql = "SELECT usuario_id, usuario_nombre, usuario_clave, intentos FROM usuario WHERE usuario_nombre = :nombre";

        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datos['login'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $ex) {
            print "Error " . $ex->getMessage();
        }
    }

    public function listarUsuarioModelo() {
        $sql = "SELECT usuario_id, usuario_nombre, usuario_email FROM usuario order by usuario_nombre";
        // print $sql;
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listarUsuarioByIdModelo($id) {
        $sql = "select usuario_id, usuario_nombre, usuario_email from usuario where usuario_id = :id";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actualizarUsuarioModelo($datos) {
        $sql = "update usuario set usuario_nombre= :nombre, "
                . "usuario_email= :email,usuario_clave= :password "
                . "where usuario_id = :id";

        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos['password'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $conexion = null;
                $stmt = null;
                return "success";
            } else {
                return "error";
            }
        } catch (Exception $ex) {
            print "<p>Fallo<p>";
        }
    }

    public function eliminarUsuarioModelo($id) {
        $sql1 = "select count(*) as valor from usuario";
        $sql2 = "delete from usuario where usuario_id = :id";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql1);
            if ($stmt->execute()) {
                $usuarios = $stmt->fetch();
            }
            if ($usuarios['valor'] > 1) {
                try {
                    $stmt = null;
                    $stmt = $conexion->conectar()->prepare($sql2);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        return "success";
                        $conexion = null;
                        $stmt = null;
                    } else {
                        return "error";
                    }
                } catch (Exception $ex) {
                    
                }
            } else {
                return "error";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actualizarIntentosModelo($intentos, $id) {
        $sql = "update usuario set intentos = :intentos where usuario_id = :id";

        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":intentos", $intentos, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $conexion = null;
                $stmt = null;
            } else {
                return "error";
            }
        } catch (Exception $ex) {
            print "<p>Fallo<p>";
        }
    }

    public function validarUsuarioModelo($nombre) {
        $sql = "SELECT usuario_id, usuario_nombre FROM usuario WHERE usuario_nombre = :nombre";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function validarEmailModelo($email) {
        $sql = "SELECT usuario_email FROM usuario WHERE usuario_email = :email";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function buscarUsuarioModelo($datoBuscar) {
        $sql = "SELECT usuario_id, usuario_nombre, usuario_email FROM usuario WHERE "
                . "usuario_nombre like '%' :nombre '%' or usuario_email like '%' :email '%' ";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datoBuscar, PDO::PARAM_STR);
            $stmt->bindParam(":email", $datoBuscar, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $conexion = null;
            $stmt = null;
        } catch (Exception $ex) {
            
        }
    }

}
