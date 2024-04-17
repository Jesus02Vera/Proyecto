<?php

if(isset($_SESSION['validado'])){
    session_destroy();
    header("location:" . SERVERURL . "inicio");
}

?>