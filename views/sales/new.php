<header>
    <script src="assets/plugins/inputmask/jquery.inputmask.min.js"></script>
</header>


<!-- Modal -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>* Descripción</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="nav-icon fas fa-archive"></i></span>
                            </div>
                            <input class="form-control" name="description" required>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>* Precio</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="nav-icon fas fa-dollar-sign"></i></span>
                            </div>
                            <input
                                data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 0, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
                                class="form-control" name="price" placeholder="$ 0" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>