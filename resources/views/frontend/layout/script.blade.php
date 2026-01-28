<script>

    function open_form() {
        // reset formulaire si besoin
        const form = document.querySelector('.modal_form');
        if (form) form.reset();

        // ouvrir modal
        const modal = new bootstrap.Modal(document.getElementById('simpleModal'));
        modal.show();

    }
</script>