$(document).ready(function () {
  // page data table script
  $('#tabla').DataTable({
    paging: false,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    pageLength: 5,
    language: {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero',
      },
      info: 'Mostrando _START_ - _END_ de _TOTAL_ resultados',
      search: 'Buscar',
      emptytable: 'No hay registros',
      infoEmpty: '0 registros',
    },
  });

  //Date picker
  $('#reservationdate').datetimepicker({
    format: 'L',
  });

  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT',
  });

  //Initialize Select2 Elements
  $('.select2').select2({
    placeholder: 'Selecciona una opcion',
    allowClear: false,
    language: 'es',
    width: 'element'
  });
});
