@extends('frontend.layout.master')
@section('title', 'Panier')

@section('main-content')
    <main>
        <!-- BREADCRUMB SECTION START -->
        <section class="pt-[327px] xl:pt-[287px] lg:pt-[237px] sm:pt-[200px] xxs:pt-[180px] pb-[158px] xl:pb-[118px] lg:pb-[98px] sm:pb-[68px] xs:pb-[48px] text-center bg-[url('../assets/img/breadcrumb-bg.jpg')] bg-no-repeat bg-cover bg-center relative z-[1] overflow-hidden before:absolute before:-z-[1] before:inset-0 before:bg-edblue/70 before:pointer-events-none">
            <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
                <h1 class="font-semibold text-[clamp(35px,6vw,56px)] text-white">Mon panier d'achat</h1>
                <ul class="flex items-center justify-center gap-[10px] text-white">
                    <li><a href="index.html" class="text-edyellow">Accueil</a></li>
                    <li><span class="text-[12px]"><i class="fa-solid fa-angle-double-right"></i></span></li>
                    <li>Panier</li>
                </ul>
            </div>

            <div class="vectors">
                <img src="{{ asset('public/frontend/assets/img/breadcrumb-vector-1.svg') }}" alt="vector" class="absolute -z-[1] pointer-events-none bottom-[34px] left-0 xl:left-auto xl:right-[90%]">
                <img src="{{ asset('public/frontend/assets/img/breadcrumb-vector-1.svg') }}" alt="vector" class="absolute -z-[1] pointer-events-none bottom-0 right-0 xl:right-auto xl:left-[60%]">
            </div>
        </section>
        <!-- BREADCRUMB SECTION END -->


        <!-- CONTACT SECTION START -->
        <section class="py-[120px] xl:py-[80px] md:py-[60px]" style="margin-bottom: 8%">
            <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
                <div class="border border-[#e5e5e5] rounded-[10px] px-[30px] lg:px-[20px] xxs:px-[15px] py-[35px] lg:py-[25px] xxs:py-[25px]">
                    <h5 class="font-semibold text-[24px] text-edblue mb-[20px]">Mes produits</h5>

                    <table class="datatable w-full border-collapse text-sm">

                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Produit</th>
                                <th class="text-left py-2">Prix</th>
                                <th class="text-left py-2">Quantité</th>
                                <th class="text-left py-2">Total</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="checkout-cart-items">

                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Panier vide
                                </td>
                            </tr>

                        </tbody>

                        <tfoot>
                            <tr class="border-t">
                                <td colspan="3" class="text-right font-bold py-3" style="font-size: 20px">
                                    SOUS TOTAL
                                </td>
                                <td id="checkout-total" colspan="2" class="font-bold py-3" style="font-size: 20px">
                                    0 FCFA
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                    <div class="space-y-[12px] text-end mt-3">
                        <button class="ed-btn !h-[56px] !rounded-[8px] hover:!text-white"
                            style="background-color:#1a474a; border-color:#1a474a">
                            PASSER MA COMMANDE
                        </button>
                    </div>
                </div>
            </div>
        </section>
        
        
        <!-- CONTACT SECTION END -->
    </main>

    @include('frontend.layout.script')
    @include('frontend.layout.cart')

    <div id="modal-container"></div>

@endsection
