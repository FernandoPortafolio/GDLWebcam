<?php
if (isset($_POST['submit'])) {
    include_once 'includes/functions/funciones.php';
    require_once 'includes/functions/db_conection.php';

    $id_registro = $_POST['id_registro'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $fecha = date('Y-m-d H:i:s');
    $regalo = $_POST['regalo'];
    $total = $_POST['total'];

    //pedido
    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_camisas'];
    $etiquetas = $_POST['pedido_etiquetas'];
    $pedido = productos_to_json($boletos, $camisas, $etiquetas);

    //eventos
    $registro = $_POST['registro'];
    $eventos = eventos_to_json($registro);

    $sql = 'INSERT INTO 
    registro(nombre, apellido, email, fecha, pases_articulos, talleres, total_pago, id_regalo) 
    VALUES (?,?,?,?,?,?,?,?)';

    $ps = $conn->prepare($sql);
    $ps->bind_param('ssssssdi', $nombre, $apellido, $email, $fecha, $pedido, $eventos, $total, $regalo);
    $ps->execute();
    $ps->close();
    $conn->close();
} else {
    die('Hubo un error');
}
?>

<?php include_once 'includes/templates/head.php'; ?>
<?php include_once 'includes/templates/header.php'; ?>

<section class="seccion contenedor">
    <h2 class="separador justify-center">Resumen Registro</h2>

    <?php

        //convertimos en un array asociativo el array $boletos
        $total_boletos = array_combine(['un_dia', 'completo', 'dos_dias'], $_POST['boletos']);

    ?>

    <div class="pago">
        <hr>
        <h3>Estas a punto de pagar con paypal la cantidad de:</h3>
        <p class='precio'>$<?php echo number_format($total, 2); ?></p>
        <p>Resumen de tus productos:</p>

        <!-- Boletos -->
        <?php foreach ($total_boletos as $key => $boleto):?>
        <?php if ($key == 'un_dia' && $boleto > 0): ?>
        <p><?php echo $boleto; ?> Pase por un día</p>
        <?php endif; //Fin del if?>
        <?php if ($key == 'dos_dias' && $boleto > 0): ?>
        <p><?php echo $boleto; ?> Pase por dos días</p>
        <?php endif; //Fin del if?>
        <?php if ($key == 'completo' && $boleto > 0): ?>
        <p><?php echo $boleto; ?> Pase completo</p>
        <?php endif; //Fin del if?>
        <?php endforeach; //Fin del ciclo foreach?>

        <!-- Camisas -->
        <?php if ($camisas > 0): ?>
        <p><?php echo $camisas; ?> Camisas</p>
        <?php endif; //Fin del if?>

        <!-- Etiquetas -->
        <?php if ($etiquetas > 0): ?>
        <p><?php echo $etiquetas; ?> Etiquetas</p>
        <?php endif; //Fin del if?>

        <!-- REGALO -->
        <?php
           switch ($regalo) {
                case 1:
                echo '<p class="regalo"><span>Regalo:</span> Pulsera</p>';
                    break;
                case 2:
                echo '<p class="regalo"><span>Regalo:</span> Etiquetas</p>';
                    break;
                case 3:
                echo '<p class="regalo"><span>Regalo:</span> Plumas</p>';
                    break;
           }
        ?>
        <p class='fw-bold'>Para aclaraciones aclaraciones@gmail.com</p>
    </div>

    <!-- Calcular el desgloce del total -->
    <?php
       $impuestos = number_format($total * 0.16, 2);
       $handling = number_format(3.0, 2);
       $subtotal = number_format($total - $impuestos - $handling, 2);
    ?>

    <div id="paypal-button-container"></div>

    <!-- Script de Paypal SDK -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=Afc5sJoHxQIsF9L7U2XbR-sjdx9BUjGK2sS552A-gmMtFcbMS4RRRhZWmGq7DSnPGOn9Zx7OGAM6MHeH&currency=MXN">
    // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>

    <script>
    paypal
        .Buttons({
            style: {
                layout: 'vertical',
                color: 'gold',
                shape: 'pill',
                label: 'paypal',
            },
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                /**
                 * Cada uno de los objetos del breakdown son opcionales y representan eol desgloce del precio total.
                 * Si no se especifica el breakdown, se puede dejar solamente el objeto amount, con su value y currency code.
                 * El breakdown sirve para que el usuario final vea el desgloce despues de aceptar el pago.
                 * Si se especifica el breakdown. El "value" del amount que es el total, debe ser igual a la suma de todo el desgloce
                 * (subtotal + shipping + handling + tax_total + insurance - descuentos), de no ser así la petición falla.
                 */
                console.log('actions: ', actions);
                console.log('data: ', data);
                return actions.order.create({
                    /**
                     * Una gran variedad de unidades de compra.
                     * Cada unidad de compra establece un contrato entre un pagador y el beneficiario.
                     * Cada unidad de compra representa un pedido total o parcial que el pagador pretende comprar al beneficiario.
                     */
                    purchase_units: [{
                        description: 'Compra de productos a GDLWebcam: $<?php echo $total; ?>',
                        /**
                         *El monto total del pedido con un desglose opcional que proporciona detalles,
                         *como el monto total del artículo, el monto total del impuesto, el envío,
                         *la manipulación, el seguro y los descuentos, si los hubiera.
                         */
                        amount: {
                            currency_code: 'MXN',
                            value: '<?php echo $total; ?>',
                            breakdown: {
                                // El subtotal sin todo el desgloce
                                item_total: {
                                    currency_code: 'MXN',
                                    value: '<?php echo $subtotal; ?>',
                                },
                                // La tarifa de manejo
                                handling: {
                                    currency_code: 'MXN',
                                    value: '<?php echo $handling; ?>',
                                },
                                // El impuesto total.
                                tax_total: {
                                    currency_code: 'MXN',
                                    value: '<?php echo $impuestos; ?>',
                                },
                            },
                        },
                    }, ],
                });
            },
            onApprove: function(data, actions) {
                console.log('Actions: ', actions);
                console.log('Data: ', data);

                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    console.log(details);
                    alert('Pago completado por ' + details.payer.name.given_name);
                });
            },
        })
        .render('#paypal-button-container');
    </script>

</section>


<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>