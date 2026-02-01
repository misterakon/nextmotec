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

                // Tarifs
                $('#modal-category').text(data.category?.name ?? 'Produit');
                $('#modal-price').text(formatPrix(data.price));

                // Footer
                $('#modal-footer-price').text(formatPrix(data.price));

                $('#btn-add-cart').attr('onclick', `addToCart(${data.id})`);

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