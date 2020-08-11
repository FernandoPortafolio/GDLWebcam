$(function () {
  //Formulario para crear un admin
  if (document['crear_admin'])
    document['crear_admin'].addEventListener('submit', guardarAdmin);

  if (document['login-admin-form'])
    document['login-admin-form'].addEventListener('submit', login);

  if (document.querySelector('#btn-exit'))
    document.querySelector('#btn-exit').addEventListener('click', logout);

  /**
   * guardarAdmin.
   * Guarda una administrador en la base de datos
   * @return	void
   */
  function guardarAdmin(e) {
    e.preventDefault();
    //esta funcion obtiene los valores de todos los componentes del formulario
    let datos = $(this).serializeArray();
    $.ajax({
      type: 'POST',
      data: datos,
      url: 'admin-model.php',
      dataType: 'json',
      success: function (resp) {
        console.log(resp);
        if (resp.status) {
          alerta('success', 'Usuario creado correctamente', resp.user);
        } else {
          //codigo de llave primaria repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'El usario que intentas regiastrar ya existe'
              : 'Ha habido un error al agregar al usuario';
          alerta('error', text);
        }
      },
    });
  }

  /**
   * login.
   * Loguea a un usuario mediante una peticion AJAX al servidor
   * @return	void
   */
  function login(e) {
    e.preventDefault();
    //esta funcion obtiene los valores de todos los componentes del formulario
    let datos = $(this).serializeArray();
    $.ajax({
      type: 'POST',
      data: datos,
      url: 'admin-model.php',
      dataType: 'json',
      success: function (resp) {
        console.log(resp);
        if (resp.status) {
          document.location = 'admin-area.php';
        } else {
          if (resp.errorno === 1) alerta('error', 'Usuario incorrecto');
          else if (resp.errorno === 2) alerta('error', 'Contraseña incorrecta');
        }
      },
    });
  }

  /**
   * logout.
   * Redicreccional login con un parametro
   * @return	void
   */
  function logout() {
    document.location = 'login.php?cerrar_sesion=true';
  }

  function alerta(icon = 'success', text, title) {
    Swal.fire({
      icon,
      title,
      text,
    });
  }
});
