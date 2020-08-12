<?php

include_once './functions/funciones.php';

$nombre = $_POST['name'];
$usuario = $_POST['user'];
$id_admin = $_POST['id_admin'];
$password = $_POST['password'];
$accion = $_POST['accion'];

//Crear un administrador en la BD
if ($accion == 'crear') {
    $opciones = [
        'cost' => 12,
    ];
    $hashed_pass = password_hash($password, PASSWORD_BCRYPT, $opciones);

    try {
        $sql = 'insert into admin(usuario, nombre, password) values (?,?,?)';
        $ps = $conn->prepare($sql);
        $ps->bind_param('sss', $usuario, $nombre, $hashed_pass);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'user' => $usuario,
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
        if (!empty($password)) {
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $sql = 'update admin set nombre = ?, usuario = ?, password = ? where id_admin = ?';
            $ps = $conn->prepare($sql);
            $ps->bind_param('sssi', $nombre, $usuario, $hashed_pass, $id_admin);
        } else {
            $sql = 'update admin set nombre = ?, usuario = ? where id_admin = ?';
            $ps = $conn->prepare($sql);
            $ps->bind_param('ssi', $nombre, $usuario, $id_admin);
        }
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'user' => $usuario,
                'id_admin' => $id_admin,
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
        $sql = 'delete from admin where id_admin = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('i', $id_admin);
        if ($ps->execute()) {
            $respuesta = [
                'status' => true,
                'id_admin' => $id_admin,
                'user' => $usuario,
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

//loguear a un usuario y abrir una sesion en el servidor
if ($accion == 'login') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        $sql = 'select id_admin, usuario, nombre, password, nivel from admin where usuario = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('s', $usuario);
        if ($ps->execute()) {
            $ps->bind_result($id_bd, $user_bd, $nombre_bd, $pass_bd, $nivel_bd);
            if ($ps->fetch()) {
                if (password_verify($password, $pass_bd)) {
                    $respuesta = [
                        'status' => true,
                        'user' => $usuario,
                    ];

                    //iniciar una sesion en el servidor
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['nombre'] = $nombre_bd;
                    $_SESSION['nivel'] = $nivel_bd;
                    $_SESSION['id_admin'] = $id_bd;
                } else {
                    throw new Exception('Contraseña incorrecta', 2);
                }
            } else {
                throw new Exception('El usuario no existe', 1);
            }
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
