<?php

/**
 * Description of Producto
 * @author ercruz
 */
class Producto {
    private $productoId;
    private $productoNombre;
    private $procudtoCantidad;
    private $productoCategoria_id;
    private $categoriaNombre;
    
    function __construct() {
        
    }

    function getProductoId() {
        return $this->productoId;
    }

    function getProductoNombre() {
        return $this->productoNombre;
    }

    function getProcudtoCantidad() {
        return $this->procudtoCantidad;
    }

    function getProductoCategoria_id() {
        return $this->productoCategoria_id;
    }

    function getCategoriaNombre() {
        return $this->categoriaNombre;
    }

    function setProductoId($productoId) {
        $this->productoId = $productoId;
    }

    function setProductoNombre($productoNombre) {
        $this->productoNombre = $productoNombre;
    }

    function setProcudtoCantidad($procudtoCantidad) {
        $this->procudtoCantidad = $procudtoCantidad;
    }

    function setProductoCategoria_id($productoCategoria_id) {
        $this->productoCategoria_id = $productoCategoria_id;
    }

    function setCategoriaNombre($categoriaNombre) {
        $this->categoriaNombre = $categoriaNombre;
    }


}
