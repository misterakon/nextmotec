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
            <div class="col-md-6 mb-4">
              {{-- <label for="exampleFormControlSelect1" class="form-label fw-bold">Type client <span class="text-danger fw-bold">*</span></label>
              <select class="form-select" name="type_client" id="exampleFormControlSelect1" required>
                <option selected>Selectionner une valeur</option>
                @if(!$type_client->isEmpty())
                  @foreach($type_client as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                  @endforeach
                @endif
              </select> --}}
            </div> 

             <div class="col-md-6  mb-4">
              {{-- <label for="exampleFormControlSelect1" class="form-label fw-bold">Catégorie du produit <span class="text-danger fw-bold">*</span></label>
              <select class="form-select" name="categorie" id="exampleFormControlSelect1" required>
                <option selected>Selectionner une valeur</option>
                @if(!$categorie->isEmpty())
                  @foreach($categorie as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                  @endforeach
                @endif
              </select> --}}
            </div> 
          </div>
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
          {{-- <div class="row">
            <div class="col mb-4">
              <label for="libelle" class="form-label fw-bold">Petite Description <span class="text-danger fw-bold">*</span></label>
              <input type="text" name="short_desc" class="form-control" placeholder="...." required />
            </div>
          </div> --}}
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
            {{-- <div class="col-md-8 mb-4">
              <label for="formFile" class="form-label fw-bold">Image du produit <span class="text-danger fw-bold">*</span> (.jpg, .jpeg, .png 330X223) <a href="" target="_blank" class="fic1" style="margin-left:30px"><span class="badge bg-info">Voir l'image</span></a> </label>
              <input class="form-control" type="file" id="formFile" name="image" required />
            </div> --}}
          </div>
          
          {{-- <div class="divider my-2">
            <div class="divider-text fw-bold">Les fonctionnalités <span class="text-danger fw-bold">*</span></div>
          </div> --}}

          {{-- <div id="fonctionnalite-wrapper">

            <div class="row fonctionnalite-item fonctionnalite-master">
              <div class="col-md-10 mb-4">
                <input type="text" name="fonctionnalite[]" class="form-control" placeholder="Fonctionnalité" required>
              </div>

              <div class="col-md-2 mb-4 d-flex gap-2">
                <button type="button" class="btn btn-icon rounded-pill btn-info" onclick="add_ligne_fonctionnalite()" title="Ajouter une ligne">
                  <i class="icon-base ti tabler-plus icon-22px"></i>
                </button>

                <button type="button" class="btn btn-icon rounded-pill btn-danger" onclick="delete_ligne_fonctionnalite()" title="Supprimer">
                  <i class="icon-base ti tabler-trash icon-22px"></i>
                </button>
              </div>
            </div>

          </div> --}}



          <div class="divider my-2">
              {{-- <div class="divider-text fw-bold">Les Documents </div>
            </div> --}}

            {{-- <div id="document-wrapper">

              <div class="row">
                <div class="col-md-2 mb-2">
                  <label for="libelle" class="form-label fw-bold">Type de document <span class="text-danger fw-bold">*</span></label>
                </div>
                <div class="col-md-3 mb-2">
                  <label for="libelle" class="form-label fw-bold">Titre <span class="text-danger fw-bold">*</span></label>
                </div>
                <div class="col-md-6 mb-2">
                  <label for="libelle" class="form-label fw-bold">Fichier ou Lien <span class="text-danger fw-bold">*</span></label>
                </div>
              </div>
              <div class="row document-item document-master">
                <div class="col-md-2 mb-4">
                  <select class="form-select type-doc" name="type_doc[]" onchange="change_type_doc(this)" required>
                    <option value="">Type document</option>
                    <option value="pdf">PDF</option>
                    <option value="video">VIDEO</option>
                  </select>
                </div>

                <div class="col-md-3 mb-4">
                  <input type="text" name="titre_doc[]" class="form-control" placeholder="Titre du document" required>
                </div>

                <div class="col-md-6 mb-4">
                  <input type="hidden" name="doc_id[]" class="doc-id">
                  <input type="file" name="fichier[]" class="form-control fichier">
                  <input type="text" name="lien_video[]" class="form-control lien-video" placeholder="Lien vidéo YouTube" style="display:none;">
                </div>

                <div class="col-md-1 mb-4">
                  <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-icon rounded-pill btn-info add-document" onclick="add_ligne_document()" title="Ajouter un document">
                      <i class="icon-base ti tabler-plus icon-22px"></i>
                    </button>

                    <button type="button" class="btn btn-icon rounded-pill btn-danger remove-document" onclick="delete_ligne_document()" titre="Supprimer une ligne">
                      <i class="icon-base ti tabler-trash icon-22px"></i>
                    </button>
                  </div>
                </div>

              </div> --}}

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