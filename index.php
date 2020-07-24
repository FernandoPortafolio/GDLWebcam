<?php include_once 'includes/templates/head.php' ?>

<body>

    <?php include_once 'includes/templates/header.php' ?>

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

                    <nav class="menu-programa">
                        <a href="#talleres"><i class="fas fa-code"></i>Talleres</a>
                        <a href="#conferencias"><i class="fas fa-comment"></i>Conferencias</a>
                        <a href="#seminarios"><i class="fas fa-university"></i>Seminarios</a>
                    </nav>

                    <ul id="talleres" class="info-curso">
                        <li class="detalle-evento">
                            <h3>HTML5, CSS, JavaScript</h3>
                            <p><i class="far fa-clock"></i>16:00 hrs</p>
                            <p><i class="far fa-calendar"></i>10 de Dic</p>
                            <p><i class="fas fa-user"></i>Fernando Acosta</p>
                        </li>

                        <li class="detalle-evento">
                            <h3>Responsive Web Desing</h3>
                            <p><i class="far fa-clock"></i>20:00 hrs</p>
                            <p><i class="far fa-calendar"></i>10 de Dic</p>
                            <p><i class="fas fa-user"></i>Fernando Acosta</p>
                        </li>
                        <div class="justify-rigth"><a href="#" class="btn btn-primario">Ver Todos</a></div>
                    </ul>

                    <ul id="conferencias" class="info-curso">
                        <li class="detalle-evento">
                            <h3>Como ser Freelancer</h3>
                            <p><i class="far fa-clock"></i>20:00 hrs</p>
                            <p><i class="far fa-calendar"></i>12 de Dic</p>
                            <p><i class="fas fa-user"></i>Gregorio Sanchez</p>
                        </li>

                        <li class="detalle-evento">
                            <h3>Tecnologías del Futuro</h3>
                            <p><i class="far fa-clock"></i>21:00 hrs</p>
                            <p><i class="far fa-calendar"></i>10 de Dic</p>
                            <p><i class="fas fa-user"></i>Susana Distancia</p>
                        </li>
                        <div class="justify-rigth"><a href="#" class="btn btn-primario">Ver Todos</a></div>
                    </ul>

                    <ul id="seminarios" class="info-curso">
                        <li class="detalle-evento">
                            <h3>UI/UX para móviles</h3>
                            <p><i class="far fa-clock"></i>16:00 hrs</p>
                            <p><i class="far fa-calendar"></i>10 de Dic</p>
                            <p><i class="fas fa-user"></i>Jarol García</p>
                        </li>

                        <li class="detalle-evento">
                            <h3>Mecanografía de 0 a experto</h3>
                            <p><i class="far fa-clock"></i>15:00 hrs</p>
                            <p><i class="far fa-calendar"></i>11 de Dic</p>
                            <p><i class="fas fa-user"></i>Camilo Quintanilla</p>
                        </li>
                        <div class="justify-rigth"><a href="#" class="btn btn-primario">Ver Todos</a></div>
                    </ul>

                </div>
            </div>
        </div>
    </section>

    <section class="seccion invitados contenedor">
        <h2 class="justify-center separador">Nuestros Invitados</h2>
        <ul class="lista-invitados">
            <li class="invitado">
                <img src="img/invitado1.jpg" alt="Imagen del Invitado">
                <p>Rafael Bauitista</p>
            </li>
            <li class="invitado">
                <img src="img/invitado2.jpg" alt="Imagen del Invitado">
                <p>Shari Herrera</p>
            </li>
            <li class="invitado">
                <img src="img/invitado3.jpg" alt="Imagen del Invitado">
                <p>Gregorio Sánchez</p>
            </li>
            <li class="invitado">
                <img src="img/invitado4.jpg" alt="Imagen del Invitado">
                <p>Susana Rivera</p>
            </li>
            <li class="invitado">
                <img src="img/invitado5.jpg" alt="Imagen del Invitado">
                <p>Carol García</p>
            </li>
            <li class="invitado">
                <img src="img/invitado6.jpg" alt="Imagen del Invitado">
                <p>Susana Distancia</p>
            </li>
        </ul>

    </section>

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

    <?php include_once 'includes/templates/footer.php' ?>
    <?php include_once 'includes/templates/scripts.php' ?>

    <!-- Paginas -->
    <script src="js/pages/index.js" defer></script>

</body>

</html>