<?php

if (!file_exists('config/Conexion.php')) {
    require_once '../../../config/Conexion.php';
} else {
    require_once 'config/Conexion.php';
}

class ProductoDAO extends Conexion {

    public function registrarProductoModelo(Producto $producto) {
        
        $nombre = $producto->getProductoNombre();
        $cantidad = $producto->getProcudtoCantidad();
        $categoria = $producto->getProductoCategoria_id();
        
        $sql = "insert into producto (producto_nombre, producto_cantidad, producto_categoria_id)
            values(:nombre, :cantidad, :categoria)";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
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

    public function ingresarProductoModelo($datos) {
        $sql = "SELECT producto_id, producto_nombre, , intentos FROM producto WHERE producto_nombre = :nombre";

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

    public function listarProductoModelo() {
        $sql = "SELECT producto_id, producto_nombre, producto_cantidad FROM producto order by producto_nombre";
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

    public function listarProductoByIdModelo($id) {
        $sql = "select producto_id, producto_nombre, producto_cantidad from producto where producto_id = :id";
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

    public function actualizarProductoModelo($datos) {
        $sql = "UPDATE producto SET producto_nombre = :nombre, producto_cantidad = :cantidad WHERE producto_id = :id";

        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_INT);
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

    public function eliminarProductoModelo($id) {
        $sql = "delete from producto where producto_id = :id";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
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
    }

    public function actualizarIntentosModelo($intentos, $id) {
        $sql = "update producto set intentos = :intentos where producto_id = :id";

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

    public function validarProductoModelo($nombre) {
        $sql = "SELECT producto_id, producto_nombre FROM producto WHERE producto_nombre = :nombre";
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

    public function validarEmailModelo($cantidad) {
        $sql = "SELECT producto_cantidad FROM producto WHERE producto_cantidad = :cantidad";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function buscarProductoModelo($datoBuscar) {
        $sql = "SELECT producto_id, producto_nombre, producto_cantidad FROM producto WHERE "
                . "producto_nombre like '%' :nombre '%' or producto_cantidad = :cantidad";

        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(':nombre', $datoBuscar, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $datoBuscar, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
            $conexion = null;
            $stmt = null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
