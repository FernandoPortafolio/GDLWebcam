<?php
include_once './functions/funciones.php';

//Crear un administrador en la BD
if (isset($_POST['crear-admin'])) {
    $nombre = $_POST['name'];
    $usuario = $_POST['user'];
    $password = $_POST['password'];

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

//loguear a un usuaio y abrir una sesion en el servidor
if (isset($_POST['login-admin'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        $sql = 'select usuario, nombre, password from admin where usuario = ?';
        $ps = $conn->prepare($sql);
        $ps->bind_param('s', $usuario);
        if ($ps->execute()) {
            $ps->bind_result($user_bd, $nombre_bd, $pass_bd);
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
