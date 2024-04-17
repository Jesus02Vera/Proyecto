<?php
class CategoriaDAO {
    
    public function listarCategoriaModelo(){
        $sql = "select * from categoria";
        try {
            $conexion = new Conexion();
            $stmt = $conexion->conectar()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll();
                $conexion = null;
                $stmt = null;
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }
    
}
