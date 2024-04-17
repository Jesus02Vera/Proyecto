<?php
class CategoriaControlador {
   
    public function listarCategoriaControlador() {
        $categoriaDao = new CategoriaDAO();
        $categorias = $categoriaDao->listarCategoriaModelo();
        return $categorias;
    }
    
}
