<?php
   if (!isset($_GET['id'])) {
       header('Location:lista-evento.php');
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
                    <h1>Crear Evento</h1>
                    <small>Llena el formulario para crear un evento</small>
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
                        <h3 class="card-title">Crear Evento</h3>
                    </div>
                    <div class="card-body">

                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del evento</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <?php
                               $id = $_GET['id'];
                               $sql = "SELECT id_evento, evento, fecha, hora, categoria, id_categoria, concat(nombre, ' ', apellido) as invitado, id_invitado
                               from evento e
                               join categoria c USING (id_categoria)
                               join invitado i USING(id_invitado)
                               where id_evento = $id";
                               $resultado = $conn->query($sql);
                               $evento = $resultado->fetch_assoc();
                            ?>
                            <form class="form-horizontal" method="POST" action="modelo-evento.php" name="editar_evento"
                                id="form_editar">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputEvento" class="col-form-label">Evento: </label>
                                        <div>
                                            <input required type="text" class="form-control" id="inputEvento"
                                                placeholder="Título del Evento" name="evento"
                                                value="<?php echo $evento['evento']; ?>">
                                        </div>
                                    </div>

                                    <!-- Date Picker -->
                                    <?php
                                       $fecha = date_format(date_create($evento['fecha']),"m/d/Y")
                                    ?>
                                    <div class="form-group row">
                                        <label for="datePicker" class="col-form-label col-sm-12">Fecha: </label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#reservationdate" id="datePicker" name="fecha"
                                                value="<?php echo $fecha ?>" />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Time Picker -->
                                    <?php
                                       $hora = date_format(date_create($evento['hora']),"h:i A");
                                    ?>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group row">
                                            <label for="time" class="col-form-label col-sm-12">Hora: </label>

                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker" id="time" name="hora"
                                                    value="<?php echo $hora ?>" />
                                                <div class="input-group-append" data-target="#timepicker"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"
                                                            value="<?php echo $evento['hora']; ?>"></i></div>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>

                                    <!-- Select para la categoria -->
                                    <?php
                                       $sql = 'select id_categoria, categoria from categoria';
                                       $resultado = $conn->query($sql);
                                    ?>
                                    <div class="form-group row">
                                        <label for="categoria" class="col-form-label col-sm-12">Categoria: </label>

                                        <select id="categoria" class="form-control select2" name="categoria">
                                            <?php while ($row = $resultado->fetch_assoc()):
                                                if ($row['id_categoria'] == $evento['id_categoria']): ?>

                                            <option selected value="<?php echo $row['id_categoria']; ?>">
                                                <?php echo $row['categoria']; ?></option>

                                            <?php else: ?>

                                            <option value="<?php echo $row['id_categoria']; ?>">
                                                <?php echo $row['categoria']; ?></option>

                                            <?php endif; //fin del if
                                             endwhile; //Fin del ciclo while?>
                                        </select>
                                    </div>

                                    <!-- Select para los invitados -->
                                    <?php
                                       $sql = "select id_invitado, concat(nombre, ' ', apellido) as invitado from invitado";
                                       $resultado = $conn->query($sql);
                                    ?>
                                    <div class="form-group row">
                                        <label for="invitado" class="col-form-label col-sm-12">Invitado: </label>

                                        <select id="invitado" class="form-control select2 col-sm-12" name="invitado">
                                            <?php while ($row = $resultado->fetch_assoc()):
                                            if ($row['id_invitado'] == $evento['id_invitado']): ?>

                                            <option selected value="<?php echo $row['id_invitado']; ?>">
                                                <?php echo $row['invitado']; ?></option>

                                            <?php else: ?>

                                            <option value="<?php echo $row['id_invitado']; ?>">
                                                <?php echo $row['invitado']; ?></option>

                                            <?php endif; //fin del if
                                            endwhile; //Fin del ciclo while?>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="hidden" value="<?php echo $evento['id_evento']; ?>" name="id">
                                    <input type="hidden" value="editar" name="accion">
                                    <button type="submit" class="btn btn-info" id='guardar'>Guardar</button>
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