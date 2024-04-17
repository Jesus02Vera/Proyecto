<?php

class Conexion {

    public function conectar() {
        $pdo = new PDO("mysql:host=localhost;dbname=condominio_v2", "root", "031208");
        return $pdo;
//        var_dump($pdo);
    }
}
