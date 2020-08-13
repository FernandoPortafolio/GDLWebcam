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
                    <h1>Lista de Categorias</h1>
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
                            <h3 class="card-title">Administra las categorias de eventos desde este panel</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabla" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Icono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $sql = 'SELECT id_categoria,categoria,icono from categoria';
                                       $resultado = $conn->query($sql);
                                    ?>
                                    <?php while ($row = $resultado->fetch_assoc()):?>
                                    <tr>
                                        <td><?php echo $row['categoria']; ?></td>
                                        <td class="text-center icono"><i class="<?php echo $row['icono']; ?>"></i></td>
                                        <td class="text-center">
                                            <a href="editar-categoria.php?id=<?php echo $row['id_categoria']; ?>"
                                                class="btn bg-orange btn-flat m-lg-2">
                                                <i class="fa fa-pen text-white"></i>
                                            </a>
                                            <a href="#" data-id="<?php echo $row['id_categoria']; ?>"
                                                data-tipo="categoria"
                                                class="btn bg-red btn-flat m-lg-2 borrar_registro">
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
                                        <th>Categoria</th>
                                        <th>Icono</th>
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