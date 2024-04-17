<?php

class EnlacesPaginasModelo {

    public function enlacesPagina($enlace) {
        if (count($enlace) == 1) {
            $modulo = "Views/modules/" . $enlace[0] . ".php";
        } else {
            $modulo = "Views/modules/" . $enlace[0] . "/" . $enlace[1] . ".php";
        }
        if (!file_exists($modulo)) {
            $modulo = "Views/modules/inicio.php";
        }
        ///print $modulo;
        return $modulo;
        
    }

}
