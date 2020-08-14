$(function () {
  //Formulario para crear. Todos los formularios tienen el mismo ID
  // para crear un flujo de funciones reutilizables.
  if (document.querySelector('#form_crear')) {
    document.querySelector('#form_crear').addEventListener('submit', guardar);
  }

  //Casos especifios del formulario para crear un admin
  if (document['crear_admin']) {
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

  //Formulario para editar.
  if (document.querySelector('#form_editar')) {
    document.querySelector('#form_editar').addEventListener('submit', editar);
  }

  //Formulario para editar un admin
  if (document['editar_admin']) {
    document['editar_admin'].inputRepPassword.addEventListener(
      'input',
      validatePassword
    );
  }

  //boton para eliminar un registro. Se reutiliza para todos los vormularios
  $('.borrar_registro').on('click', borrar);

  //formulario para crear cuando este maneja archivos
  if (document.querySelector('#form_crear_archivo')) {
    document
      .querySelector('#form_crear_archivo')
      .addEventListener('submit', guardarConArchivo);
  }

  //formulario para editar cuando este maneja archivos
  if (document.querySelector('#form_editar_archivo')) {
    document
      .querySelector('#form_editar_archivo')
      .addEventListener('submit', editarConArchivo);
  }

  //formulario de login
  if (document['login-admin'])
    document['login-admin'].addEventListener('submit', login);

  /**
   * guardar.
   * Hace una peticion AJAX al modelo correspondiente para guardar un registro y le manda los datos del formulario.
   * El modelo se obtiene desde el atributo del formulario y con esto se crea una funcion reutilizable.
   */
  function guardar(e) {
    e.preventDefault();
    //esta funcion obtiene los valores de todos los componentes del formulario
    let datos = $(this).serializeArray();
    $.ajax({
      type: 'POST',
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (resp) {
        console.log(resp);
        if (resp.status) {
          alerta('success', 'Exito al guardar', resp.saved).then(() => {
            document.location = `lista-${resp.tipo}.php`;
          });
        } else {
          //codigo de llave repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'El usario que intentas registrar ya existe'
              : 'Ha habido un error al guardar';
          alerta('error', text);
        }
      },
    });
  }

  /**
   * guardar.
   * Hace una peticion AJAX al modelo correspondiente para guardar un registro y le manda los datos del formulario.
   * El modelo se obtiene desde el atributo del formulario y con esto se crea una funcion reutilizable
   * La peticion AJAX cambia cuando se manda un archivo.
   */
  function guardarConArchivo(e) {
    e.preventDefault();

    var datos = new FormData(this);

    $.ajax({
      type: 'POST',
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (resp) {
        console.log(resp);
        if (resp.status) {
          alerta('success', 'Exito al guardar', resp.saved).then(() => {
            document.location = `lista-${resp.tipo}.php`;
          });
        } else {
          //codigo de llave repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'El usario que intentas registrar ya existe'
              : 'Ha habido un error al guardar';
          alerta('error', text);
        }
      },
    });
  }

  /**
   * editar.
   * Hace una peticion AJAX al modelo correspondiente para editar un registro y le manda los datos del formulario.
   * El modelo se obtiene desde el atributo del formulario y con esto se crea una funcion reutilizable.
   * @return	void
   */
  function editar(e) {
    e.preventDefault();
    //esta funcion obtiene los valores de todos los componentes del formulario
    let datos = $(this).serializeArray();
    $.ajax({
      type: 'POST',
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (resp) {
        console.log(resp);
        if (resp.status) {
          alerta('success', 'Edicion realizada', resp.saved).then(() => {
            document.location = `lista-${resp.tipo}.php`;
          });
        } else {
          //codigo de llave repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'Este nombre de usuario ya existe'
              : 'Ha habido un error al guardar';
          alerta('error', text);
        }
      },
    });
  }

  /**
   * editar.
   * Hace una peticion AJAX al modelo correspondiente para editar un registro y le manda los datos del formulario.
   * El modelo se obtiene desde el atributo del formulario y con esto se crea una funcion reutilizable.
   * @return	void
   */
  function editarConArchivo(e) {
    e.preventDefault();
    var datos = new FormData(this);
    $.ajax({
      type: 'POST',
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (resp) {
        console.log(resp);
        if (resp.status) {
          alerta('success', 'Edicion realizada', resp.saved).then(() => {
            document.location = `lista-${resp.tipo}.php`;
          });
        } else {
          //codigo de llave repetida que devuelve mysql
          var text =
            resp.errorno === 1062
              ? 'Este nombre de usuario ya existe'
              : 'Ha habido un error al guardar';
          alerta('error', text);
        }
      },
    });
  }

  /**
   * borrar.
   * Hace una peticion AJAX al modelo correspondiente para editar un registro y le manda los el id a eliminar.
   * El modelo se forma con el atributo data-tipo del boton, que debe especificarse en el formulario
   */
  function borrar(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let tipo = $(this).attr('data-tipo');

    alertConfirm().then(function (result) {
      if (result) {
        $.ajax({
          type: 'POST',
          data: {
            id,
            accion: 'eliminar',
          },
          url: `modelo-${tipo}.php`,
          dataType: 'json',
          success: function (resp) {
            console.log(resp);
            if (resp.status) {
              alerta('success', 'Elemento eliminado correctamente');
              $(`[data-id="${resp.id}"]`).parents('tr').remove();
            } else alerta('error', 'Ha ocurrido un error al eliminar');
          },
        });
      }
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
      url: 'modelo-admin.php',
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
    return Swal.fire({
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
