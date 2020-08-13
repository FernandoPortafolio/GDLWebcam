<?php include_once './functions/sessiones.php'; ?>
<?php include_once './templates/header.php'; ?>
<?php include_once './templates/barra.php'; ?>
<?php include_once './templates/drawer.php'; ?>
<?php include_once './functions/funciones.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Categoria</h1>
                    <small>Llena el formulario para crear una categoria</small>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Crear Categoria</h3>
                    </div>
                    <div class="card-body">

                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la categoria</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="POST" action="modelo-categoria.php"
                                name="crear_categoria" id="form_crear">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputCategoria" class="col-sm-2 col-form-label">Nombre:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="inputCategoria"
                                                placeholder="Categoria" name="categoria">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="icono" class="col-sm-2 col-form-label">Icono:</label>
                                        <div>
                                            <button class="btn btn-info" role="iconpicker" name="icono" id="icono"
                                                role="iconpicker" data-icon="fas fa-address-book"
                                                data-search-text="fas fa-address-book" data-footer="false" data-rows="4"
                                                data-cols="6" data-placement="right" data-selected-class="btn-danger"
                                                data-unselected-class="btn-info"></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="hidden" value="crear" name="accion">
                                    <button type="submit" class="btn btn-info" id='guardar'>Añadir</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<?php include_once './templates/footer.php'; ?>