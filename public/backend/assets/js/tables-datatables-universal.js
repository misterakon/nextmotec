document.addEventListener('DOMContentLoaded', function () {
  const tables = document.querySelectorAll('.datatable-universal');

  tables.forEach(table => {
    new DataTable(table, {
      responsive: true,
      autoWidth: false,
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      language: {
        search: 'Rechercher',
        lengthMenu: 'Afficher _MENU_ lignes',
        info: 'Affichage de _START_ à _END_ sur _TOTAL_',
        paginate: {
          next: '›',
          previous: '‹'
        }
      }
    });
  });
});
