<?php

include_once './functions/funciones.php';

$accion = $_POST['accion'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$descripcion = $_POST['descripcion'];
$id_invitado = $_POST['id'];
$archivo = $_FILES['imagen']; //la imagen del invitado

 //subimos un nivel y creamos un directorio en img/
 $directorio = '../img/invitados/';

//Crear un administrador en la BD
if ($accion == 'crear') {
    // die(json_encode([
    // 'post' => $_POST,
    // 'file' => $_FILES,
    // ]));

    //si no existe el directorio se crea
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true); //el true es para que crear carpetas de manera recursiva
    }
    try {
        //movemos el archivo temporal al directorio deseado
        if (move_uploaded_file($archivo['tmp_name'], $directorio.$archivo['name'])) {
            $url = $archivo['name'];

            $sql = 'insert into invitado(nombre, apellido, descripcion, url_foto) values (?,?,?,?)';
            $ps = $conn->prepare($sql);
            $ps->bind_param('ssss', $nombre, $apellido, $descripcion, $url);

            if ($ps->execute()) {
                $respuesta = [
                    'status' => true,
                    'saved' => $nombre.' '.$apellido, //convencion de nombre saved propia para regresar lo guardado
                    'tipo' => 'invitado',
                ];
                $ps->close();
                $conn->close();
                echo json_encode($respuesta);
            } else {
                $ps->close();
                $conn->close();
                throw new Exception($ps->error, $ps->errno);
            }
        } else {
            $error = error_get_last();
            throw new Exception('No se pudo subir la imagen al servidor: '.$error['message'].'. '.'En el archivo: '.$error['file'], $error['type']);
        }
    } catch (Exception $e) {
        $respuesta = [
            'status' => false,
            'error' => $e->getMessage(),
            'errorno' => $e->getCode(),
        ];
        echo json_encode($respuesta);
    }
}

//Editar un administrador en la BD
if ($accion == 'editar') {
    // die(json_encode([
    // 'post' => $_POST,
    // 'file' => $_FILES,
    // ]));

    try {
        if (isset($_FILES['imagen'])) {
            //movemos el archivo temporal al directorio deseado
            if (move_uploaded_file($archivo['tmp_name'], $directorio.$archivo['name'])) {
                $url = $archivo['name'];
                $sql = 'update invitado set nombre = ?, apellido = ?, descripcion = ?, url_foto = ? where id_invitado = ?';
                $ps = $conn->prepare($sql);
                $ps->bind_param('ssssi', $nombre, $apellido, $descripcion, $url, $id_invitado);
            } else {
                $error = error_get_last();
                throw new Exception('No se pudo subir la imagen al servidor: '.$error['message'].'. '.'En el archivo: '.$error['file'], $error['type']);
            }
        } else {
            $sql = 'update invitado set nombre = ?, apellido = ?, descripcion = ? where id_invitado = ?';
            $ps = $conn->prepare($sql);
            $ps->bind_param('sssi', $nombre, $apellido, $descripcion, $id_invitado);
        }
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'saved' => $nombre.' '.$apellido, //convencion de nombre saved propia para regresar lo guardado
                'tipo' => 'invitado',
            ];
        } else {
            throw new Exception($ps->error, $ps->errno);
        }
        $ps->close();
        $conn->close();
        echo json_encode($respuesta);
    } catch (Exception $e) {
        $respuesta = [
            'status' => false,
            'error' => $e->getMessage(),
            'errorno' => $e->getCode(),
        ];
        echo json_encode($respuesta);
    }
}

if ($accion == 'eliminar') {
    try {
        $sql = 'delete from invitado where id_invitado = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('i', $id_invitado);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'id' => $id_invitado,
                'tipo' => 'admin',
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
