<header>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
</header>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#new">
                    Nueva
                </button>
                <h1 class="m-0 text-dark">Ventas</h1>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card p-4">


            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th>Pago</th>
                        <th>Cambio</th>
                        <th>Observaciones</th>
                        <th>Medio de Pago</th>
                        <?php if ($alm->id <= 2) { ?>
                        <th>Usuario</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if($alm->id <= 2) { 
                        foreach($this->model->SalesList() as $r) { ?>
                    <tr>
                        <td><?php echo $r->id ?></td>
                        <td><?php echo $r->created_at ?></td>
                        <td>$ <?php echo number_format($r->price) ?></td>
                        <td>$ <?php echo number_format($r->price+$r->returned) ?></td>
                        <td>$ <?php echo number_format($r->returned) ?></td>
                        <td><?php echo $r->obs ?></td>
                        <td><?php echo $r->type ?></td>
                        <td><?php echo $r->user ?></td>

                    </tr>
                    <?php }} else { ?>
                    <?php foreach($this->model->SalesList() as $r) { 
                        if ($alm->id ==  $r->user_id) { ?>
                    <tr>
                        <td><?php echo $r->id ?></td>
                        <td><?php echo $r->created_at ?></td>
                        <td>$ <?php echo number_format($r->price) ?></td>
                        <td>$ <?php echo number_format($r->price+$r->returned) ?></td>
                        <td>$ <?php echo number_format($r->returned) ?></td>
                        <td><?php echo $r->obs ?></td>
                        <td><?php echo $r->type ?></td>
                    </tr>
                    <?php }}} ?>

                </tbody>
            </table>

        </div>
    </div>
</div>
</div>
</div>

<!-- ./wrapper -->
</div>
</body>

</html>

<script>
$(document).ready(function() {
    $('table').DataTable({
        "order": [],
        "scrollX": true,
        "lengthChange": false,
        "paginate": false

    });
});
</script>