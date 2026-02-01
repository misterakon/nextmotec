@extends('backend.layout.master')
@section('title', 'Catégories')

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
          <h2 class="card-title mb-0">Catégories de produits</h2>

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
              @foreach($categorie as $d)
              <tr id="row-{{ $d->id }}">
                <td>{{ $d->id }}</td>
                <td>{{ $d->name }}</td>
                <td>
                  <button type="button" class="btn btn-icon rounded-pill btn-success" onclick="edit_categorie({{ $d->id }})">
                    <i class="icon-base ti tabler-edit icon-sm text-white"></i>
                  </button>
                  <button type="button" class="btn btn-icon rounded-pill btn-danger" onclick="deletes('{{ route('parametre.delete_categorie', ':id') }}', {{ $d->id }})">
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

  @include('backend.form_categorie')
  @include('backend.js_script')
@endsection

@section('fichier_js')
  @include('backend.layout.js_fichier')
@endsection