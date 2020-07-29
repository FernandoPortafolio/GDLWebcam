<?php include_once 'includes/templates/head.php'; ?>


<?php include_once 'includes/templates/header.php'; ?>

<section class="contenedor seccion">
    <h2 class="justify-center separador">La Mejor Conferencia de diseño web en español</h2>
    <p class="justify-center">
        Proident id fugiat aute reprehenderit dolore aliquip laborum consequat laboris. Sint laboris proident
        occaecat proident fugiat consectetur proident et sint velit ad aliquip veniam reprehenderit. Reprehenderit
        cillum ipsum irure qui laboris elit qui. Dolore cillum sit sit in elit. In do nulla sit eu in ex officia
        proident esse. Exercitation ex reprehenderit dolor dolor consequat in in non qui sit. Proident voluptate
        elit laboris ipsum quis minim labore dolore.
    </p>
</section>

<section class="seccion programa">
    <div class="contenedor-video">
        <video autoplay loop poster="img/bg-talleres.jpg">
            <source src="video/video.mp4" type="video/mp4">
            <source src="video/video.webm" type="video/webm">
            <source src="video/video.ogv" type="video/ogv">
        </video>
    </div>

    <div class="contenido-programa">
        <div class="contenedor">
            <div class="programa-evento">

                <h2 class="justify-center separador">Programa del Evento</h2>

                <?php
                    //Realizar la conexion a la base de datos
                    require_once 'includes/functions/db_conection.php';
                    $sql = 'select icono, categoria from categoria order by id_categoria';
                    $result = $conn->query($sql);
                    if (!$result) {
                        echo 'Error al ejecutar la consulta';
                    }
                ?>

                <nav class="menu-programa">
                    <?php while ($row = $result->fetch_assoc()) {?>
                    <a href="<?php echo '#'.strtolower($row['categoria']); ?>">
                        <i class="<?php echo 'fa'.' '.$row['icono']; ?>"></i><?php echo $row['categoria']; ?>
                    </a>
                    <?php } ?>
                </nav>

                <?php

                    //Hacer tres consultas seguidas para obtener dos eventos de cada categoria
                    for ($i = 1; $i <= 3; ++$i) {
                        $sql = 'SELECT id_evento,
                               categoria,
                               e.nombre as evento,
                               fecha,
                               hora,
                               i.nombre,
                               apellido
                        from evento e
                            join invitado i on e.id_invitado = i.id_invitado
                            join categoria c on e.id_categoria = c.id_categoria
                        where c.id_categoria = '.$i.'
                        order by c.id_categoria
                        limit 2;';
                        $result = $conn->query($sql);
                        if (!$result) {
                            echo 'Error al ejecutar la consulta';
                        } else {
                            $resultado[] = $result;
                        }
                    }

                    //formatear los tres resultados en un array de dos dimensiones
                    foreach ($resultado as $result) {
                        while ($row = $result->fetch_assoc()) {
                            $categorias[$row['categoria']][] = $row;
                        }
                    }
                ?>

                <!-- Crear el menu del programa -->
                <!-- Ciclo para recorrer cada categoria -->
                <?php foreach ($categorias as $key => $categoria) {?>

                <ul id="<?php echo strtolower($key); ?>" class="info-curso">

                    <!-- Ciclo para recorrer cada evento de una categoria -->
                    <?php foreach ($categoria as $evento) {?>
                    <li class="detalle-evento">
                        <h3><?php echo $evento['evento']; ?></h3>
                        <p><i class="far fa-clock"></i><?php echo $evento['hora']; ?></p>
                        <p><i class="far fa-calendar"></i> <?php echo $evento['fecha']; ?> </p>
                        <p><i class="fas fa-user"></i> <?php echo $evento['nombre'].' '.$evento['apellido']; ?> </p>
                    </li>
                    <?php } //Fin del ciclo foreach?>

                    <div class="justify-rigth"><a href="calendario.php" class="btn btn-primario">Ver Todos</a></div>
                </ul>
                <?php } //Fin del ciclo foreach?>

            </div>
        </div>
    </div>
</section>

<?php include_once 'includes/templates/invitados.php'; ?>

<seccion class="parallax contador center-content">
    <div class="contenedor">
        <ul class="resumen-evento">
            <li>
                <p class="numero"></p>
                <p>Invitados</p>
            </li>
            <li>
                <p class="numero"></p>
                <p>Talleres</p>
            </li>

            <li>
                <p class="numero"></p>
                <p>Días</p>
            </li>

            <li>
                <p class="numero"></p>
                <p>Conferencias</p>
            </li>
        </ul>
    </div>
</seccion>

<section class="precios seccion">
    <h2 class="justify-center separador">Precios</h2>
    <div class="contenedor">
        <ul class="lista-precios">
            <li class="tabla-precio">
                <h3>Pase por día</h3>
                <p class="numero">$30</p>
                <ul>
                    <li>Bocadillos Gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <a href="#" class="btn btn-primario hollow">Comprar</a>
            </li>

            <li class="tabla-precio">
                <h3>Todos los días</h3>
                <p class="numero">$50</p>
                <ul>
                    <li>Bocadillos Gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <a href="#" class="btn btn-primario">Comprar</a>
            </li>

            <li class="tabla-precio">
                <h3>Pase por 2 días</h3>
                <p class="numero">$45</p>
                <ul>
                    <li>Bocadillos Gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <a href="#" class="btn btn-primario hollow">Comprar</a>
            </li>
        </ul>
    </div>
</section>

<div id="mapa" class="mapa">

</div>

<section class="seccion contenedor">
    <h2 class="justify-center separador">Testimoniales</h2>
    <div class="testimoniales">
        <blockquote class="testimonial">
            <p>Cupidatat eiusmod cillum reprehenderit exercitation qui anim aute. Laborum irure ipsum laborum id
                ipsum nisi est eu reprehenderit anim. Voluptate ipsum anim dolore consectetur. Amet anim anim
            </p>
            <footer>
                <img src="img/testimonial.jpg" alt="imagen Testimonial">
                <cite>Oswaldo Aponte Escobedo<span>Diseñador en @prisma</span>
                </cite>
            </footer>
        </blockquote>

        <blockquote class="testimonial">
            <p>Cupidatat eiusmod cillum reprehenderit exercitation qui anim aute. Laborum irure ipsum laborum id
                ipsum nisi est eu reprehenderit anim. Voluptate ipsum anim dolore consectetur. Amet anim anim
            </p>
            <footer>
                <img src="img/testimonial.jpg" alt="imagen Testimonial">
                <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
            </footer>
        </blockquote>

        <blockquote class="testimonial">
            <p>Cupidatat eiusmod cillum reprehenderit exercitation qui anim aute. Laborum irure ipsum laborum id
                ipsum nisi est eu reprehenderit anim. Voluptate ipsum anim dolore consectetur. Amet anim anim
            </p>
            <footer>
                <img src="img/testimonial.jpg" alt="imagen Testimonial">
                <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
            </footer>
        </blockquote>
    </div>
</section>

<div class="newsletter parallax seccion center-content">
    <div class="contenido contenedor">
        <p>Registrate al Newsletter</p>
        <h3>GdlWebcamp</h3>
        <a href="registro.html" class="btn btn-white btn-transparent">Registro</a>
    </div>
</div>

<div class="seccion">
    <div class="contenedor">
        <h2 class="justify-center separador">Faltan</h2>
        <ul class="cuenta-regresiva">
            <li>
                <p class="numero" id="dias"></p>
                <p>Días</p>
            </li>
            <li>
                <p class="numero" id="horas"></p>
                <p>15 horas</p>
            </li>

            <li>
                <p class="numero" id="minutos"></p>
                <p>Minutos</p>
            </li>

            <li>
                <p class="numero" id="segundos"></p>
                <p>Segundos</p>
            </li>
        </ul>
    </div>
</div>

<!-- Cerrar conexion a BD -->
<?php $conn->close(); ?>

<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>