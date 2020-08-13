<?php

include_once './functions/funciones.php';

$accion = $_POST['accion'];
$categoria = $_POST['categoria'];
$icono = $_POST['icono'];
$id_categoria = $_POST['id'];

//Crear un administrador en la BD
if ($accion == 'crear') {
    // die(json_encode($_POST));
    try {
        $sql = 'insert into categoria(categoria, icono) values (?,?)';
        $ps = $conn->prepare($sql);
        $ps->bind_param('ss', $categoria, $icono);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'saved' => $categoria, //convencion de nombre saved propia para regresar lo guardado
                'tipo' => 'categoria',
            ];
        } else {
            throw new Exception($ps->error, $ps->errno);
        }
    } catch (Exception $e) {
        $respuesta = [
            'status' => false,
            'error' => $e->getMessage(),
            'errorno' => $e->getCode(),
        ];
    } finally {
        $ps->close();
        $conn->close();
        echo json_encode($respuesta);
    }
}

//Editar un administrador en la BD
if ($accion == 'editar') {
    try {
        $sql = 'update categoria set categoria = ?, icono = ? where id_categoria = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('sss', $categoria, $icono, $id_categoria);

        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'saved' => $categoria, //convencion de nombre saved propia para regresar lo guardado
                'tipo' => 'categoria',
            ];
        } else {
            throw new Exception($ps->error, $ps->errno);
        }
    } catch (Exception $e) {
        $respuesta = [
            'status' => false,
            'error' => $e->getMessage(),
            'errorno' => $e->getCode(),
        ];
    } finally {
        $ps->close();
        $conn->close();
        echo json_encode($respuesta);
    }
}

if ($accion == 'eliminar') {
    try {
        $sql = 'delete from categoria where id_categoria = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('i', $id_categoria);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'id' => $id_categoria,
                'tipo' => 'evento',
            ];
        } else {
            throw new Exception($ps->error, $ps->errno);
        }
    } catch (Exception $e) {
        $respuesta = [
            'status' => false,
            'error' => $e->getMessage(),
            'errorno' => $e->getCode(),
        ];
    } finally {
        $ps->close();
        $conn->close();
        echo json_encode($respuesta);
    }
}
