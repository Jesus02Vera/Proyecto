<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}

$empresaControlador = new EmpresaGuardiasControlador();
if (isset($_GET['action'])) {
    $action = explode("/", $_GET['action']);
    if (count($action) == 3) {
        //$empresaControlador->eliminarEmpresaControlador($action[2]);
    }
}
if(isset($_POST['buscar'])){
    $datos = $empresaControlador->buscarEmpresaControlador();
}
else{
    $datos = $empresaControlador->listarEmpresaControlador();
}
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h1>Listado de Empresa</h1>
        <form class="d-flex" role="search" method="post">
            <input class="form-control me-2" type="search" name="datoBuscar" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="buscar">Search</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($datos as $key => $value) {
                    print "<tr id='fila" . $value['empresas_guardias_id'] . "'>";
                    print "<td>" . $value['empresas_guardias_id'] . "</td>";
                    print "<td>" . $value['empresas_guardias_nombre'] . "</td>";
                    print "<td>" . $value['empresas_guardias_direccion'] . "</td>";
                    print "<td>" . $value['empresas_guardias_telefono'] . "</td>";
                    print "<td>" . $value['empresas_guardias_correo'] . "</td>";
                    print "<th scope='row'><a href='" . SERVERURL . "empresaGuardias/editar/" . $value['empresas_guardias_id'] . "'><i class='bi bi-pencil-square'></i></a></th>";
                    print "<th scope='row'><a href='" . SERVERURL . "empresaGuardias/empresas/eliminar/" . $value['empresas_guardias_id'] . "' onclick='return validarEliminarEmpresa(event);'><i class='bi bi-trash-fill'></i></a></th>";
                    print "</tr>";
                }
                ?>
            </tbody>
        </table>
        <script src=<?php echo SERVERURL . "/Views/js/validarEliminarEmpresa.js" ?> ></script>
        <?php
        if (isset($action) && count($action) == 2) {
            switch ($action[1]) {
                case "okdel":
                    $msg = "Empresa eliminado correctamente";
                    $class = "alert-primary";
                    break;

                case "erdel":
                    $msg = "Error al eliminar una empresa";
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
