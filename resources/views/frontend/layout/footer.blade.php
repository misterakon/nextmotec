<!-- FOOTER SECTION START -->
    <footer class="bg-white relative z-[1] before:absolute before:inset-0 before:-z-[1] before:opacity-[7%] before:bg-no-repeat before:bg-cover before:bg-center">
        <div class="row">

            <!-- footer bottom -->
            <div class="items-center text-center gap-[15px] pt-[20px] pb-[20px] text-[#939191]">
                <p>&copy; 2025 Alerte Foncier. Tous droits réservés<br>Accélérer la transformation numérique du secteur immobilier en Afrique de l'Ouest.</p>
            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END -->

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="{{ asset('public/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/vendor/fslightbox/fslightbox.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/vendor/slim-select/slimselect.min.js') }}"></script>

    <script src="{{ asset('public/frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/accordion.js') }}"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <script>
        // Charger panier au chargement
        $(document).ready(function(){
            $('#passer_commande').hide();

            refreshCart();

            $.get("{{ route('cart.get') }}", function(data){
                renderPanier(data);
            });
        });

        function closeCart(){
            document.getElementById("cartBar").classList.remove("active");
            $(".ed-overlay").removeClass("active");
            $(".page-wrapper").css("overflow", "");
        }

        function toggleUserMenu(event)
        {
            event.stopPropagation();

            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(){
            const menu = document.getElementById('userMenu');

            if(menu){
                menu.classList.add('hidden');
            }
        });

    </script>