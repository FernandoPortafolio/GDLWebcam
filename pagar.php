<?php

if (!isset($_POST['submit'])) {
    die('Hubo un error');
}

include_once 'includes/functions/funciones.php';
require_once 'includes/functions/db_conection.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$fecha = date('Y-m-d H:i:s');
$regalo = $_POST['regalo'];
$total = $_POST['total'];

//pedido
$boletos = $_POST['boletos'];
$camisas = $_POST['pedido_extra']['camisas']['cantidad'];
$precioCamisas = $_POST['pedido_extra']['camisas']['precio'];
$etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
$precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];
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
$id_registro = $ps->insert_id;
$ps->close();
$conn->close();

require 'includes/paypal_conf.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

//Se crea la entidad comprador
$compra = new Payer();
$compra->setPaymentMethod('paypal');

//Agregar los articulos a una lista
$listaArticulos = new ItemList();

//Se crean tantos articulos como se necesiten
foreach ($_POST['boletos'] as $key => $value) {
    if ((int) $value['cantidad'] > 0) {
        $articulo = new Item();
        $articulo->setName('Pase: '.$key)
                 ->setCurrency('USD')
                 ->setQuantity((int) $value['cantidad'])
                 ->setPrice($value['precio'] - $value['precio'] * 0.16);
        $listaArticulos->addItem($articulo);
    }
}

foreach ($_POST['pedido_extra'] as $key => $value) {
    if ((int) $value['cantidad'] > 0) {
        $precio = $value['precio'];
        $precio -= $precio * 0.16;
        $precio = $key == 'camisas' ? $precio * 0.93 : (float) $precio;

        $articulo = new Item();
        $articulo->setName('Extra: '.$key)
                 ->setCurrency('USD')
                 ->setQuantity((int) $value['cantidad'])
                 ->setPrice($precio);
        $listaArticulos->addItem($articulo);
    }
}

//detalles de la compra
$impuestos = $total * 0.16;
$subtotal = round($total - $impuestos, 2);

$detalles = new Details();
$detalles->setSubtotal($subtotal)
         ->setTax($impuestos);

//total a pagar con todo y desgloce
$cantidad = new Amount();
$cantidad->setCurrency('USD')
         ->setTotal($total)
         ->setDetails($detalles);

//Crear una transaccion que junta todo lo anterior
$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago a GDLWebcamp')
            ->setInvoiceNumber($id_registro);

// //Definir las rutas de direccion. Son requeridas
$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO.'/pago_finalizado.php?id_pago='.$id_registro)
              ->setCancelUrl(URL_SITIO.'/pago_finalizado.php?id_pago='.$id_registro);

// //Procesar el pago
$pago = new Payment();
$pago->setPayer($compra)
     ->setIntent('sale')
     ->setRedirectUrls($redireccionar)
     ->setTransactions([$transaccion]);

try {
    $pago->create($apiContext);
} catch (PayPalConnectionException $e) {
    echo '<pre>';
    print_r(json_decode($e->getData()));
    exit();
    echo '</pre>';
}

$aprobado = $pago->getApprovalLink();
header('Location: '.$aprobado);
