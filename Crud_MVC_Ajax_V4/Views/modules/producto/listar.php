<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}

$productoControlador = new ProductoControlador();

if (isset($_POST['buscarProducto'])) {
    $datos = $productoControlador->buscarProductoControlador();
} else {
    $datos = $productoControlador->listarProductosControlador();
}
?>

<div class="row">
    <div class="col-2"></div>
    <div class="col-8">

        <h1>Listado de Productos</h1>
        <form method="post" class="d-flex" role="search">
            <input type="search" name="buscarProducto"class="form-control me-2" placeholder="Buscar Productos" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>

        <center>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($datos as $key => $value) {
                        print "<tr id='fila" . $value['producto_id'] . "'>";
                        print "<td>" . $value['producto_id'] . "</td>";
                        print "<td>" . $value['producto_nombre'] . "</td>";
                        print "<td>" . $value['producto_cantidad'] . "</td>";
                        print "<th scope='row'><a href='" . SERVERURL . "producto/editar/" . $value['producto_id'] . "'><i class='bi bi-pencil-square'></i></a></th>";
                        print "<th scope='row'><a href='" . SERVERURL . "producto/productos/eliminar/" . $value['producto_id'] . "' onclick='return validarEliminarRegistro(event);'><i class='bi bi-trash-fill'></i></a></th>";
                        print "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </center>
        <script src=<?php echo SERVERURL . "/Views/js/validarEliminarProducto.js" ?> ></script>
        <?php
        if (isset($action) && count($action) == 2) {
            switch ($action[1]) {
                case "okdel":
                    $msg = "Producto eliminado correctamente";
                    $class = "alert-primary";
                    break;

                case "erdel":
                    $msg = "Error al eliminar un producto";
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