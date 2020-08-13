<?php

include_once './functions/funciones.php';

$accion = $_POST['accion'];
$categoria = $_POST['categoria'];
$evento = $_POST['evento'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$invitado = $_POST['invitado'];
$id_evento = $_POST['id'];

//Crear un administrador en la BD
if ($accion == 'crear') {
    try {
        //formato a la fecha
        $fecha = date_format(date_create($fecha), 'Y-m-d');

        //formato a la hora
        $hora = date_format(date_create($hora), 'H:i:s');

        //crear una clave
        $clave = substr($evento, 0, 5).'_'.substr($invitado, 0, 2).''.substr($categoria, 0, 2);

        $sql = 'insert into evento(evento, fecha, hora, clave, id_categoria, id_invitado) values (?,?,?,?,?,?)';
        $ps = $conn->prepare($sql);
        $ps->bind_param('ssssii', $evento, $fecha, $hora, $clave, $categoria, $invitado);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'saved' => $evento, //convencion de nombre saved propia para regresar lo guardado
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

//Editar un administrador en la BD
if ($accion == 'editar') {
    try {
        //formato a la fecha
        $fecha = date_format(date_create($fecha), 'Y-m-d');

        //formato a la hora
        $hora = date_format(date_create($hora), 'H:i:s');

        //crear una clave
        $clave = substr($evento, 0, 5).'_'.substr($invitado, 0, 2).''.substr($categoria, 0, 2);

        $sql = 'update evento set evento = ?, fecha = ?, hora = ?, clave = ?, id_categoria = ?, id_invitado = ? where id_evento = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('ssssiii', $evento, $fecha, $hora, $clave, $categoria, $invitado, $id_evento);

        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'saved' => $evento, //convencion de nombre saved propia para regresar lo guardado
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

if ($accion == 'eliminar') {
    try {
        $sql = 'delete from evento where id_evento = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('i', $id_evento);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'id' => $id_evento,
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
