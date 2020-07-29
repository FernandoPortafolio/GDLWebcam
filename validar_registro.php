<?php if (isset($_POST['submit'])) { ?>
<?php
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total'];
    $fecha = date('Y-m-d H:i:s');

    //pedidos
    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_camisas'];
    $etiquetas = $_POST['pedido_etiquetas'];
    include_once 'includes/functions/funciones.php';
    $pedido = productos_to_json($boletos, $camisas, $etiquetas);

    //eventos
    $registro = $_POST['registro'];
    $eventos = eventos_to_json($registro);
?>
<?php
    //Realizar la conexion a la base de datos
    require_once 'includes/functions/db_conection.php';

    $sql = 'INSERT INTO 
    registro(nombre, apellido, email, fecha, pases_articulos, talleres, total_pago, id_regalo) 
    VALUES (?,?,?,?,?,?,?,?)';
    $ps = $conn->prepare($sql);
    $ps->bind_param('ssssssdi', $nombre, $apellido, $email, $fecha, $pedido, $eventos, $total, $regalo);
    $ps->execute();
    $ps->close();
    $conn->close();

    //redireccionamos con un parametro para controlar que el usuario
    //no haya recargado la pagina
    header('Location: validar_registro.php?exitoso=1');
?>
<?php } ?>

<?php include_once 'includes/templates/head.php'; ?>
<?php include_once 'includes/templates/header.php'; ?>
<section class="seccion contenedor">
    <h2 class="separador justify-center">Resumen Registro</h2>

    <?php
       if (isset($_GET['exitoso'])) {
           if ($_GET['exitoso'] == 1) {
               echo 'Registro Exitoso';
           }
       }
    ?>
</section>



<?php include_once 'includes/templates/footer.php'; ?>
<?php include_once 'includes/templates/scripts.php'; ?>