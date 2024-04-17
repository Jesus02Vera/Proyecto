<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}
if (!isset($_POST['registrar'])) {
    $usuarioControlador = new UsuarioControlador();
    $usuarioControlador->registrarUsuarioControlador();
}
?>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Registrar Usuarios</h2>
                <form method="post" id="formUsuario" class="form-control">
                    <label class="form-label" for="nombre">Nombre del Usuario: <span></span></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" maxlength="8" value="<?php (isset($_SESSION['nombre'])) ? print $_SESSION['nombre'] : print ""; ?>" />
                    <br>
                    <label class="form-label" for="email">Email del Usuario: <span></span></label>
                    <input  class="form-control" type="text" name="email" id="email" value="<?php (isset($_SESSION['email'])) ? print $_SESSION['email'] : print ""; ?>"/>
                    <br>
                    <label class="form-label" for="password">Password del Usuario:</label>
                    <input class="form-control" type="password" name="password" id="password" />
                    <br>
                    <label class="form-label" for="terminos">Aceptar Terminos y Condicones</label>
                    <input type="checkbox" name="terminos" id="terminos" value="si">
                    <br>
                    <br>
                    <input type="submit" value="Registrar" name="registrar" class="form-control" />
                </form>
                <script src="<?php echo SERVERURL; ?>Views/js/validarUsuario.js"></script>

                <?php
                if (isset($_GET['action'])) {
                    $accion = explode("/", $_GET['action']);
                    if (count($accion) > 2) {
                        switch ($accion[2]) {
                            case "okUser":
                                $msg = "Usuario Registrado";
                                $class = "alert-primary";
                                break;

                            case "erUser":
                                $msg = "Usuario NO Registrado";
                                $class = "alert-danger";
                                break;

                            case "regNom":
                                $msg = "Acceso denegado Nombre de Usuario";
                                $class = "alert-danger";
                                break;

                            case "regEmail":
                                $msg = "Acceso denegado Email de Usuario";
                                $class = "alert-danger";
                                break;

                            case "regCla":
                                $msg = "Acceso denegado Clave de Usuario";
                                $class = "alert-danger";
                                break;

                            case "regTer":
                                $msg = "Acceso denegado Terminos";
                                $class = "alert-danger";
                                break;
                        }
                    }

                    if (isset($msg)) {
                        print '<div class="alert ' . $class . '" role="alert">' . $msg . '</div>';
                    }
                }

                unset($_SESSION['nombre'], $_SESSION['email']);
                ?>

            </div>
        </div>
    </div>
    <div class="col"></div>
</div>

