<?php
if (!isset($_SESSION['validado'])) {
    header("location:ingresar");
    exit();
}

$usuarioControlador = new UsuarioControlador();
if (isset($_POST['enviar'])) {
    $usuarioControlador->actualizarUsuarioControlador();
}

if (isset($_GET['action'])) {
    $action = explode("/", $_GET['action']);
    $lista = $usuarioControlador->listarUsuarioByIdControlador($action[2]);
}
?>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Editar Usuarios</h2>

                <form class="form-control" method="post" id="formUsuarioUpdate">
                    <input class="form-control" type="hidden" name="id" value="<?php print $lista['usuario_id'] ?>">
                    <label class="form-label" for="nombre">Nombre del Usuario: <span class="error"></span></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php print $lista['usuario_nombre'] ?>" />
                    <br>
                    <label class="form-label" for="email">Email del Usuario: <span class="error"></span></label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php print $lista['usuario_email'] ?>" />
                    <br>
                    <label class="form-label" for="password">Password del Usuario:<span class="error"></span></label>
                    <input class="form-control" type="password" name="password" id="password" value="" />
                    <br><br>
                    <input class="form-control" type="submit" value="Actualizar"  name="enviar" />
                </form>

                <script src="<?php echo SERVERURL; ?>Views/js/validarUsuarioUpdateJquery.js"></script>

                <?php
                if (isset($_GET["action"])) {
                    if (count($action) == 4) {
                        switch ($action[3]) {
                            case "okUp":
                                $msg = "Usuario Actualizado";
                                $class = "alert-primary";
                                break;

                            case "erUp":
                                $msg = "Usuario NO Actualizado";
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