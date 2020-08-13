<?php include_once 'includes/templates/head.php'; ?>

<?php include_once 'includes/templates/header.php'; ?>

<section class="seccion contenedor">
    <h2 class="separador justify-center">Calendario de Eventos</h2>

    <?php
            //Realizar la conexion a la base de datos
            require_once 'includes/functions/db_conection.php';
            $sql = 'select id_evento,
                 evento,
                 icono,
                 fecha,
                 hora,
                 i.nombre,
                 apellido,
                 categoria
            from evento e
            join categoria c on e.id_categoria = c.id_categoria
            join invitado i on e.id_invitado = i.id_invitado
            order by fecha';
            $result = $conn->query($sql);
            if (!$result) {
                echo 'Error al ejecutar la consulta';
            }

        ?>

    <div class="calendario">
        <?php
            $calendario = [];
                //fetch_assoc() obtiene la fila actual del cursor resultado
                while ($row = $result->fetch_assoc()) {
                    //obtener la fecha del evento
                    $fecha = $row['fecha'];

                    $evento = [
                        'titulo' => $row['evento'],
                        'icono' => 'fa'.' '.$row['icono'],
                        'fecha' => $row['fecha'],
                        'hora' => $row['hora'],
                        'categoria' => $row['categoria'],
                        'invitado' => $row['nombre'].' '.$row['apellido'],
                    ];
                    $calendario[$fecha][] = $evento;
                }
            // Fin del bloque para el while del calendario
            ?>

        <?php foreach ($calendario as $dia => $lista_eventos) {?>
        <h3>
            <i class='fa fa-calendar'></i>
            <?php
                            setlocale(LC_TIME, 'es_ES.UTF-8');
                            echo strftime('%A %d, de %B del %Y', strtotime($dia));
                        ?>
        </h3>

        <div class="flex-resp space-unset">
            <?php foreach ($lista_eventos as $evento) { ?>
            <div class="dia justify-center">
                <p class='titulo'><?php echo $evento['titulo']; ?></p>
                <p class='hora'>
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <?php echo $evento['fecha'].' '.$evento['hora']; ?>
                </p>
                <p>
                    <i class="<?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                    <?php echo $evento['categoria']; ?>
                </p>
                <p class='hora'>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo $evento['invitado']; ?>
                </p>
            </div>
            <?php } //fin foreach de evento?>
        </div>

        <?php } //fin foreach del calendario?>

    </div> <!-- Fin del calendario -->

    <!-- Cerrar la conexion a la base de datos -->
    <?php $conn->close(); ?>
</section>

<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>