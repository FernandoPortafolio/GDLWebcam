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

    

</section>


<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>