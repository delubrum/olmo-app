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
                    Nuevo
                </button>
                <h1 class="m-0 text-dark">Productos</h1>
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
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($this->model->ProductsList() as $r) { ?>
                    <tr>
                        <td><?php echo $r->description ?></td>
                        <td>$ <?php echo number_format($r->price) ?></td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input active"
                                    id="switch<?php echo $r->product_id ?>" data-id="<?php echo $r->product_id ?>"
                                    <?php echo ($r->active == 1) ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="switch<?php echo $r->product_id ?>"></label>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
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
        "scrollX": true,
        "lengthChange": false,
        "paginate": false

    });
});

$('.active').change(function() {
    id = $(this).data("id");
    if (!this.checked) {
        val = 0
    } else {
        val = 1
    }
    $.post("?c=Grnte&a=ProductActive", {
        id: id,
        val: val
    });
});
</script>