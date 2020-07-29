$(function () {
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
    { number: 40 },
    2000
  );
  $('.resumen-evento li:nth-child(3) .numero').animateNumber(
    { number: 3 },
    1200
  );
  $('.resumen-evento li:nth-child(4) .numero').animateNumber(
    { number: 17 },
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
