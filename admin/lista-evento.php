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
                    <h1>Lista de Eventos</h1>
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
                            <h3 class="card-title">Administra los eventos desde este panel</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabla" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Evento</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Categoria</th>
                                        <th>Invitado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $sql = "SELECT id_evento, evento ,fecha,hora,categoria, concat(i.nombre, ' ', i.apellido) as invitado
                                       from evento e
                                       JOIN invitado i USING(id_invitado)
                                       JOIN categoria c USING(id_categoria)";
                                       $resultado = $conn->query($sql);
                                    ?>
                                    <?php while ($row = $resultado->fetch_assoc()):?>
                                    <tr>
                                        <td><?php echo $row['evento']; ?></td>
                                        <td><?php echo $row['fecha']; ?></td>
                                        <td><?php echo $row['hora']; ?></td>
                                        <td><?php echo $row['categoria']; ?></td>
                                        <td><?php echo $row['invitado']; ?></td>
                                        <td class="text-center">
                                            <a href="editar-evento.php?id=<?php echo $row['id_evento']; ?>"
                                                class="btn bg-orange btn-flat m-lg-2">
                                                <i class="fa fa-pen text-white"></i>
                                            </a>
                                            <a href="#" data-id="<?php echo $row['id_evento']; ?>" data-tipo="evento"
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
                                        <th>Evento</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Categoria</th>
                                        <th>Invitado</th>
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