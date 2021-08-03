<header>
    <script src="assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <style>
    /* Important part */
    #new .modal-dialog {
        overflow-y: initial !important
    }

    #new .modal-body {
        height: 76vh;
        overflow-y: auto;
    }

    #qty_price {
        margin-top: 10%;
    }

    @media only screen and (min-device-width: 320px) and (max-device-width: 568px) {
        #qty_price {
            margin-top: 30%;
        }
    }
    </style>
</header>

<!-- Modal -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="sale_save" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">

                            <input style="padding:5px;width:98%" placeholder="Buscar..." id="product_search">
                            <select id="category" style="padding:5px;width:98%;margin-top:5px">
                                <option value=''>Categoria...</option>
                                <?php foreach($this->model->ProductsCategoriesList() as $r) {
				                echo "<option value='$r->id'>$r->name</option>";
			                };
			                ?>
                            </select>
                            <div id="products" class="pt-2"></div>
                        </div>
                        <div class="col-7">
                            <div id="items">
                            </div>
                            <div class="row p-1 mt-1">
                                <div class="col-6 font-weight-bold text-right">
                                    TOTAL:
                                </div>
                                <div id="total" class="col-6 font-weight-bold text-right">$ 0</div>

                                <div class="col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Observaciones:</label>
                                        <textarea class="form-control" name="obs"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="qty_price" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" id="product_add">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>* Cantidad</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="nav-icon fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="number" id="qty" class="form-control" pattern="\d*" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>* Precio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="nav-icon fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input id="price"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 0, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
                                        class="form-control" id="price" placeholder="$ 0" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="product_id">
                        <input type="hidden" id="description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(":input").inputmask();
});

$(document).on('change', '#category', function() {
    $('#product_search').val('');
    id = $(this).children("option:selected").val()
    $.post("?c=Init&a=ProductByCategory", {
        id: id
    }, function(data) {
        $("#products").html(data);
    });
});

$(document).on('input', '#product_search', function() {
    $('#category').val('');
    description = $(this).val();
    $.post("?c=Init&a=ProductSearch", {
        description: description
    }, function(data) {
        $("#products").html(data);
    });
});

$(document).on("click", "#product", function() {
    id = $(this).data('id');
    price = $(this).data('price');
    description = $(this).html();
    $("#qty_price #product_id").val(id);
    $("#qty_price #price").val(price);
    $("#qty_price #description").val(description);
});

function total() {
    sum = 0;
    $('[name^=price]').each(function() {
        sum += parseInt($(this).val());
    });
    $("#total").html('$ ' + sum.toFixed(0).replace(
        /(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,"));
}

$('#product_add').on('submit', function(e) {
    if (document.getElementById("product_add").checkValidity()) {
        e.preventDefault();
        id = $('#product_id').val();
        description = $('#description').val();
        price = $('#price').val();
        qty = $('#qty').val();
        pricenum = price.replace(/\D/g, '');
        pricetotal = parseInt(pricenum) * parseInt(qty)
        div = `
        <div class="row p-1 bg-light removediv" id="product${id}">
            <div class="col-1">
                <span style="cursor:pointer" class="h5 text-danger btx">&times;</span>
            </div>
            <div class="col-6">
                ${description} x <span id="qty_show${id}">${qty}</span>
            </div>
            <div class="col-5 text-right font-weight-bold" id="price_show${id}">
                $ ${pricetotal.toFixed(0).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,")}
            </div>
            <input id="product_id_input${id}" type="hidden" name="product_id[]" value="${id}">
            <input id="qty_input${id}" type="hidden" name="qty[]" value="${qty}">
            <input id="price_input${id}" type="hidden" name="price[]" value="${pricetotal}">
        </div>
        `;

        if ($("#product" + id).length == 0) {
            $('#items').append(div);
        } else {
            old_price = $("#price_input" + id).val();
            new_price = parseInt(old_price) + (parseInt(pricenum) * parseInt(qty));
            old_qty = $("#qty_input" + id).val();
            new_qty = parseInt(old_qty) + parseInt(qty);
            $("#price_input" + id).val(new_price);
            $("#price_show" + id).html('$ ' + new_price.toFixed(0).replace(
                /(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,"));
            $("#qty_input" + id).val(new_qty);
            $("#qty_show" + id).html(new_qty);
        }
        $('#qty').val('');
        $('#qty_price').modal('toggle');
        total();

    }
});

$(document).on('click', '.btx', function() {
    Swal.fire({
        title: 'Deseas Borrar el item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {
            $(this).closest('.removediv').remove();
            total();
        }
    })
});

$('#product_add').on('submit', function(e) {
    if (document.getElementById("product_add").checkValidity()) {
        e.preventDefault();
        $.post("?c=Init&a=SaleSave", $("#product_add").serialize(), function(data) {

        });
    }
});


$('#sale_save').on('submit', function(e) {
    if (document.getElementById("sale_save").checkValidity()) {
        e.preventDefault();
        Swal.fire({
            title: 'Deseas Guardar la Venta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#loading").fadeIn("slow");
                $.post("?c=Init&a=SaleSave", $("#sale_save").serialize(), function(data) {
                    location.reload();
                });
            }
        })
    }
});
</script>