<!doctype html>
<html class="no-js" lang="">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>GdlWebcamp</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <script src="https://kit.fontawesome.com/149ef0981c.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Oswald:wght@300;400;700&family=PT+Sans:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />


    <?php
       $archivo = basename($_SERVER['PHP_SELF']);
       $pagina = str_replace('.php', '', $archivo);
       switch ($pagina) {
           case 'index':
           case 'invitados':
                echo '<link rel="stylesheet" href="css/colorbox.css">';
               break;

           case 'conferencia':
                echo '<link rel="stylesheet" href="css/lightbox.css">';
               break;
       }
    ?>

    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<!-- Se crea una clase en el body para con jquery detectar en que pagina esta y colorearlo en la barra de navegacion -->
<body class="<?php echo $pagina; ?>">