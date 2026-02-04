<div class="modal fade" id="simpleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-top">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header flex-column align-items-start">
        <h3 id="modal-title" class="modal-title fw-bold mb-1" style="color:#1a474a"></h3>
        <p id="modal-short-desc" class="text-muted mb-0"></p>

        <button type="button"
                class="btn-close position-absolute end-0 top-0 mt-3 me-3"
                data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3 custom-tabs">
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">
              Présentation
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">
              Fonctionnalités
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">
              Documentation
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab4">
              Tarifs & Offres
            </button>
          </li>
        </ul>

        <div class="tab-content mb-4">

          <!-- Présentation -->
          <div class="tab-pane fade show active" id="tab1">
            <div id="modal-presentation" class="text-muted"></div>
          </div>

          <!-- Fonctionnalités -->
          <div class="tab-pane fade" id="tab2">
            <div id="modal-features"></div>
          </div>

          <!-- Documentation -->
          <div class="tab-pane fade" id="tab3">
            <div id="modal-docs" class="list-group list-group-flush"></div>
          </div>

          <!-- Tarifs -->
          <div class="tab-pane fade" id="tab4">
            <div class="card border rounded">
              <div class="card-body">
                {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 id="modal-category" class="mb-0 fw-bold"></h5>
                  <span id="modal-price" class="fw-bold text-success fs-5"></span>
                </div>

                <ul class="mb-0">
                  <li>Accès au produit</li>
                  <li>Support technique</li>
                  <li>Mises à jour</li>
                </ul> --}}
                <div id="modal-offers"></div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer d-flex justify-content-between align-items-center" style="background-color:#f9fafb">
        <h4 id="modal-footer-price" class="m-0 fw-bold" style="color:#1a474a"></h4>

        <button id="btn-add-cart"
                class="btn btn-primary btn-lg px-7"
                style="background-color:#1a474a; border-color:#1a474a">
          Ajouter au panier
        </button>
      </div>

    </div>
  </div>
</div>

