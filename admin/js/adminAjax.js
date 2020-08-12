$(function () {
  //Formulario para crear un admin
  if (document['crear_admin']) {
    document['crear_admin'].addEventListener('submit', guardarAdmin);
    document['crear_admin'].inputRepPassword.addEventListener(
      'input',
      validatePassword
    );
    document['crear_admin'].inputPassword.addEventListener(
      'input',
      validatePassword
    );
    document.querySelector('#guardar').disabled = true;
  }

  //Formulario para editar un admin
  if (document['editar_admin']) {
    document['editar_admin'].addEventListener('submit', editarAdmin);
    document['editar_admin'].inputRepPassword.addEventListener(
      'input',
      validatePassword
    );
  }

  //formulario de login
  if (document['login-admin'])
    document['login-admin'].addEventListener('submit', login);

  //boton para eliminar un registro. Se reutiliza para todos los tipos
  $('.borrar_registro').on('click', function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let tipo = $(this).attr('data-tipo');
    let user = $(this).parent().parent().children().eq(0).text();

    alertConfirm().then(function (result) {
      if (result) {
        $.ajax({
          type: 'POST',
          data: {
            id_admin: id,
            user,
            accion: 'eliminar',
          },
          url: `${tipo}-model.php`,
          dataType: 'json',
          success: function (resp) {
            console.log(resp);
            if (resp.status) {
              alerta('success', 'Usuario eliminado correctamente', resp.user);
              $(`[data-id="${resp.id_admin}"]`).parents('tr').remove();
            } else
              alerta('error', 'Ha ocurrido un error al eliminar al usuario');
          },
        });
      }
    });
  });

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
          //codigo de llave repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'El usario que intentas registrar ya existe'
              : 'Ha habido un error al agregar al usuario';
          alerta('error', text);
        }
      },
    });
  }

  /**
   * editarAdmin.
   * Edita un administrador mediante AJAX
   * @return	void
   */
  function editarAdmin(e) {
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
          alerta('success', 'Usuario editado correctamente', resp.user);
        } else {
          //codigo de llave repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'Este nombre de usuario ya existe'
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
   * validatePassword.
   * Verifica que las dos cvontraseñas sean iguales
   * @return	void
   */
  function validatePassword(e) {
    let password = $('#inputPassword').val();
    let repPass = $('#inputRepPassword').val();
    if (password !== repPass) {
      $('#inputRepPassword').addClass('is-invalid');
      document.querySelector('#resultado_password').textContent =
        'Las contraseñas no coinciden';
    } else {
      $('#inputRepPassword').removeClass('is-invalid');
      $('#inputRepPassword').addClass('is-valid');
      document.querySelector('#resultado_password').textContent = '';
      document.querySelector('#guardar').disabled = false;
    }
  }

  function alerta(icon = 'success', text, title) {
    Swal.fire({
      icon,
      title,
      text,
    });
  }

  async function alertConfirm(
    text = 'Esta acción no se puede deshacer',
    title = '¿Estas Seguro?',
    confirmButtonText = 'Sí, eliminar!'
  ) {
    result = await Swal.fire({
      title,
      text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText,
    });
    return result.value;
  }
});
