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
                    <h1>Crear Administrador</h1>
                    <small>Llena el formulario para crear un administrador</small>
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
                        <h3 class="card-title">Crear Admin</h3>
                    </div>
                    <div class="card-body">

                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la Cuenta</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="POST" action="modelo-admin.php" name="crear_admin" id="form_crear">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tu
                                            Nombre:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="inputName"
                                                placeholder="Nombre completo" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputUser" class="col-sm-2 col-form-label">Usuario:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="inputUser" placeholder="Usuario"
                                                name="user">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña:</label>
                                        <div class="col-sm-10">
                                            <input required type="password" class="form-control" id="inputPassword"
                                                placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputRepPassword" class="col-sm-2 col-form-label">Repetir contraseña:</label>
                                        <div class="col-sm-10">
                                            <input required type="password" class="form-control" id="inputRepPassword"
                                                placeholder="Password" name="rep_password">
                                            <small id="resultado_password" class="invalid-feedback"></small>
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