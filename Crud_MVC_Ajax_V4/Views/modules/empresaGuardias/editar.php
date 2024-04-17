<?php
if (!isset($_SESSION['validado'])) {
    header("location:ingresar");
    exit();
}

$empresaControlador = new EmpresaGuardiasControlador();
if (isset($_POST['enviar'])) {
    $empresaControlador->actualizarEmpresaControlador();
}

if (isset($_GET['action'])) {
    $action = explode("/", $_GET['action']);
    $lista = $empresaControlador->listarEmpresaByIdControlador($action[2]);
}

?>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Editar Empresa</h2>

                <form class="form-control" method="post" id="formEmpresaGuardiaUpdate">
                    <input class="form-control" type="hidden" name="id" value="<?php print $lista['empresas_guardias_id'] ?>">
                    <label class="form-label" for="nombre">Nombre de la Empresa: <span class="error"></span></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php print $lista['empresas_guardias_nombre'] ?>" />
                    <br>
                    <label class="form-label" for="nombre">Direccion de la Empresa: <span class="error"></span></label>
                    <input class="form-control" type="text" name="direccion" id="direccion"" value="<?php print $lista['empresas_guardias_direccion'] ?>" />
                    <br>
                    <label class="form-label" for="nombre">Telefono de la Empresa: <span class="error"></span></label>
                    <input class="form-control" type="text" name="telefono" id="telefono" value="<?php print $lista['empresas_guardias_telefono'] ?>" />
                    <br>
                    <label class="form-label" for="email">Email del Usuario: <span class="error"></span></label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php print $lista['empresas_guardias_correo'] ?>" />                    
                    <br><br>
                    <input class="form-control" type="submit" value="Actualizar"  name="enviar" />
                </form>


                <script src="<?php echo SERVERURL; ?>Views/js/validarEmpresaUpdateJquery.js"></script>

                <?php
                if (isset($_GET["action"])) {
                    if (count($action) == 4) {
                        switch ($action[3]) {
                            case "okUp":
                                $msg = "Empresa Actualizada";
                                $class = "alert-primary";
                                break;

                            case "erUp":
                                $msg = "Empresa NO Actualizada";
                                $class = "alert-danger";
                                break;

                            default :
                                $msg = "";
                        }
                        print '<div class="alert ' . $class . ' text-center " role="alert">' . $msg . '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>