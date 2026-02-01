@extends('backend.layout.master')
@section('title', 'Type clients')

@section('css')
  @include('backend.layout.css_liste')
@endsection

@section('main-content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- DataTable with Buttons -->
    <div class="card">
      <!-- HEADER -->
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="card-title mb-0">Type de clients</h2>

          <button class="btn btn-dark btn-md" onclick="add_form()">
            <i class="icon-base ti tabler-plus icon-sm"></i> Ajouter
          </button>
        </div>

      <!-- BODY -->
      <div class="card-body">
        <div class="card-datatable table-responsive pt-0">
          <table id="table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>LIBELLE</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($type_client as $d)
              <tr id="row-{{ $d->id }}">
                <td>{{ $d->id }}</td>
                <td>{{ $d->name }}</td>
                <td>
                  <button type="button" class="btn btn-icon rounded-pill btn-success" onclick="edit_type({{ $d->id }})">
                    <i class="icon-base ti tabler-edit icon-sm text-white"></i>
                  </button>
                  <button type="button" class="btn btn-icon rounded-pill btn-danger" onclick="deletes('{{ route('parametre.delete_type', ':id') }}', {{ $d->id }})">
                    <i class="icon-base ti tabler-trash icon-sm text-white"></i>
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- / Content -->

  @include('backend.form_type_client')
  @include('backend.js_script')
@endsection

@section('fichier_js')
  @include('backend.layout.js_fichier')
@endsection