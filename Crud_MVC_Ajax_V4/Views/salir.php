<?php

if(isset($_SESSION['validado'])){
    session_destroy();
    print '<div class="alert alert-primary text-center" role="alert">Gracias por utilizar este sistema</div>';
}

?>