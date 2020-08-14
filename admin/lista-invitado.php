<?php include_once './functions/sessiones.php'; ?>
<?php include_once './functions/funciones.php'; ?>
<?php include_once './templates/header.php'; ?>
<?php include_once './templates/barra.php'; ?>
<?php include_once './templates/drawer.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Invitados</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Administra los invitados desde este panel</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabla" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $sql = "SELECT id_invitado, concat(nombre, ' ', apellido) as nombre, descripcion, url_foto from invitado";
                                       $resultado = $conn->query($sql);
                                    ?>
                                    <?php while ($row = $resultado->fetch_assoc()):?>
                                    <tr class="text-center">
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo $row['descripcion']; ?></td>
                                        <td><img src="../img/invitados/<?php echo $row['url_foto']; ?>"
                                                alt="<?php echo $row['url_foto']; ?>" width="150"></td>
                                        <td>
                                            <a href="editar-invitado.php?id=<?php echo $row['id_invitado']; ?>"
                                                class="btn bg-orange btn-flat m-lg-2">
                                                <i class="fa fa-pen text-white"></i>
                                            </a>
                                            <a href="#" data-id="<?php echo $row['id_invitado']; ?>"
                                                data-tipo="invitado" class="btn bg-red btn-flat m-lg-2 borrar_registro">
                                                <i class="fa fa-trash text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; //Fin del ciclo while?>
                                    <?php
                                        $resultado->free();
                                        $conn->close();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once './templates/footer.php'; ?>
<?php include_once './templates/footer.php'; ?>