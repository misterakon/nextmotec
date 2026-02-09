
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
        .split(/\r?\n/)
        .map(l => l.trim())
        .filter(Boolean)
        .map(l => l.replace(/^[-•]\s*/, ''));
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

        // Trier (optionnel)
        subscriptionTypes = subscriptionTypes.slice().sort((a,b) => Number(a.price) - Number(b.price));

        // ✅ règle : suffix dans tab4 uniquement si plusieurs tarifs
        const showSuffixInTab = subscriptionTypes.length > 1;

        // défaut : 1ère offre sélectionnée
        selectedOffer = subscriptionTypes[0];

        // footer : on peut toujours afficher avec suffix si pertinent
        document.getElementById('modal-footer-price').textContent =
            formatPriceWithSuffix(selectedOffer.price, selectedOffer.type, selectedOffer.achat_unique);

        $('#btn-add-cart').data('offer-id', selectedOffer.id);

        container.innerHTML = subscriptionTypes.map((s, idx) => {
            const bullets = parseBullets(s.description);

            // ✅ tab4 : suffix seulement si plusieurs offres
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
                    <div>
                    <h4 class="fw-bold mb-2">${escapeHtml(s.titre || s.type || 'Offre')}</h4>

                    ${bullets.length ? `
                        <ul class="mb-0">
                        ${bullets.map(b => `<li>${escapeHtml(b)}</li>`).join('')}
                        </ul>
                    ` : (s.description ? `<p class="text-muted mb-0">${escapeHtml(s.description)}</p>` : '')}
                    </div>

                    <div class="text-end" style="min-width: 210px;">
                    <div class="fw-bold" style="color:#1a474a; font-size:28px;">
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

</script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  });

  function moneyFCFA(n) {
    const v = Number(n || 0);
    return v.toLocaleString('fr-FR') + ' FCFA';
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
    document.getElementById('cart-count').textContent = cart.count || 0;
    document.getElementById('cart-total').textContent = cart.total_label || '0 FCFA';
    document.getElementById('cart-badge-count').textContent = cart.count || 0;


    const container = document.getElementById('cart-items');
    if (!cart.items || !cart.items.length) {
      container.innerHTML = `<div class="py-[30px] px-[25px] text-edgray">Panier vide</div>`;
      return;
    }

    container.innerHTML = cart.items.map(item => {
      const suf = offerSuffix(item);
      const priceText = suf ? `${moneyFCFA(item.price)} / ${suf}` : moneyFCFA(item.price);
      const title = item.offer_title ? `${item.name} — ${item.offer_title}` : item.name;

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
          <button onclick="removeFromCart('${item.key}')"
                  class="text-[20px] text-edgray shrink-0 hover:text-edpurple">×</button>
        </div>
      `;
    }).join('');
  }

  async function refreshCart() {
    try {
      const res = await fetch("{{ route('cart.get') }}", { headers: { 'Accept': 'application/json' }});
      const data = await res.json();
      renderCart(data);
    } catch (e) {
      console.error(e);
    }
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
      },
      // error: function (xhr) {
      //   alert("Impossible d'ajouter au panier");
      //   console.error(xhr.responseText);
      // }
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
      },
      error: function (xhr) {
        alert("Impossible de supprimer l'article");
        console.error(xhr.responseText);
      }
    });
  }

  // Charger panier au chargement
  document.addEventListener('DOMContentLoaded', () => {
    refreshCart();
  });
</script>


<script>

    function open_form(id) {
        // reset formulaire si besoin
        const form = document.querySelector('.modal_form');
        if (form) form.reset();

        //alert(typeof $);
        
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

                // Fonctionnalités
                let featuresHtml = '';
                if (data.features && data.features.length) {
                    data.features.forEach(f => {
                    featuresHtml += `
                    <p class="mb-2">
                        <i class="fa-solid fa-check text-success me-2"></i>
                        ${f.title}
                    </p>`;
                });
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

               

                // // Tarifs & Offres
                // const offers = data.subscription_types || data.subscriptionTypes || [];
                // renderOffers(offers);

                // // Footer
                // $('#modal-footer-price').text(formatPrix(data.price));
                // $('#btn-add-cart').attr('onclick', `addToCart(${data.id})`);

                // $('#btn-add-cart').attr('onclick', `addToCart(${data.id})`);

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

                // ✅ Un seul handler click (pas de onclick écrasé)
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
</script>