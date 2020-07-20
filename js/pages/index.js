$(function () {
  'use strict';
  //campos datos_usuario
  var txtNombre = document.getElementById('nombre');
  var txtApellido = document.getElementById('apellido');
  var txtEmail = document.getElementById('email');

  //campos pases
  var nmbPaseDia = document.getElementById('pase_dia');
  var nmbPaseDosDias = document.getElementById('pase_dos_dias');
  var nmbPaseCompleto = document.getElementById('pase_completo');

  //botones y divs
  var btnCalcular = document.getElementById('calcular');
  var btnRegistro = document.getElementById('btnRegistro');
  var divError = document.getElementById('error');
  var divListaProductos = document.getElementById('lista-productos');
  var divSuma = document.getElementById('suma-total');

  //extras
  var nmbEtiquetas = document.getElementById('etiquetas');
  var nmbCamisas = document.getElementById('camisas');
  var comboRegalo = document.getElementById('regalo');

  btnCalcular.addEventListener('click', calcularMontos);
  nmbPaseDia.addEventListener('change', mostrarDias);
  nmbPaseDosDias.addEventListener('change', mostrarDias);
  nmbPaseCompleto.addEventListener('change', mostrarDias);

  txtNombre.addEventListener('blur', validarCampos);
  txtApellido.addEventListener('blur', validarCampos);
  txtEmail.addEventListener('blur', validarCampos);
  txtEmail.addEventListener('blur', validarEmail);

  function validarCampos(event) {
    if (this.value === '') {
      divError.style.display = 'block';
      divError.innerHTML = 'Este campo es obligatorio';
      this.style.border = '1px solid red';
    } else {
      this.style.border = '1px solid #cccccc';
      divError.style.display = 'none';
    }
  }

  function validarEmail() {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(txtEmail.value)) {
      this.style.border = '1px solid #cccccc';
      divError.style.display = 'none';
    } else {
      divError.style.display = 'block';
      divError.innerHTML = 'Email Inválido';
      this.style.border = '1px solid red';
    }
  }

  function calcularMontos(event) {
    event.preventDefault();
    if (comboRegalo.value === '') {
      alert('Debes elegir un regalo');
      comboRegalo.focus();
    } else {
      var boletosDia = parseInt(nmbPaseDia.value, 10) || 0;
      var boletosDosDias = parseInt(nmbPaseDosDias.value, 10) || 0;
      var boletosCompleto = parseInt(nmbPaseCompleto.value, 10) || 0;
      var cantCamisas = parseInt(nmbCamisas.value, 10) || 0;
      var cantEtiquetas = parseInt(nmbEtiquetas.value, 10) || 0;

      var total =
        boletosDia * 30 +
        boletosDosDias * 45 +
        boletosCompleto * 50 +
        cantCamisas * 10 * 0.93 +
        cantEtiquetas * 2;

      var listaProductos = [];
      if (boletosDia >= 1) {
        listaProductos.push(boletosDia + ' Pases por día');
      }
      if (boletosDosDias >= 1) {
        listaProductos.push(boletosDosDias + ' Pases por 2 día');
      }
      if (boletosCompleto >= 1) {
        listaProductos.push(boletosCompleto + ' Pases completos');
      }
      if (cantCamisas >= 1) {
        listaProductos.push(cantCamisas + ' Camisas');
      }
      if (cantEtiquetas >= 1) {
        listaProductos.push(cantEtiquetas + ' Etiquetas');
      }

      divListaProductos.style.display = 'block';
      divListaProductos.innerHTML = '';
      for (var producto of listaProductos) {
        divListaProductos.innerHTML += `${producto} <br>`;
      }
      divSuma.innerHTML = `$${total.toFixed(2)}`;
    }
  }

  function mostrarDias() {
    var boletosDia = parseInt(nmbPaseDia.value, 10) || 0;
    var boletosDosDias = parseInt(nmbPaseDosDias.value, 10) || 0;
    var boletosCompleto = parseInt(nmbPaseCompleto.value, 10) || 0;

    var dias = ['viernes', 'sabado', 'domingo'];
    var diasElegidos = [];
    if (boletosDia > 0) {
      diasElegidos.push('viernes');
    }
    if (boletosDosDias > 0) {
      diasElegidos.push('viernes', 'sabado');
    }
    if (boletosCompleto > 0) {
      diasElegidos.push('viernes', 'sabado', 'domingo');
    }

    for (var dia of dias) {
      var divDia = document.getElementById(dia);
      divDia.style.display = diasElegidos.includes(dia) ? 'block' : 'none';
    }
  }
});

(function () {
  'use strict';

  //creamos el mapa con el codigo ofrecido en leafletjs.com
  var map = L.map('mapa').setView([20.482314, -100.961799], 16);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  L.marker([20.482314, -100.961799])
    .addTo(map)
    .bindPopup('GDLWebcam 2020 <br> Boletos ya disponibles')
    .openPopup();
})();

$(function () {
  'use strict';

  //Programa del evento en el index
  //ocutar los ul 2 y 3
  $('.programa-evento ul:nth(1)').hide();
  $('.programa-evento ul:nth(2)').hide();

  $('.menu-programa a:first').addClass('activo');
  $('.menu-programa a').click(cambiarTab);

  function cambiarTab(e) {
    e.preventDefault();
    var enlace = $(this).attr('href');

    //ocultar todos los ul y mostrar el correspondiente
    $('.programa-evento ul').hide();
    $(enlace).fadeIn(500);

    //activar el tab con una clase css
    $('.menu-programa a').removeClass('activo');
    $(this).addClass('activo');
  }

  //animaciones para los numeros del parallax
  $('.resumen-evento li:nth-child(1) .numero').animateNumber(
    { number: 6 },
    1200
  );
  $('.resumen-evento li:nth-child(2) .numero').animateNumber(
    { number: 15 },
    2000
  );
  $('.resumen-evento li:nth-child(3) .numero').animateNumber(
    { number: 3 },
    1200
  );
  $('.resumen-evento li:nth-child(4) .numero').animateNumber(
    { number: 9 },
    1200
  );

  //animaciones para el contador del evento
  $('.cuenta-regresiva').countdown('2020/09/21 07:00:00', function (event) {
    $('#dias').html(event.strftime('%D'));
    $('#horas').html(event.strftime('%H'));
    $('#minutos').html(event.strftime('%M'));
    $('#segundos').html(event.strftime('%S'));
  });
});
