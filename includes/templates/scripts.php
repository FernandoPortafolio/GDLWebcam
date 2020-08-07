<script src="js/jquery-3.5.1.js"></script>
<script src="js/vendor/modernizr-3.11.2.min.js"></script>
<script src="js/plugins.js"></script>
<!--Plugin animar numeros-->
<script src="js/plugins/jquery.animateNumber.js"></script>
<!--Plugin para contador regresivo-->
<script src="js/plugins/jquery.countdown.js"></script>
<!--Plugin para lettering-->
<script src="js/plugins/jquery.lettering.js"></script>
<!--Plugin para mapas-->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<!-- Plugin para la galeria de fotos -->
<script src="js/plugins/lightbox.js"></script>
<script src="js/plugins/jquery.colorbox.js"></script>


<script src="js/pages/header.js"></script>

<!-- scripts de cada pagina -->
<?php
   $archivo = basename($_SERVER['PHP_SELF']);
   $pagina = str_replace('.php', '', $archivo);
   switch ($pagina) {
    case 'index':
        echo '<script src="js/pages/index.js" defer></script>';
        echo '<script src="js/pages/invitados.js" defer></script>';
        break;

    case 'registro':
        echo '<script src="js/pages/registro.js" defer></script>';
        break;

    case 'invitados':
        echo '<script src="js/pages/invitados.js" defer></script>';
        break;

    case 'conferencia':
        echo '<script src="js/pages/conferencia.js" defer></script>';
        break;
    }
?>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
window.ga = function() {
    ga.q.push(arguments)
};
ga.q = [];
ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto');
ga('set', 'anonymizeIp', true);
ga('set', 'transport', 'beacon');
ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async></script>

<!-- MAILCHIMP -->
<script id="mcjs">
! function(c, h, i, m, p) {
    m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m, p)
}(document, "script",
    "https://chimpstatic.com/mcjs-connected/js/users/b07f55230f661f469a9336e26/adad19fabab9ac70aeffce919.js");
</script>
</body>

</html>