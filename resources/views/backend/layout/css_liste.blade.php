<style>
    #table {
      border: 1px solid #dbdbdb; /* gris clair élégant */
      border-radius: 6px;       /* léger arrondi (optionnel) */
      border-collapse: separate;
      border-spacing: 0;
    }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
      padding: 1rem;
    }

    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
      padding: 0.75rem 1rem;
    }

    #table th,
    #table td {
      padding: 0.75rem 1.25rem; /* vertical | horizontal */
      vertical-align: middle;
    }

    #table thead th {
      background-color: #f3f4f6; /* gris très léger */
      font-weight: 700;
      color: #374151;
      border-bottom: 1px solid #d1d5db;
    }

  </style>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/tagify/tagify.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/typeahead-js/typeahead.css') }}" />

  <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />