<?php
if (!isset($_SESSION['validado'])) {
    header("location:" . SERVERURL . "login");
    exit();
}

$categoriaControlador = new CategoriaControlador();
$categorias = $categoriaControlador->listarCategoriaControlador();

if (isset($_POST['registrar'])) {
    $productoControlador = new ProductoControlador();
    $productoControlador->registrarProductoControlador();
}
?>

<div class="row">

    <div class="col"></div>
    <div class="col">

        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title">Registrar Productos</h2>
                <form method="post" id="formProducto" class="form-control">
                    <label  class="form-label" for="nombre">Nombre del Producto: <span></span></label>
                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php (isset($_SESSION['nombre'])) ? print $_SESSION['nombre'] : print ""; ?>" />
                    <br>
                    <label  class="form-label" for="cantidad">Cantidad del producto: <span></span></label>
                    <input  class="form-control" type="text" class="form-label"  name="cantidad" id="cantidad" value="<?php (isset($_SESSION['cantidad'])) ? print $_SESSION['cantidad'] : print ""; ?>"/>
                    <br>
                    <label  class="form-label" for="categoria">Categoriadel producto: <span></span></label>
                    <select class="form-control" name="categoria_id" id="categoria_id">
                        <option value="0">Seleccione una categoria</option>
                        <?php
                        for ($i = 0; $i < count($categorias); $i++) {
                            print '<option value = "' . $categorias[$i]['categoria_id'] . '">' . $categorias[$i]['categoria_nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <input  class="form-control" type="submit" value="Registrar" name="registrar" />
                </form>
                <!--<script src="<?php echo SERVERURL; ?>Views/js/validarProducto.js"></script>-->

                <?php
                if (isset($_GET['action'])) {
                    $accion = explode("/", $_GET['action']);
                    if (count($accion) > 2) {
                        switch ($accion[2]) {
                            case "okProd":
                                $msg = "Producto Registrado";
                                $class = "alert-primary";
                                break;

                            case "erProd":
                                $msg = "Producto NO Registrado";
                                $class = "alert-danger";
                                break;

                            case "regNom":
                                $msg = "Acceso denegado Nombre de Producto";
                                $class = "alert-danger";
                                break;

                            case "regCant":
                                $msg = "Acceso denegado Cantidad de Producto";
                                $class = "alert-danger";
                                break;
                            
                            case "regCate":
                                $msg = "Debe seleccionar una categoria";
                                $class = "alert-danger";
                                break;                                
                        }
                    }

                    if (isset($msg)) {
                        print '<div class="alert ' . $class . '" role="alert">' . $msg . '</div>';
                    }
                }

                /// unset($_SESSION['nombre'], $_SESSION['cantidad']);
                ?>

            </div>
        </div>

    </div>
    <div class="col"></div>

</div>