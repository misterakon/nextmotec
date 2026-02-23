@extends('backend.layout.master')
@section('title', 'Liste des témoignages')

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
          <h2 class="card-title mb-0">Liste des témoignages</h2>

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
                <th>TITRE</th>
                <th>NOTATION</th>
                <th>NOM DU CLIENT</th>
                <th>COMMENTAIRE</th>
                <th>DATE DE CREATION</th>
                <th>STATUT</th>
                <th class="text-center" style="width:10%;">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
                @if(!$temoignage->isEmpty())
                @foreach($temoignage as $d) 
                 <tr id="row-{{ $d->id }}"> 
                  <td>{{ $d->titre }}</td>
                  <td>{{ $d->notation }}</td>
                  <td>{{ $d->customer_id}}</td>
                  <td>{{ $d->contenue }}</td>
                  <td>{{ $d->created_at }}</td>
                  <td><span class="badge bg-label-{{ $d->active == 1 ? 'success':'danger' }}">{{ $d->active == 1 ? 'Actif':'Inactif' }}</span></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-icon rounded-pill btn-success" onclick="edit_temoignage({{ $d->id }})" title="Modifier">
                      <i class="icon-base ti tabler-edit icon-sm text-white"></i>
                    </button>
                    <button type="button" class="btn btn-icon rounded-pill btn-danger" onclick="deletes('{{ route('prod.delete_temoignage', ':id') }}', {{ $d->id }})" title="Supprimer">
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

  @include('backend.form_temoignage')
  @include('backend.js_script')
@endsection

@section('fichier_js')
  @include('backend.layout.js_fichier')

  <script>
    $('.lien_video').hide();

    if()
  </script>
@endsection