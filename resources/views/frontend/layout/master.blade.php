<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

{{-- <script>
    function openProductModal(productId) {

        // Sécurité : vider le contenu précédent
        document.getElementById('modalTitle').innerText = 'Chargement...';
        document.getElementById('modalShortDesc').innerText = '';
        document.getElementById('modalLongDesc').innerText = '';
        document.getElementById('modalFeatures').innerHTML = '';
        document.getElementById('modalDocs').innerHTML = '';
        document.getElementById('modalPrice').innerText = '';

        fetch(``{{ url('/products') }}/${productId}/details``)
            .then(response => response.json())
            .then(data => {

                /* ===== Header ===== */
                document.getElementById('modalTitle').innerText = data.name;
                document.getElementById('modalShortDesc').innerText = data.short_desc ?? '';
                document.getElementById('modalLongDesc').innerText = data.long_desc ?? '';

                /* ===== Prix ===== */
                document.getElementById('modalPrice').innerText =
                    data.price > 0
                        ? new Intl.NumberFormat('fr-FR').format(data.price) + ' FCFA'
                        : 'Sur devis';

                /* ===== Fonctionnalités ===== */
                let featuresHtml = '';
                if (data.features.length > 0) {
                    data.features.forEach(feature => {
                        featuresHtml += `
                            <li class="mb-2">
                                <i class="fa-solid fa-check text-success me-2"></i>
                                ${feature.title}
                            </li>`;
                    });
                } else {
                    featuresHtml = '<p class="text-muted">Aucune fonctionnalité.</p>';
                }
                document.getElementById('modalFeatures').innerHTML = featuresHtml;

                /* ===== Documentation ===== */
                let docsHtml = '';
                if (data.docs.length > 0) {
                    data.docs.forEach(doc => {
                        docsHtml += `
                            <a href="${doc.url ?? '#'}"
                            target="_blank"
                            class="list-group-item list-group-item-action d-flex align-items-center rounded mb-2 bg-light">
                                <i class="fa-solid fa-file text-danger me-2"></i>
                                <span class="fw-medium">${doc.title}</span>
                            </a>`;
                    });
                } else {
                    docsHtml = '<p class="text-muted">Aucune documentation.</p>';
                }
                document.getElementById('modalDocs').innerHTML = docsHtml;

                /* ===== Ouvrir le modal ===== */
                const modal = new bootstrap.Modal(
                    document.getElementById('simpleModal')
                );
                modal.show();
            })
            .catch(error => {
                console.error(error);
                alert('Erreur lors du chargement du produit');
            });
    }
</script> --}}
{{-- <script>
    const PRODUCT_DETAILS_URL = @json(route('products.details', ['product' => ':id']));
</script>

<script>
    window.openProductModal = function (productId) {
        const url = PRODUCT_DETAILS_URL.replace(':id', productId);

        fetch(url, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => {
                const modal = new bootstrap.Modal(
                    document.getElementById('simpleModal')
                );
                modal.show();
            });
    };
</script> --}}
<script>
    async function openProductModal(productId) {
        const url = window.PRODUCT_MODAL_URL.replace('__ID__', productId);

        const response = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!response.ok) {
            alert("Impossible de charger les détails du produit.");
            return;
        }

        const html = await response.text();
        document.getElementById('modal-container').insertAdjacentHTML('beforeend', html);

        const modalEl = document.getElementById(`simpleModal-${productId}`);
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
        }


    // Exemple: à adapter à ton panier
    function addToCart(productId) {
        console.log("Add to cart:", productId);
        // fetch('/cart/add', { method:'POST', ... })
    }
</script>

{{-- <script>
  window.PRODUCT_MODAL_URL = @json(route('products.modal', ['product' => '__ID__']));
</script> --}}



{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <div class="ed-overlay group">
        <div class="fixed inset-0 z-[100] group-[.active]:bg-edblue/80 duration-[400ms] pointer-events-none group-[.active]:pointer-events-auto"></div>
    </div>

    <!-- cart -->
    @include('frontend.layout.cart')

    <!-- search -->
    <div class="ed-search group">
        <form action="#" class="bg-white fixed z-[100] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] h-[100px] md:h-[70px] xxs:h-[50px] w-[1224px] max-w-[95%] flex gap-[10px] rounded-full overflow-hidden px-[40px] xxs:px-[20px] pointer-events-none opacity-0 group-[.active]:pointer-events-auto group-[.active]:opacity-100 duration-[400ms]">
            <input type="search" name="ed-search" placeholder="Recherche..." class="bg-transparent w-full focus:outline-none">
            <button class="text-[25px] md:text-[22px] xxs:text-[20px]"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <!-- sidebar -->
    <div class="ed-sidebar">
        <div class="translate-x-[100%] transition-transform ease-linear duration-300 fixed right-0 w-full max-w-[25%] xl:max-w-[30%] lg:max-w-[40%] md:max-w-[50%] sm:max-w-[60%] xxs:max-w-full bg-white h-full z-[100] overflow-auto">
            <!-- heading -->
            <div class="ed-sidebar-heading p-[20px] lg:p-[20px] border-b border-edgray/20">
                <div class="logo flex justify-between items-center">
                    <a href="index.html"><img src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo"></a>

                    <button type="button" class="ed-sidebar-close-btn border border-edgray/20 w-[45px] aspect-square shrink-0 text-black text-[22px] rounded-full hover:text-edpurple"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <!-- mobile menu -->
            <div class="ed-header-nav-in-mobile"></div>
        </div>
    </div>

    <!-- HEADER SECTION START -->
    <header>
        @include('frontend.layout.header')
    </header>
    <!-- HEADER SECTION END -->

    <main>
        @yield('main-content')
    </main>

    @include('frontend.layout.footer')
</body>

</html>