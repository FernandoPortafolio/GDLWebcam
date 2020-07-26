<?php include_once 'includes/templates/head.php'; ?>

<body>

    <?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2 class="separador justify-center">Invitados</h2>

        <?php
            //Realizar la conexion a la base de datos
            require_once 'includes/functions/db_conection.php';
            $sql = 'select * from invitado';
            $result = $conn->query($sql);
            if (!$result) {
                echo 'Error al ejecutar la consulta';
            }

        ?>

        <section class="seccion invitados contenedor">
            <ul class="lista-invitados">

                <?php while ($row = $result->fetch_assoc()) { ?>
                <li class="invitado">
                    <a class="descripcion" href="#invitado<?php echo $row['id_invitado']; ?>">
                        <img src="<?php echo 'img/'.$row['url_foto']; ?>" alt="Imagen del Invitado">
                    </a>
                    <p><?php echo $row['nombre'].' '.$row['apellido']; ?></p>
                </li>

                <div class="display-none">
                    <div class="descripcion" id="invitado<?php echo $row['id_invitado']; ?>">
                        <h2>Invitado <?php echo $row['nombre'].' '.$row['apellido']; ?></h2>
                        <img src="<?php echo 'img/'.$row['url_foto']; ?>" alt="Imagen del Invitado">
                        <?php echo $row['descripcion']; ?>
                        <nav class="redes-sociales">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </nav>
                    </div>
                </div>

                <?php } //Fin del foreach de invitados?>

            </ul>

        </section>

        <!-- Cerrar la conexion a la base de datos -->
        <?php $conn->close(); ?>
    </section>

    <?php include_once 'includes/templates/footer.php'; ?>
    <?php include_once 'includes/templates/scripts.php'; ?>

</body>

</html>