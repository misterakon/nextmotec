<style>
    .guide-modal-content {
        border-radius: 18px;
        overflow: hidden;
        border: 0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
    }

    .guide-modal-header {
        min-height: 110px;
        padding: 28px 36px;
        border-bottom: 1px solid #e9ecef;
    }

    .guide-modal-header .modal-title {
        color: #1a474a;
        font-size: 28px;
        font-weight: 800;
    }

    .guide-modal-body {
        padding: 34px;
        background: #fff;
    }

    .guide-modal-footer {
        min-height: 72px;
        padding: 18px 34px;
        background: #f8fafb;
        border-top: 1px solid #e9ecef;
    }

    .guide-choice-card {
        background: #f6f7f8;
        border: 0;
        border-radius: 16px;
        min-height: 180px;
        padding: 28px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: all 0.2s ease;
        text-align: center;
    }

    .guide-choice-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        background: #eef3f3;
    }

    .guide-choice-icon {
        font-size: 42px;
        color: #1a474a;
        margin-bottom: 18px;
    }

    .guide-choice-label {
        font-size: 22px;
        font-weight: 700;
        color: #2d2d2d;
    }

    .guide-result-card {
        background: #f6f7f8;
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 24px;
    }

    .guide-result-title {
        font-size: 22px;
        font-weight: 800;
        color: #1a474a;
        margin-bottom: 10px;
    }

    .guide-result-desc {
        color: #4e5561;
        font-size: 17px;
        line-height: 1.6;
        margin-bottom: 12px;
    }
    .guide-result-presentation {
        color: #4e5561;
        font-size: 17px;
        line-height: 1.6;
        margin-bottom: 12px;
    }
    .guide-result-list {
        margin: 0 0 20px 0;
        padding-left: 22px;
        color: #5a6270;
        font-size: 15px;
    }

    .guide-result-list li {
        margin-bottom: 6px;
    }

    .guide-result-btn {
        background: #1a474a;
        color: #fff;
        border: 1px solid #1a474a;
        border-radius: 10px;
        padding: 12px 22px;
        font-size: 16px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .guide-result-btn:hover {
        background: #14393c;
        color: #fff;
    }
</style>
<div class="modal fade" id="guideAchatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content guide-modal-content">

            <div class="modal-header guide-modal-header">
                <h3 id="guide-modal-title" class="modal-title fw-bold mb-0">
                    Je suis…
                </h3>

                <button type="button"
                        class="btn-close position-absolute end-0 top-0 mt-4 me-4"
                        data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
            </div>

            <div class="modal-body guide-modal-body">

                {{-- ETAPE 1 : TYPE DE CLIENT --}}
                <div id="guide-step-customer">
                    <div class="row g-4">
                        @foreach($customertypes as $type)
                            <div class="col-md-4">
                                <button type="button"
                                        class="guide-choice-card w-100"
                                        onclick='selectGuideCustomerType(@json($type->slug), @json($type->name))'>
                                    <div class="guide-choice-icon">
                                        <i class="fa-solid fa-user-group"></i>
                                    </div>
                                    <div class="guide-choice-label">
                                        {{ ucfirst($type->name) }}
                                    </div>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ETAPE 2 : TYPE DE SOLUTION --}}
                <div id="guide-step-solution" class="d-none">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <button type="button"
                                    class="guide-choice-card w-100"
                                    onclick="selectGuideCategory('logiciel', 'Logiciels')">
                                <div class="guide-choice-icon">
                                    <i class="fa-solid fa-laptop-code"></i>
                                </div>
                                <div class="guide-choice-label">Logiciels</div>
                            </button>
                        </div>

                        <div class="col-md-4">
                            <button type="button"
                                    class="guide-choice-card w-100"
                                    onclick="selectGuideCategory('formation', 'Formations & Documentation')">
                                <div class="guide-choice-icon">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <div class="guide-choice-label">Formations & Documentation</div>
                            </button>
                        </div>

                        <div class="col-md-4">
                            <button type="button"
                                    class="guide-choice-card w-100"
                                    onclick="selectGuideCategory('services', 'Services & Templates')">
                                <div class="guide-choice-icon">
                                    <i class="fa-solid fa-file-lines"></i>
                                </div>
                                <div class="guide-choice-label">Services & Templates</div>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ETAPE 3 : RESULTATS --}}
                <div id="guide-step-results" class="d-none">
                    <div id="guide-results"></div>
                </div>

            </div>

            <div class="modal-footer guide-modal-footer d-flex justify-content-between align-items-center">
                <button type="button"
                        id="guide-btn-back"
                        class="btn btn-outline-secondary d-none"
                        onclick="backGuideStep()">
                    Retour
                </button>

                <button type="button"
                        class="btn btn-outline-dark"
                        data-bs-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>