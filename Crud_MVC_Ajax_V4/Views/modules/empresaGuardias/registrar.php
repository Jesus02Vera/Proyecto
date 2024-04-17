<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}
if (!isset($_POST['registrar'])) {
    $empresaGuardiaControlador = new EmpresaGuardiasControlador();
    $empresaGuardiaControlador->registrarEmpresaControlador();
}

?>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Registrar Empresa</h2>
                <form method="post" id="formEmpresaGuardia">
                    <label class="form-label" for="nombre">Nombre de la Empresa es: <span></span></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" maxlength="15" value="<?php (isset($_SESSION['nombre'])) ? print $_SESSION['nombre'] : print ""; ?>" />
                    <br>
                    <label class="form-label" for="direccion">La dirección de la Empresa es: <span></span></label>
                    <input class="form-control" type="text" name="direccion" id="direccion" value="<?php (isset($_SESSION['direccion'])) ? print $_SESSION['direccion'] : print ""; ?>"/>
                    <br>
                    <label class="form-label" for="telefono">El teléfono de la Empresa es: <span></span></label>
                    <input class="form-control" type="text" name="telefono" id="telefono" value="<?php (isset($_SESSION['telefono'])) ? print $_SESSION['telefono'] : print ""; ?>"/>
                    <br>    
                    <label class="form-label" for="email">Correo de la Empresa es: <span></span></label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php (isset($_SESSION['email'])) ? print $_SESSION['email'] : print ""; ?>"/>
                    <br>
                    <br>
                    <input class="form-control" type="submit" value="Registrar" name="registrar" />
                </form>

                <script src="<?php echo SERVERURL; ?>Views/js/validarEmpresa.js"></script>

                <?php
                if (isset($_GET['action'])) {
                    $accion = explode("/", $_GET['action']);
                    if (count($accion) > 2) {
                        switch ($accion[2]) {
                            case "okEmp":
                                $msg = "Empresa Registrada";
                                $class = "alert-primary";
                                break;

                            case "erEmp":
                                $msg = "Empresa NO Registrada";
                                $class = "alert-danger";
                                break;

                            case "regNom":
                                $msg = "Acceso denegado Nombre de Usuario";
                                $class = "alert-danger";
                                break;
                            
                            case "regDir":
                                $msg = "Acceso denegado Direccion";
                                break;

                            case "regTel":
                                $msg = "Acceso denegado Telefono";
                                break;

                            case "regEmail":
                                $msg = "Acceso denegado Email de Usuario";
                                $class = "alert-danger";
                                break;
                        }
                    }

                    if (isset($msg)) {
                        print '<div class="alert ' . $class . '" role="alert">' . $msg . '</div>';
                    }
                }

                unset($_SESSION['nombre'], $_SESSION['direccion'], $_SESSION['telefono'], $_SESSION['email']);
                ?>

            </div>
        </div>
    </div>
    <div class="col"></div>
</div>


