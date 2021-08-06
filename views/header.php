<?php
if ($id <> "" and $id == $alm->id){
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" sizes="192x192" href="assets/img/logo.png">
    <title>Olmo</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Header -->
    <link rel="stylesheet" href="assets/css/header.css">
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/adminlte.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse text-sm layout-fixed">

    <div id="loading"></div>

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark text-sm">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto text-white text-capitalize">

                <h5><?php echo $alm->name ?></h5>

                <li class="nav-item">
                    <a class="nav-link" href="?c=Login&a=Logout"><i title="Cerrar Sesión"
                            class="fa fa-window-close"></i> </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="?c=Init&a=Index" class="brand-link">
                <img src="assets/img/logo.jpg" style="width:30px" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light pl-3">Olmo | Complementos</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="?c=Init&a=Sales" class="nav-link <?php echo ($url == 'Sales') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Ventas
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?c=Init&a=Products"
                                class="nav-link <?php echo ($url == 'Products') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-inbox"></i>
                                <p>
                                    Productos
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?c=Init&a=Purchases"
                                class="nav-link <?php echo ($url == 'Purchases') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Compras
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link <?php echo ($url == 'Others') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Otros
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="?c=Init&a=Others&type=IN"
                                        class="nav-link <?php echo ($_REQUEST['type'] == 'IN') ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ingresos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?c=Init&a=Others&type=OUT"
                                        class="nav-link <?php echo ($_REQUEST['type'] == 'OUT') ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Egresos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="?c=Init&a=Inventory"
                                class="nav-link <?php echo ($url == 'Inventory') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Inventario
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#cashbox_close">
                                <i class="nav-icon fas fa-times"></i>
                                <p>
                                    Cerrar Caja
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?php require_once 'views/cashbox/close.php'; ?>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <?php
}
else {
echo'<script type="text/javascript">
alert("Registrarse para ver éste contenido");
window.location="?c=Login&a=Index"
</script>';
}
?>