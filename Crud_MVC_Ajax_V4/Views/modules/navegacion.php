<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mi Proyecto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo SERVERURL; ?>inicio">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo SERVERURL; ?>login">Login</a>
                </li>
                
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Empresa
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo SERVERURL; ?>empresaGuardias/registrar">Registrar Empresa</a></li>
                        <li><a class="dropdown-item" href="<?php echo SERVERURL; ?>empresaGuardias/listar">Listar Empresa</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuario
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo SERVERURL; ?>usuario/registrar">Registrar Usuario</a></li>
                        <li><a class="dropdown-item" href="<?php echo SERVERURL; ?>usuario/listar">Listar Usuarios</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo SERVERURL; ?>salir">Salir</a>
                </li>
                <li class="nav-item nav-link active"> <i class="bi bi-person-fill-down"></i> 
                    <?php
                    if (isset($_SESSION['validado'])) {
                        print "Usuario: " . $_SESSION['user'];
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
