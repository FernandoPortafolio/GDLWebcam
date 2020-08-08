<?php include_once 'includes/templates/head.php'; ?>
<?php include_once 'includes/templates/header.php'; ?>

<section class="seccion contenedor">
    <h2 class="separador justify-center">Pago Finalizado</h2>

    <?php
       $resultado = $_GET['exito'];
       $paymentId = $_GET['paymentId'];
       $id_pago = (int) $_GET['id_pago'];
       $pagado = 1;

       if ($resultado == 'true') {
           echo '<div class="resultado correcto">';
           echo 'El Pago se realizo correctamente<br>';
           echo 'El ID es: '.$paymentId;
           echo '</div>';

           require 'includes/functions/db_conection.php';
           $ps = $conn->prepare('UPDATE registro set pagado = ? where id_registro = ?');
           $ps->bind_param('ii', $pagado, $id_pago);
           $ps->execute();
           $ps->close();
           $conn->close();
       } else {
           echo '<div class="resultado error">';
           echo 'El Pago no se realizo';
           echo '</div>';
       }
    ?> 
    
</section>


<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>