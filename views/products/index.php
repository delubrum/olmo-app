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
                        <th>Precio de Venta</th>
                        <th>Categoria</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($this->model->ProductsList() as $r) { ?>
                    <tr>

                        <td><?php echo  mb_convert_case($r->description, MB_CASE_TITLE, "UTF-8"); ?></td>
                        <td>$ <?php echo number_format($r->price) ?></td>
                        <td><?php echo $r->name ?></td>
                        <td class="btn-group"><button class="btn btn-danger delete m-2" data-id="<?php echo $r->id ?>">
                  <i class="far fa-trash-alt"></i> 
                    </button>
                
                    <div class="custom-control custom-switch pt-2">
                        <input type="checkbox" class="custom-control-input active"
                            id="switch<?php echo $r->id ?>" data-id="<?php echo $r->id ?>"
                            <?php echo ($r->active == 1) ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="switch<?php echo $r->id ?>"></label>
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
        "order": [],
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
    $.post("?c=Init&a=ProductActive", {
        id: id,
        val: val
    });
});


$('.delete').click(function() {
    id = $(this).data("id");
    Swal.fire({
        title: 'Deseas Eliminar el Producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#loading").fadeIn("slow");
            $.post("?c=Init&a=ProductDelete", {id}, function(data) {
                    location.reload();
                });
        }
    })
});
</script>