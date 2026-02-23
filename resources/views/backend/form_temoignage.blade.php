<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Témoignages</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <form class="modal_form"  action="{{ route('prod.save_temoignage') }}" method="post" enctype="multipart/form-data">
         @csrf  {{-- Token de sécurité obligatoire --}}
          <input type="hidden" name="id_" class="form-control" > {{--pour les update --}}

        <div class="modal-body">
          <div class="row">
            <div class="col-md-9 mb-4">
              <label for="libelle" class="form-label fw-bold">Titre du témoignage <span class="text-danger fw-bold">*</span></label>
              <input type="text" name="titre" class="form-control" placeholder="titre du témoignage" required />
            </div>
            <div class="col-md-3 mb-4">
              <label for="libelle" class="form-label fw-bold">Notation <span class="text-danger fw-bold">*</span></label>
              <input type="number" step="1" name="notation" class="form-control" placeholder="notation" required />
            </div>
          </div>
          <div class="row">
            <div class="col mb-4">
              <label for="libelle" class="form-label fw-bold">Commentaire <span class="text-danger fw-bold">*</span></label>
              <textarea rows="3" name="commentaire" class="form-control" required></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-4">
              <label for="exampleFormControlSelect1" class="form-label fw-bold">Statut <span class="text-danger fw-bold">*</span></label>
              <select class="form-select" name="statut" id="exampleFormControlSelect1" aria-label="Default select example" required>
                <option selected>Statut du temoignage</option>
                <option value="1">Actif</option>
                <option value="0">Inactif</option>
              </select>
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