<?php
   if (!isset($_GET['id'])) {
       header('Location:lista-invitado.php');
   }
?>
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
                    <h1>Añadir Invitado</h1>
                    <small>Llena el formulario para añadir un invitado</small>
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
                        <h3 class="card-title">Añadir Invitado</h3>
                    </div>
                    <div class="card-body">

                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del invitado</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <?php
                               $id = $_GET['id'];
                               $sql = "select id_invitado, nombre, apellido, descripcion, url_foto from invitado where id_invitado = $id";
                               $resultado = $conn->query($sql);
                               $invitado = $resultado->fetch_assoc();
                            ?>
                            <form class="form-horizontal" method="POST" action="modelo-invitado.php"
                                name="editar_invitado" id="form_editar_archivo" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputNombre" class="col-form-label">Nombre: </label>
                                        <div>
                                            <input required type="text" class="form-control" id="inputNombre"
                                                placeholder="Nombre" name="nombre"
                                                value="<?php echo $invitado['nombre']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputApellido" class="col-form-label">Apellido: </label>
                                        <div>
                                            <input required type="text" class="form-control" id="inputApellido"
                                                placeholder="Apellidos" name="apellido"
                                                value="<?php echo $invitado['apellido']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescripcion" class="col-form-label">Descripcion: </label>
                                        <div>
                                            <textarea required type="text" rows="8" class="form-control"
                                                id="inputDescripcion" placeholder="Descripción..."
                                                name="descripcion"><?php echo $invitado['descripcion']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagenInvitado" class="col-form-label d-block">Imagen Actual</label>
                                        <img src="../img/invitados/<?php echo $invitado['url_foto']; ?>"
                                            alt="Imagen del Invitado" width="200">
                                    </div>
                                    <div class="form-group">
                                        <label for="imagen" class="col-form-label">Imagen: </label>
                                        <div>
                                            <input type="file" id="imagen" name="imagen">
                                            <p class="text-muted"><small>Añada la imagen del invitado aquí</small></p>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="hidden" value="<?php echo $invitado['id_invitado']; ?>" name="id">
                                    <input type="hidden" value="editar" name="accion">
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