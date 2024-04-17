<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}

$productoControlador = new ProductoControlador();
if (isset($_POST['actualizar'])) {
    $productoControlador->actualizarProductoControlador();
}

if (isset($_GET['action'])) {
    $action = explode("/", $_GET['action']);
    $producto = $productoControlador->listarProductoByIdControlador($action[2]);
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col">

        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Editar Productos</h2>
                <form method="post" id="formProducto" class="form-control">
                    <input type="hidden" name="id" value="<?php print $producto['producto_id'] ?>">
                    <label  class="form-label" for="nombre">Nombre del Producto: <span></span></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php print $producto['producto_nombre']; ?>" />
                    <br>
                    <label  class="form-label" for="cantidad">Cantidad del producto: <span></span></label>
                    <input  class="form-control" type="text" class="form-label"  name="cantidad" id="cantidad" value="<?php print $producto['producto_cantidad']; ?>"/>
                    <br>
                    <input  class="form-control" type="submit" value="Actualizar" name="actualizar" />
                </form>
                <script src="<?php echo SERVERURL; ?>Views/js/validarUsuarioUpdateJquery.js"></script>

                <?php
                if (isset($_GET["action"])) {
                    if (count($action) == 4) {
                        switch ($action[3]) {
                            case "okUp":
                                $msg = "Producto Actualizado";
                                $class = "alert-primary";
                                break;

                            case "erUp":
                                $msg = "Error: Producto NO Actualizado";
                                $class = "alert-danger";
                                break;

                            case "regNom":
                                $msg = "Error En El Nombre de Producto";
                                $class = "alert-danger";
                                break;

                            case "regCan":
                                $msg = "Error La Cantidad de Producto Deben Ser Numeros";
                                $class = "alert-danger";
                                break;
                        }
                        print '<div class="alert ' . $class . ' text-center" role="alert">' . $msg . '</div>';
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <div class="col"></div>
</div>