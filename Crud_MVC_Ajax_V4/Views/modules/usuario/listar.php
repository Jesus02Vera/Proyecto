<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}

$usuarioControlador = new UsuarioControlador();
if (isset($_GET['action'])) {
    $action = explode("/", $_GET['action']);
    if (count($action) == 3) {
        //$usuarioControlador->eliminarUsuarioControlador($action[2]);
    }
}
if(isset($_POST['buscar'])){
    $datos = $usuarioControlador->buscarUsuarioControlador();
}
else{
    $datos = $usuarioControlador->listarUsuariosControlador();
}
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h1>Listado de Usuarios</h1>
        <form class="d-flex" role="search" method="post">
            <input class="form-control me-2" type="search" name="datoBuscar" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="buscar">Search</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($datos as $key => $value) {
                    print "<tr id='fila" . $value['usuario_id'] . "'>";
                    print "<td>" . $value['usuario_id'] . "</td>";
                    print "<td>" . $value['usuario_nombre'] . "</td>";
                    print "<td>" . $value['usuario_email'] . "</td>";
                    print "<th scope='row'><a href='" . SERVERURL . "usuario/editar/" . $value['usuario_id'] . "'><i class='bi bi-pencil-square'></i></a></th>";
                    print "<th scope='row'><a href='" . SERVERURL . "usuario/usuarios/eliminar/" . $value['usuario_id'] . "' onclick='return validarEliminarRegistro(event);'><i class='bi bi-trash-fill'></i></a></th>";
                    print "</tr>";
                }
                ?>
            </tbody>
        </table>
        <script src=<?php echo SERVERURL . "/Views/js/validarEliminarRegistro.js" ?> ></script>
        <?php
        if (isset($action) && count($action) == 2) {
            switch ($action[1]) {
                case "okdel":
                    $msg = "Usuario eliminado correctamente";
                    $class = "alert-primary";
                    break;

                case "erdel":
                    $msg = "Error al eliminar un usuario";
                    $class = "alert-danger";
                    break;
            }
            if (isset($msg)) {
                print '<div class="alert ' . $class . '" role="alert">' . $msg . '</div>';
            }
        }
        ?>
    </div>
    <div class="col-2"></div>
</div>
