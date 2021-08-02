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
    <!-- Search -->
    <script src="assets/js/search.js"></script>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse text-sm layout-fixed" onclick="SearchOut()">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark text-sm">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3" style="margin-top:13px">
                <input class="form-control form-control-sm" type="search" placeholder="Buscar..." autocomplete="off"
                    aria-label="Search" id="search" onkeyup="showResult(this.value)">
            </form>
            <div id="livesearch"></div>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto text-white text-capitalize">

                <?php echo $alm->name ?></a>

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
            <a href="?c=Grnte&a=Index" class="brand-link">
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
                            <a href="?c=Grnte&a=Sales" class="nav-link <?php $url == 'Sales' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Ventas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?c=Grnte&a=Approve" class="nav-link">
                                <i class="nav-icon fas fa-inbox"></i>
                                <p>
                                    Productos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?c=Grnte&a=Approve" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Compras
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">