<?php
    include_once 'includes/templates/head.php';
    include_once 'includes/templates/header.php';
    require 'includes/paypal_conf.php';
    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;

    ?>

<section class="seccion contenedor">
    <h2 class="separador justify-center">Pago Finalizado</h2>

    <?php
       $id_pago = (int) $_GET['id_pago'];
       $pagado = 1;

       try {
           //Estas variables las manda Paypal en automatico
           $paymentId = $_GET['paymentId'];
           $payerID = $_GET['PayerID'];

           //Peticion a REST API de Paypal
           $payment = Payment::get($paymentId, $apiContext);
           $execution = new PaymentExecution();
           $execution->setPayerId($payerID);

           //Resultado tiene informacion de la transaccion
           $result = $payment->execute($execution, $apiContext);
           $respuesta = $result->transactions[0]->related_resources[0]->sale->state;

           if ($respuesta == 'completed') {
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
           }
       } catch (Throwable $th) {
           echo '<div class="resultado error">';
           echo 'El Pago no se realizo';
           echo '</div>';
       }

    ?> 
    
</section>


<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>