<?php
if (isset($_POST['login']) && isset($_POST['password'])) {
    $usuarioControlador = new UsuarioControlador();
    $usuarioControlador->ingresarUsuarioControlador();
}
?>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Login</h2>
                <form method="POST"  class="form-control">
                    <label class="form-label">Ingrese el usuario</label>
                    <input class="form-control" type="text" name="login" value="" required="" />
                    <br>
                    <label class="form-label">Ingrese su clave </label>
                    <input class="form-control" type="password" name="password" value="" required="" />
                    <br>
                    <br>
                    <input class="form-control" type="submit" value="Ingresar" name="ingresar" />
                </form>

                <?php
//var_dump($_GET['action']);

                if (isset($_GET['action'])) {
                    $action = explode("/", $_GET['action']);
                    if (count($action) > 2) {
                        switch ($action[2]) {
                            case "errval":
                                $msg = "Usuario no concuerdan sus credenciales";
                                break;

                            case "ingNom":
                                $msg = "Error al ingresar el nombre<br>Digite solo numeros y caracteres en minuscula y/o mayuscula";
                                break;

                            case "ingCla":
                                $msg = "Error al ingresr la clave<br>La clave debe contener al menos un número y una letra mayúscula y minúscula, y al menos 6 o más caracteres";
                                break;

                            case "erInt":
                                $msg = "Ha superado el numero de intentos fallidos<br>Consulte a su administrador";
                                break;

                            default :
                                $msg = "";
                        }

                        if (isset($msg)) {
                            print "<center>" . $msg . "</center>";
                        }
                    }
                }
                ?>        
            </div>
        </div>        
    </div>
    <div class="col"></div>
</div>
