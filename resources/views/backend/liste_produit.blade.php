@extends('backend.layout.master')
@section('title', 'Liste des Produits')

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
          <h2 class="card-title mb-0">Liste des produits</h2>

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
                <th>LIBELLE</th>
                <th>PRIX</th>
                <th>TYPE_CLIENT</th>
                <th>CETEGORIE</th>
                <th>PRESENTATION</th>
                <th>STATUT</th>
                <th class="text-center" style="width:10%;">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              @if(!$produit->isEmpty())
                @foreach($produit as $d)
                <tr id="row-{{ $d->id }}">
                  <td>{{ $d->name }}</td>
                  <td>{{ $d->price }}</td>
                  <td>{{ $d->customerType->name }}</td>
                  <td>{{ $d->category->name }}</td>
                  <td>{{ $d->short_desc }}</td>
                  <td><span class="badge bg-label-{{ $d->active == 1 ? 'success':'danger' }}">{{ $d->active == 1 ? 'Actif':'Inactif' }}</span></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-icon rounded-pill btn-success" onclick="edit_produit({{ $d->id }})" title="Modifier">
                      <i class="icon-base ti tabler-edit icon-sm text-white"></i>
                    </button>
                    <button type="button" class="btn btn-icon rounded-pill btn-danger" onclick="deletes('{{ route('prod.delete_produit', ':id') }}', {{ $d->id }})" title="Supprimer">
                      <i class="icon-base ti tabler-trash icon-sm text-white"></i>
                    </button>
                    {{-- <button type="button" class="btn btn-icon rounded-pill btn-warning" onclick="fonctionnalite({{ $d->id }})" title="Fonctionnalités & Documentation">
                      <i class="icon-base ti tabler-list icon-sm text-white"></i>
                    </button> --}}
                  </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- / Content -->

  @include('backend.form_produit')
  @include('backend.js_script')
@endsection

@section('fichier_js')
  @include('backend.layout.js_fichier')

  <script>
    $('.lien_video').hide();

    if()
  </script>

@endsection