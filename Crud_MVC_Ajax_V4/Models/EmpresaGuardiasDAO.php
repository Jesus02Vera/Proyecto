<?php

if (!file_exists('config/Conexion.php')) {
    require_once '../../../config/Conexion.php';
} else {
    require_once 'config/Conexion.php';
}

class EmpresaGuardiasDAO extends Conexion {
    
    public function registrarEmpresaModelo(EmpresaGuardias $empresa) {
        
        $nombre = $empresa->getNombre();
        $direccion = $empresa->getDireccion();
        $telefono = $empresa->getTelefono();
        $email = $empresa->getEmail();
        
        $sql = "insert into empresas_guardias 
            (empresas_guardias_nombre, empresas_guardias_direccion,
            empresas_guardias_telefono, empresas_guardias_correo)
            values(:nombre,:direccion,:telefono, :email)";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $$direccion, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_INT);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
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
    
    public function listarEmpresaModelo() {
        $sql = "SELECT empresas_guardias_id, empresas_guardias_nombre, empresas_guardias_direccion,"
                . "empresas_guardias_telefono, empresas_guardias_correo FROM empresas_guardias order by empresas_guardias_nombre";
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

    public function listarEmpresaByIdModelo($id) {
        $sql = "select empresas_guardias_id, empresas_guardias_nombre, empresas_guardias_direccion,"
                . "empresas_guardias_telefono, empresas_guardias_correo from empresas_guardias where empresas_guardias_id = :id";
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

    public function actualizarEmpresaModelo($datos) {
        $sql = "update empresas_guardias set empresas_guardias_nombre = :nombre, empresas_guardias_direccion= :direccion "
                . "empresas_guardias_telefono= :telefono ,empresas_guardias_correo= :email "
                . "where empresas_guardias_id = :id";

        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos['direccion'], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos['telefono'], PDO::PARAM_INT);
            $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);            
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

    public function eliminarEmpresaModelo($id) {
        $sql1 = "select count(*) as valor from empresas_guardias";
        $sql2 = "delete from empresas_guardias where empresas_guardias_id = :id";
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
    public function validarEmpresaModelo($nombre) {
        $sql = "SELECT empresas_guardias_id, empresas_guardias_nombre FROM empresas_guardias WHERE empresas_guardias_nombre = :nombre";
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

    public function validarDireccionModelo($direccion) {
        $sql = "SELECT empresas_guardias_direccion FROM empresas_guardias WHERE empresas_guardias_direccion = :direccion";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function validarTelefonoModelo($telefono) {
        $sql = "SELECT empresas_guardias_telefono FROM empresas_guardias WHERE empresas_guardias_telefono = :telefono";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function validarEmailModelo($email) {
        $sql = "SELECT empresas_guardias_correo FROM empresas_guardias WHERE empresas_guardias_correo = :email";
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
    
    public function buscarEmpresaModelo($datoBuscar) {
        $sql = "SELECT empresas_guardias_id, empresas_guardias_nombre, empresas_guardias_direccion,"
                . "empresas_guardias_telefono, empresas_guardias_correo FROM empresas_guardias WHERE "
                . "empresas_guardias_nombre like '%' :nombre '%' or empresas_guardias_direccion like '%' :direccion '%'"
                . "or empresas_guardias_telefono like '%' :telefono '%' or empresas_guardias_correo like '%' :email '%'";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datoBuscar, PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datoBuscar, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datoBuscar, PDO::PARAM_INT);
            $stmt->bindParam(":email", $datoBuscar, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $conexion = null;
            $stmt = null;
        } catch (Exception $ex) {
            
        }
    }
}

