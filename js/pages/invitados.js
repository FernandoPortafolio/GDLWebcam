$(function () {
  //media queries en JavaScript
  var x = window.matchMedia('(min-width: 768px)');
  cambiar(x);

  x.addEventListener('change', cambiar);
  function cambiar(x) {
    if (x.matches) {
      var width = '50%';
    } else {
      var width = '90%';
    }
    $('.lista-invitados .descripcion').colorbox({
      inline: true,
      width: width,
    });
  }
});
