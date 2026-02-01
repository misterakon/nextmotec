<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Type client</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <form class="modal_form"  action="{{ route('parametre.save_type') }}" method="post" enctype="multipart/form-data">
         @csrf  {{-- Token de sécurité obligatoire --}}
          <input type="hidden" name="id_" class="form-control" > {{--pour les update --}}

        <div class="modal-body">
          <div class="row">
            <div class="col mb-4">
              <label for="libelle" class="form-label">Libelle</label>
              <input type="text" name="libelle" class="form-control" placeholder="Libelle" required />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" style="background-color:#646e73; color:#FFF" class="btn" data-bs-dismiss="modal">
            Fermer
          </button>
          <button type="submit" style="background-color:#016b12; color:#FFF" class="btn bouton">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>