<div class="modal fade" id="simpleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header flex-column align-items-start">
                <h3 class="modal-title fw-bold mb-1" style="color:#1a474a">
                    {{ $product->name }}
                </h3>

                <p class="text-muted mb-0">
                    {{ $product->short_desc ?? '—' }}
                </p>

                <button type="button"
                        class="btn-close position-absolute end-0 top-0 mt-3 me-3"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3 custom-tabs">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1-{{ $product->id }}">
                            Présentation
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2-{{ $product->id }}">
                            Fonctionnalités
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3-{{ $product->id }}">
                            Documentation
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab4-{{ $product->id }}">
                            Tarifs & Offres
                        </button>
                    </li>
                </ul>

                <div class="tab-content mb-4">

                    <!-- Présentation -->
                    <div class="tab-pane fade show active" id="tab1-{{ $product->id }}">
                        {!! nl2br(e($product->long_desc ?? 'Aucune présentation disponible.')) !!}
                    </div>

                    <!-- Fonctionnalités -->
                    <div class="tab-pane fade" id="tab2-{{ $product->id }}">
                        @if($product->features->count())
                            <div class="row g-3">
                                @foreach($product->features->chunk(2) as $chunk)
                                    <div class="col-md-6">
                                        @foreach($chunk as $feature)
                                            <p class="mb-2">
                                                <i class="fa-solid fa-check text-success me-2"></i>
                                                {{ $feature->title }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted mb-0">Aucune fonctionnalité enregistrée.</p>
                        @endif
                    </div>

                    <!-- Documentation -->
                    <div class="tab-pane fade" id="tab3-{{ $product->id }}">
                        @if($product->documentations->count())
                            <div class="list-group list-group-flush">
                                @foreach($product->documentations as $doc)
                                    <a href="{{ $doc->url ?? '#' }}"
                                       target="_blank"
                                       class="list-group-item list-group-item-action d-flex align-items-center rounded mb-3 bg-light">
                                        <i class="fa-solid fa-file text-danger me-2"></i>
                                        <span class="fw-medium">{{ $doc->title }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted mb-0">Aucune documentation disponible.</p>
                        @endif
                    </div>

                    <!-- Tarifs & Offres -->
                    <div class="tab-pane fade" id="tab4-{{ $product->id }}">
                        <div class="card border rounded">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 fw-bold">{{ ucfirst($product->category->name ?? 'Produit') }}</h5>

                                    <span class="fw-bold text-success fs-5">
                                        {{ $product->price > 0
                                            ? number_format($product->price, 0, ',', ' ') . ' FCFA'
                                            : 'Sur devis' }}
                                    </span>
                                </div>

                                <ul class="mb-0">
                                    <li>Accès au produit</li>
                                    <li>Support technique (selon offre)</li>
                                    <li>Mises à jour (si applicable)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer d-flex justify-content-between align-items-center" style="background-color:#f9fafb">
                <h1 class="h4 m-0 fw-bold" style="color:#1a474a">
                    {{ $product->price > 0
                        ? number_format($product->price, 0, ',', ' ') . ' FCFA'
                        : 'Sur Devis' }}
                </h1>

                <button class="btn btn-primary btn-lg px-7"
                        style="background-color:#1a474a; border-color:#1a474a"
                        onclick="addToCart({{ $product->id }})">
                    Ajouter au panier
                </button>
            </div>

        </div>
    </div>
</div>
