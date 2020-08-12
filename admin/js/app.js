$(document).ready(function () {
  // page data table script
  $('#tabla').DataTable({
    paging: true,
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
});
