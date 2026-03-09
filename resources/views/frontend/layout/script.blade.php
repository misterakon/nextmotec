{{-- 
<script>

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>"']/g, m => ({
            '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'
        }[m]));
    }

    function parseBullets(desc) {

        if (!desc) return [];

        return String(desc)
            .replace(/\\r\\n/g,"\n")   // transforme \r\n en saut de ligne
            .split(/\n+/)
            .map(l => l.trim())
            .filter(Boolean);
    }
    
    function formatPriceOnly(val) {
        const n = Number(val);
        return (!n || n <= 0) ? 'Sur devis' : n.toLocaleString('fr-FR') + ' FCFA';
    }

    function getSuffix(type, achatUnique) {
        if (achatUnique) return 'Achat unique';
        if (type === 'MENSUEL') return 'mois';
        if (type === 'ANNUEL') return 'an';
        return '';
    }

    function formatPriceWithSuffix(val, type, achatUnique) {
        const base = formatPriceOnly(val);

        if (base === 'Sur devis') return base;
        const suf = getSuffix(type, achatUnique);

        return suf ? `${base} / ${suf}` : base;
    }

    let selectedOffer = null;

    function renderOffers(subscriptionTypes) {

        const container = document.getElementById('modal-offers');
        if (!container) return;

        selectedOffer = null;

        if (!subscriptionTypes || !subscriptionTypes.length) {
            container.innerHTML = `
            <div class="text-muted">
                Aucun tarif détaillé disponible. Contactez-nous pour un devis.
            </div>`;
            return;
        }

        //Trier (optionnel)
        subscriptionTypes = subscriptionTypes.slice().sort((a,b) => Number(a.price) - Number(b.price));

        //Règle : suffix dans tab4 uniquement si plusieurs tarifs
        const showSuffixInTab = subscriptionTypes.length >= 1;

        //Défaut : 1ère offre sélectionnée
        selectedOffer = subscriptionTypes[0];

        // footer : on peut toujours afficher avec suffix si pertinent
        document.getElementById('modal-footer-price').textContent =
            formatPriceWithSuffix(selectedOffer.price, selectedOffer.type, selectedOffer.achat_unique);

        $('#btn-add-cart').data('offer-id', selectedOffer.id);

        container.innerHTML = subscriptionTypes.map((s, idx) => {
            const bullets = parseBullets(s.description);

            //tab4 : suffix seulement si plusieurs offres
            const priceText = showSuffixInTab
            ? formatPriceWithSuffix(s.price, s.type, s.achat_unique)
            : formatPriceOnly(s.price);

            return `
            <div class="card border rounded mb-3 offer-card ${idx === 0 ? 'is-selected' : ''}"
                data-offer-id="${s.id}"
                data-offer-price="${s.price}"
                data-offer-type="${escapeHtml(s.type || '')}"
                data-offer-achat="${s.achat_unique ? 1 : 0}"
                data-offer-title="${escapeHtml(s.titre || s.type || 'Offre')}">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div class="text-start">
                            <h4 class="fw-bold mb-2">${escapeHtml(s.titre || s.type || 'Offre')}</h4>

                            ${bullets.length ? `
                                <ul class="mb-0">
                                ${bullets.map(b => `<li>${escapeHtml(b)}</li>`).join('')}
                                </ul>
                            ` : (s.description ? `<p class="text-muted mb-0">${escapeHtml(s.description)}</p>` : '')}
                        </div>

                        <div class="text-end" style="min-width: 210px;">
                            <div class="fw-bold" style="color:#1a474a; font-size:25px;">
                                ${priceText}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }).join('');

        // click = sélectionner
        container.querySelectorAll('.offer-card').forEach(card => {
            card.addEventListener('click', () => {
            container.querySelectorAll('.offer-card').forEach(c => c.classList.remove('is-selected'));
                card.classList.add('is-selected');

                selectedOffer = {
                    id: Number(card.dataset.offerId),
                    price: Number(card.dataset.offerPrice),
                    type: card.dataset.offerType,
                    achat_unique: card.dataset.offerAchat === '1',
                    titre: card.dataset.offerTitle
                };

                // footer : prix + suffix (logique normale)
                document.getElementById('modal-footer-price').textContent =
                    formatPriceWithSuffix(selectedOffer.price, selectedOffer.type, selectedOffer.achat_unique);
                
                $('#btn-add-cart').data('offer-id', selectedOffer.id);
            });
        });
        
    }

    function offerSuffix(item) {
        // Affichage dans le panier
        if (item.achat_unique) return 'Achat unique';
        if (item.offer_type === 'MENSUEL') return 'mois';
        if (item.offer_type === 'ANNUEL') return 'an';

        return '';
    }

    function openCart() {
        document.getElementById('cartBar')?.classList.add('active');
    }
    function closeCart() {
        document.getElementById('cartBar')?.classList.remove('active');
    }

    function renderCart(cart) {
        $('#cart-count').text(cart.count || 0);
        $('#cart-total').text(cart.total_label || '0 FCFA');
        $('#cart-badge-count').text(cart.count || 0);
        $('#cart-badge-count2').text(cart.count || 0);

        const container = document.getElementById('cart-items');
        if (!cart.items || !cart.items.length) {
            container.innerHTML = `<div class="py-[30px] px-[25px] text-edgray">Panier vide</div>`;
            return;
        }

        if(cart.items.length > 0){
            $('#passer_commande').show();
        }

        container.innerHTML = cart.items.map(item => {
            const suf = offerSuffix(item);
            const priceText = suf ? `${formatPrix(item.price)} / ${suf}` : formatPrix(item.price);
            // const title = item.offer_title ? `${item.name} — ${item.offer_title}` : item.name;
            const title = item.offer_title ? item.name : item.name;

            return `
            <div class="flex items-center gap-[20px] py-[22px] px-[25px] border-b border-edgray/20">
                <img src="${item.image}" alt="Cart Item" class="rounded-[10px] shrink-0 w-[64px] h-[64px] object-cover">
                <div class="grow">
                    <h6 class="font-medium text-[16px] text-edblue">${title}</h6>
                    <div class="flex items-center justify-between">
                        <h6 class="font-medium text-edgray">${priceText}</h6>
                        <span class="text-edgray">x${item.qty}</span>
                    </div>
                </div>
                <button onclick="removeFromCart('${item.key}')" class="text-[20px] text-danger shrink-0 hover:text-edpurple">×</button>
            </div>
            `;
        }).join('');
    }

    function refreshCart() {
        $.ajax({
            url: "{{ route('cart.get') }}",
            type: "GET",
            success: function(data){
                console.log(data);
                renderCart(data);
            }
        });
    }

    function addToCart(productId, subscriptionTypeId = null) {
        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                subscription_type_id: subscriptionTypeId
            },
            success: function (data) {
                renderCart(data);
                openCart();

                //alert('ok');
                //ferme le modal description
                bootstrap.Modal.getOrCreateInstance(document.getElementById('simpleModal')).hide();
            },
            error: function (xhr) {
                console.log('STATUS', xhr.status);
                console.log('RESPONSE', xhr.responseText);
                alert("Impossible d'ajouter au panier");
            }
        });
    }

    function removeFromCart(key) {
        $.ajax({
        url: "{{ route('cart.remove') }}",
        type: "POST",
        dataType: "json",
        data: {
            _token: "{{ csrf_token() }}",
            key: key
        },
        success: function (data) {
            renderCart(data);
            renderPanier(data);
        },
        error: function (xhr) {
            alert("Impossible de supprimer l'article");
            console.error(xhr.responseText);
        }
        });
    }

    $(document).ready(function(){
        refreshCart();

        // $.get("{{ route('cart.get') }}", function(data){
        //     renderPanier(data);
        // });
    });
</script>


<script>

    function open_form(id) {
        // reset formulaire si besoin
        const form = document.querySelector('.modal_form');
        if (form) form.reset();

        //reinitialisation des onglets
        $('.tab-content .tab-pane').removeClass('show active');
        $('#tab1').addClass('show active');

        $('.nav-link').removeClass('active');
        $('.nav-link[data-bs-target="#tab1"]').addClass('active');
        
        $.ajax({
            url: "{{ route('prod.get_produit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "json",
            success: function (data) {
                
                //alert('ok');
                // Header
                $('#modal-title').text(data.name);
                $('#modal-short-desc').text(data.short_desc ?? '—');

                // Présentation
                $('#modal-presentation').html(
                    data.long_desc ? data.long_desc.replace(/\n/g, '<br>') : 'Aucune présentation disponible.'
                );

                //Fonctionnalités
                let featuresHtml = '';
                if (data.features && data.features.length) {
                    // On ouvre une rangée
                    featuresHtml = '<div class="row">'; 
                    
                    data.features.forEach(f => {
                        featuresHtml += `
                        <div class="col-md-6">
                            <p class="mb-2">
                                <i class="fa-solid fa-check text-success me-2"></i>
                                ${f.title}
                            </p>
                        </div>`;
                    });

                    featuresHtml += '</div>'; // On ferme la rangée
                } else {
                    featuresHtml = '<p class="text-muted">Aucune fonctionnalité.</p>';
                }

                $('#modal-features').html(featuresHtml);

                // Documentation
                let docsHtml = '';
                if (data.documentations && data.documentations.length) {
                    data.documentations.forEach(d => {
                    docsHtml += `
                    <a href="${d.url}" target="_blank"
                        class="list-group-item list-group-item-action d-flex align-items-center rounded mb-2 bg-light">
                        <i class="fa-solid fa-file text-danger me-2"></i>
                        <span class="fw-medium">${d.title}</span>
                    </a>`;
                });
                } else {
                    docsHtml = '<p class="text-muted">Aucune documentation disponible.</p>';
                }

                $('#modal-docs').html(docsHtml);

               
                // Tarifs & Offres
                const offers = data.subscription_types || data.subscriptionTypes || [];
                renderOffers(offers);

                // Associer product_id au bouton
                $('#btn-add-cart').data('product-id', data.id);

                // Si on a des offres, renderOffers a déjà mis le footer (ex: Achat unique)
                // Sinon, fallback = prix produit
                if (!offers || offers.length === 0) {
                    $('#modal-footer-price').text(formatPrix(data.price));
                    $('#btn-add-cart').data('offer-id', null);
                }

                //Un seul handler click (pas de onclick écrasé)
                $('#btn-add-cart').off('click').on('click', function () {
                    const productId = $(this).data('product-id');
                    const offerId = $(this).data('offer-id') || null;

                    addToCart(productId, offerId);
                });


                // ouvrir modal
                bootstrap.Modal.getOrCreateInstance(document.getElementById('simpleModal')).show();

            },
            error: function () {
                alert('Impossible de charger les données du produit');
            }
        });

    }

    function formatPrix(val) {
        const n = Number(val);
        return n > 0 ? n.toLocaleString('fr-FR') + ' FCFA' : 'Sur devis';
    }

    //pour la page panier
    function renderPanier(cart)
    {
        const container = document.getElementById('checkout-cart-items');

        if(!cart.items.length){
            container.innerHTML = `
            <tr>
                <td colspan="5" class="text-center py-4">
                    Panier vide
                </td>
            </tr>`;
            return;
        }

        container.innerHTML = cart.items.map(item => {

            const total = item.price * item.qty;

            return `
            <tr>

                <td class="flex items-center gap-3">

                    <img src="${item.image}" width="60">

                    ${item.name}

                </td>

                <td>
                    ${formatPriceOnly(item.price)}
                </td>

                <td>

                    <div class="flex items-center gap-2">

                        <button onclick="updateQty('${item.key}', -1)"
                            class="px-2 py-1 border rounded fw-bold">
                            -
                        </button>

                        <span>${item.qty}</span>

                        <button onclick="updateQty('${item.key}', 1)"
                            class="px-2 py-1 border rounded fw-bold">
                            +
                        </button>

                    </div>

                </td>

                <td>
                    ${formatPriceOnly(total)}
                </td>

                <td>

                    <button onclick="removeFromCart('${item.key}')" class="text-danger fw-bold">
                        X
                    </button>

                </td>

            </tr>
            `;
        }).join('');

        document.getElementById('checkout-total').innerText = cart.total_label;
    }

    function updateQty(key, change)
    {
        $.ajax({
            url: "{{ route('cart.update') }}",
            type: "POST",
            data:{
                _token: "{{ csrf_token() }}",
                key:key,
                change:change
            },
            success:function(data){
                renderPanier(data);
                //mise a jour du mini panier a droite
                renderCart(data);
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }

        });
    }

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
    
</script> --}}

<script>
    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str).replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[m]));
    }

    function parseBullets(desc) {
        if (!desc) return [];

        return String(desc)
            .replace(/\r\n/g, '\n')
            .replace(/\\r\\n/g, '\n')
            .split(/\n+/)
            .map(l => l.trim())
            .filter(Boolean)
            .map(l => l.replace(/^[-•]\s*/, ''));
    }

    function formatPriceOnly(val) {
        const n = Number(val);
        return (!n || n <= 0) ? 'Sur devis' : n.toLocaleString('fr-FR') + ' FCFA';
    }

    function formatPrix(val) {
        const n = Number(val);
        return (!n || n <= 0) ? 'Sur devis' : n.toLocaleString('fr-FR') + ' FCFA';
    }

    /**
     * mode = 'visual'  => pour l'affichage type image jointe
     * mode = 'real'    => pour la logique métier réelle si nécessaire
     */
    function getSuffix(type, achatUnique = false, context = 'card', mode = 'visual') {
        const normalizedType = String(type || '').toUpperCase().trim();

        // Mode visuel demandé : on priorise le type
        if (mode === 'visual') {
            // dans les cartes on cache le suffixe
            if (achatUnique && context === 'card') return '';

            // dans le footer on affiche
            if (achatUnique && context === 'footer') return 'Achat unique';

            if (normalizedType === 'MENSUEL') return 'mois';
            if (normalizedType === 'ANNUEL') return 'an';
            return '';
        }

        // Mode métier réel
        // dans les cartes on cache le suffixe
        if (achatUnique && context === 'card') return '';

        // dans le footer on affiche
        if (achatUnique && context === 'footer') return 'Achat unique';

        if (normalizedType === 'MENSUEL') return 'mois';
        if (normalizedType === 'ANNUEL') return 'an';
        return '';
    }

    function formatPriceWithSuffix(val, type, achatUnique = false, context = 'card', mode = 'visual') {
        const base = formatPriceOnly(val);
        if (base === 'Sur devis') return base;

        const suf = getSuffix(type, achatUnique, context, mode);
        return suf ? `${base} / ${suf}` : base;
    }

    let selectedOffer = null;

    function renderOffers(subscriptionTypes) {
        const container = document.getElementById('modal-offers');
        if (!container) return;

        selectedOffer = null;

        if (!subscriptionTypes || !subscriptionTypes.length) {
            container.innerHTML = `
                <div class="text-muted">
                    Aucun tarif détaillé disponible. Contactez-nous pour un devis.
                </div>`;
            document.getElementById('modal-footer-price').textContent = '';
            $('#btn-add-cart').data('offer-id', null);
            return;
        }

        // tri prix croissant
        subscriptionTypes = subscriptionTypes
            .slice()
            .sort((a, b) => Number(a.price || 0) - Number(b.price || 0));

        // première offre sélectionnée par défaut
        selectedOffer = subscriptionTypes[0];

        document.getElementById('modal-footer-price').textContent =
            formatPriceWithSuffix(
                selectedOffer.price,
                selectedOffer.type,
                selectedOffer.achat_unique,
                'footer',
                'visual'
            );

        $('#btn-add-cart').data('offer-id', selectedOffer.id);

        container.innerHTML = subscriptionTypes.map((s, idx) => {
            const bullets = parseBullets(s.description);
            const title = escapeHtml(s.titre || s.type || 'Offre');

            // ici on garde le visuel "/ mois" ou "/ an" même si achat_unique = 1
            const priceText = formatPriceWithSuffix(
                s.price,
                s.type,
                s.achat_unique,
                'card',
                'visual'
            );

            return `
                <div class="card border rounded mb-3 offer-card ${idx === 0 ? 'is-selected' : ''}"
                    data-offer-id="${Number(s.id) || 0}"
                    data-offer-price="${Number(s.price) || 0}"
                    data-offer-type="${escapeHtml(s.type || '')}"
                    data-offer-achat="${s.achat_unique ? 1 : 0}"
                    data-offer-title="${title}">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                            <div class="text-start">
                                <h4 class="fw-bold mb-3">${title}</h4>

                                ${
                                    bullets.length
                                        ? `
                                            <ul class="mb-0 ps-4">
                                                ${bullets.map(b => `<li>${escapeHtml(b)}</li>`).join('')}
                                            </ul>
                                        `
                                        : (
                                            s.description
                                                ? `<p class="text-muted mb-0">${escapeHtml(s.description)}</p>`
                                                : ''
                                        )
                                }
                            </div>

                            <div class="text-end ms-auto" style="min-width: 230px;">
                                <div class="fw-bold" style="color:#1a474a; font-size:25px;">
                                    ${priceText}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        container.querySelectorAll('.offer-card').forEach(card => {
            card.addEventListener('click', () => {
                container.querySelectorAll('.offer-card').forEach(c => c.classList.remove('is-selected'));
                card.classList.add('is-selected');

                selectedOffer = {
                    id: Number(card.dataset.offerId),
                    price: Number(card.dataset.offerPrice),
                    type: card.dataset.offerType,
                    achat_unique: card.dataset.offerAchat === '1',
                    titre: card.dataset.offerTitle
                };

                document.getElementById('modal-footer-price').textContent =
                    formatPriceWithSuffix(
                        selectedOffer.price,
                        selectedOffer.type,
                        selectedOffer.achat_unique,
                        'footer',
                        'visual'
                    );

                $('#btn-add-cart').data('offer-id', selectedOffer.id);
            });
        });
    }

    function offerSuffix(item) {
        // visuel panier : on garde aussi le type prioritaire
        // return getSuffix(item.offer_type, item.achat_unique, 'visual');
          // priorité absolue à achat_unique
        if (Number(item.achat_unique) === 1) {
            return 'Achat unique';
        }

        const type = (item.offer_type || '').toUpperCase();

        if (type === 'MENSUEL') return 'mois';
        if (type === 'ANNUEL') return 'an';

        return '';
    }

    function openCart() {
        document.getElementById('cartBar')?.classList.add('active');
    }

    function closeCart() {
        document.getElementById('cartBar')?.classList.remove('active');
    }

    function renderCart(cart) {
        $('#cart-count').text(cart.count || 0);
        $('#cart-total').text(cart.total_label || '0 FCFA');
        $('#cart-badge-count').text(cart.count || 0);
        $('#cart-badge-count2').text(cart.count || 0);

        const container = document.getElementById('cart-items');
        if (!container) return;

        if (!cart.items || !cart.items.length) {
            container.innerHTML = `<div class="py-[30px] px-[25px] text-edgray">Panier vide</div>`;
            $('#passer_commande').hide();
            return;
        }

        $('#passer_commande').show();

        container.innerHTML = cart.items.map(item => {
            const suf = offerSuffix(item);
            const priceText = suf ? `${formatPrix(item.price)} / ${suf}` : formatPrix(item.price);
            const title = item.offer_title ? item.name : item.name;

            return `
                <div class="flex items-center gap-[20px] py-[22px] px-[25px] border-b border-edgray/20">
                    <img src="${item.image}" alt="Cart Item" class="rounded-[10px] shrink-0 w-[64px] h-[64px] object-cover">
                    <div class="grow">
                        <h6 class="font-medium text-[16px] text-edblue">${escapeHtml(title)}</h6>
                        <div class="flex items-center justify-between">
                            <h6 class="font-medium text-edgray">${priceText}</h6>
                            <span class="text-edgray">x${item.qty}</span>
                        </div>
                    </div>
                    <button onclick="removeFromCart('${item.key}')" class="text-[20px] text-danger shrink-0 hover:text-edpurple">×</button>
                </div>
            `;
        }).join('');
    }

    function refreshCart() {
        $.ajax({
            url: "{{ route('cart.get') }}",
            type: "GET",
            success: function(data) {
                renderCart(data);
            }
        });
    }

    function addToCart(productId, subscriptionTypeId = null) {
        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                subscription_type_id: subscriptionTypeId
            },
            success: function(data) {
                renderCart(data);
                openCart();
                bootstrap.Modal.getOrCreateInstance(document.getElementById('simpleModal')).hide();
            },
            error: function(xhr) {
                console.log('STATUS', xhr.status);
                console.log('RESPONSE', xhr.responseText);
                alert("Impossible d'ajouter au panier");
            }
        });
    }

    function removeFromCart(key) {
        $.ajax({
            url: "{{ route('cart.remove') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                key: key
            },
            success: function(data) {
                renderCart(data);
                renderPanier(data);
            },
            error: function(xhr) {
                alert("Impossible de supprimer l'article");
                console.error(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        refreshCart();
    });
</script>

<script>
    function open_form(id) {
        const form = document.querySelector('.modal_form');
        if (form) form.reset();

        $('.tab-content .tab-pane').removeClass('show active');
        $('#tab1').addClass('show active');

        $('.nav-link').removeClass('active');
        $('.nav-link[data-bs-target="#tab1"]').addClass('active');

        $.ajax({
            url: "{{ route('prod.get_produit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#modal-title').text(data.name || '');
                $('#modal-short-desc').text(data.short_desc ?? '—');

                $('#modal-presentation').html(
                    data.long_desc
                        ? escapeHtml(data.long_desc).replace(/\n/g, '<br>')
                        : 'Aucune présentation disponible.'
                );

                let featuresHtml = '';
                if (data.features && data.features.length) {
                    featuresHtml = '<div class="row">';
                    data.features.forEach(f => {
                        featuresHtml += `
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="fa-solid fa-check text-success me-2"></i>
                                    ${escapeHtml(f.title)}
                                </p>
                            </div>`;
                    });
                    featuresHtml += '</div>';
                } else {
                    featuresHtml = '<p class="text-muted">Aucune fonctionnalité.</p>';
                }
                $('#modal-features').html(featuresHtml);

                let docsHtml = '';
                if (data.documentations && data.documentations.length) {
                    data.documentations.forEach(d => {
                        docsHtml += `
                            <a href="${d.url}" target="_blank"
                               class="list-group-item list-group-item-action d-flex align-items-center rounded mb-2 bg-light">
                                <i class="fa-solid fa-file text-danger me-2"></i>
                                <span class="fw-medium">${escapeHtml(d.title)}</span>
                            </a>`;
                    });
                } else {
                    docsHtml = '<p class="text-muted">Aucune documentation disponible.</p>';
                }
                $('#modal-docs').html(docsHtml);

                const offers = data.subscription_types || data.subscriptionTypes || [];
                renderOffers(offers);

                $('#btn-add-cart').data('product-id', data.id);

                if (!offers || offers.length === 0) {
                    $('#modal-footer-price').text(formatPrix(data.price));
                    $('#btn-add-cart').data('offer-id', null);
                }

                $('#btn-add-cart').off('click').on('click', function() {
                    const productId = $(this).data('product-id');
                    const offerId = $(this).data('offer-id') || null;
                    addToCart(productId, offerId);
                });

                bootstrap.Modal.getOrCreateInstance(document.getElementById('simpleModal')).show();
            },
            error: function() {
                alert('Impossible de charger les données du produit');
            }
        });
    }

    function renderPanier(cart) {
        const container = document.getElementById('checkout-cart-items');
        if (!container) return;

        if (!cart.items || !cart.items.length) {
            container.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-4">
                        Panier vide
                    </td>
                </tr>`;
            document.getElementById('checkout-total').innerText = cart.total_label || '0 FCFA';
            return;
        }

        container.innerHTML = cart.items.map(item => {
            const total = Number(item.price || 0) * Number(item.qty || 0);
            const suf = offerSuffix(item);
            const unitPrice = suf ? `${formatPriceOnly(item.price)} / ${suf}` : formatPriceOnly(item.price);

            return `
                <tr>
                    <td class="flex items-center gap-3">
                        <img src="${item.image}" width="60" alt="${escapeHtml(item.name)}">
                        ${escapeHtml(item.name)}
                    </td>

                    <td>${unitPrice}</td>

                    <td>
                        <div class="flex items-center gap-2">
                            <button onclick="updateQty('${item.key}', -1)" class="px-2 py-1 border rounded fw-bold">-</button>
                            <span>${item.qty}</span>
                            <button onclick="updateQty('${item.key}', 1)" class="px-2 py-1 border rounded fw-bold">+</button>
                        </div>
                    </td>

                    <td>${formatPriceOnly(total)}</td>

                    <td>
                        <button onclick="removeFromCart('${item.key}')" class="text-danger fw-bold">X</button>
                    </td>
                </tr>
            `;
        }).join('');

        document.getElementById('checkout-total').innerText = cart.total_label || '0 FCFA';
    }

    function updateQty(key, change) {
        $.ajax({
            url: "{{ route('cart.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                key: key,
                change: change
            },
            success: function(data) {
                renderPanier(data);
                renderCart(data);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
</script>