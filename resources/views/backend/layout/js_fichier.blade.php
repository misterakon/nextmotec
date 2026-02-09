
  <!-- Vendors JS -->
  {{-- <script src="{{ asset('public/backend/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script> --}}
  <!-- Flat Picker -->
  {{-- <script src="{{ asset('public/backend/assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('public/backend/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script> --}}
  <!-- Form Validation -->
  {{-- <script src="{{ asset('public/backend/assets/vendor/libs/@form-validation/popular.js') }}"></script>
  <script src="{{ asset('public/backend/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
  <script src="{{ asset('public/backend/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script> --}}

  <!-- Main JS -->

  <script src="{{ asset('public/backend/assets/js/main.js') }}"></script>
  <script src="{{ asset('public/backend/assets/js/ui-modals.js') }}"></script>

  <!-- sweetalert js-->
  <script src="{{ asset('public/backend/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ asset('public/backend/assets/js/extended-ui-sweetalert2.js') }}"></script>

  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

  <script>
  $(function () {
      $('#table').DataTable({
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      language: {
          search: "Rechercher :",
          lengthMenu: "Afficher _MENU_ lignes",
          info: "Affichage de _START_ à _END_ sur _TOTAL_",
          paginate: {
          previous: "Précédent",
          next: "Suivant"
          }
      }
      });
  });
  </script>

  <!-- Page JS -->
  {{-- <script src="{{ asset('public/backend/assets/js/tables-datatables-basic.js') }}"></script> --}}
  {{-- <script src="{{ asset('public/backend/assets/js/tables-datatables-iniversal.js') }}"></script> --}}

  @include('backend.layout.alert_message')