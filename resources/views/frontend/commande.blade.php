@extends('frontend.layout.master')
@section('title', 'Tableau de board')

@section('main-content')
    <main>
        <!-- BREADCRUMB SECTION START -->
        <section class="pt-[327px] xl:pt-[287px] lg:pt-[237px] sm:pt-[200px] xxs:pt-[180px] pb-[158px] xl:pb-[118px] lg:pb-[98px] sm:pb-[68px] xs:pb-[48px] text-center bg-[url('../assets/img/breadcrumb-bg.jpg')] bg-no-repeat bg-cover bg-center relative z-[1] overflow-hidden before:absolute before:-z-[1] before:inset-0 before:bg-edblue/70 before:pointer-events-none">
            <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
                <h1 class="font-semibold text-[clamp(35px,6vw,56px)] text-white">Mon espace client</h1>
                <ul class="flex items-center justify-center gap-[10px] text-white">
                    <li><a href="index.html" class="text-edyellow">Accueil</a></li>
                    <li><span class="text-[12px]"><i class="fa-solid fa-angle-double-right"></i></span></li>
                    <li>Tableau de bord</li>
                </ul>
            </div>

            <div class="vectors">
                <img src="{{ asset('public/frontend/assets/img/breadcrumb-vector-1.svg') }}" alt="vector" class="absolute -z-[1] pointer-events-none bottom-[34px] left-0 xl:left-auto xl:right-[90%]">
                <img src="{{ asset('public/frontend/assets/img/breadcrumb-vector-1.svg') }}" alt="vector" class="absolute -z-[1] pointer-events-none bottom-0 right-0 xl:right-auto xl:left-[60%]">
            </div>
        </section>
        <!-- BREADCRUMB SECTION END -->


        <!-- MAIN CONTENT START -->
        <div class="ed-event-details-content py-[120px] xl:py-[80px] md:py-[60px]" >
            <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
                <div class="flex gap-[30px] lg:gap-[20px] md:flex-col md:items-center">
                    <!-- left sidebar -->
                    <div class="left max-w-full w-[270px] lg:w-[360px] shrink-0 space-y-[30px] md:space-y-[25px]">

                        @include('frontend.layout.menu_client')

                    </div>
                    
                    <div class="right grow space-y-[30px] md:space-y-[20px] bg-edoffwhite">

                        <div class="border border-[#e5e5e5] rounded-[10px] px-[30px] lg:px-[20px] xxs:px-[15px] py-[35px] lg:py-[25px] xxs:py-[25px]">

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mb-[20px]" role="alert">
                                    <strong>Oups !</strong> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <h5 class="font-semibold text-[24px] text-edblue mb-[20px]">Mes commandes</h5>

                            <table class="datatable w-full border-collapse text-sm">

                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left py-2">N°</th>
                                        <th class="text-left py-2">Montant</th>
                                        <th class="text-left py-2">Statut</th>
                                        <th class="text-left py-2">date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($commandes as $commande)

                                        <tr>

                                            <td class="py-4">
                                                {{ $commande->code }}
                                            </td>

                                            <td class="py-4 fw-bold">
                                                {{ number_format($commande->montant_total,0,',',' ') }} FCFA
                                            </td>

                                            <td class="py-4">

                                                @if($commande->statut == 'en_attente')
                                                    <span class="badge" style="background-color: #037794">En attente</span>
                                                @elseif($commande->statut == 'payee')
                                                    <span class="badge" style="background-color: #077c42">Payée</span>
                                                @else
                                                    <span class="badge" style="background-color: #e63c3c">{{ $commande->statut }}</span>
                                                @endif

                                            </td>

                                            <td class="py-4">
                                                {{ date('d-m-Y', strtotime($commande->date_commande)) }}
                                            </td>

                                            <td class="text-center py-4">

                                                @if($commande->statut == 'en_attente')
                                                    <form action="{{ route('paiement') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" name="id" value="{{ $commande->id }}">
                                                        <input type="hidden" name="url_back" value="{{ url()->current() }}">
                                                        <button type="submit" class="badge" style="background-color:#077c42;border:none;">
                                                            PROCEDER AU PAIEMENT
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>

                                        </tr>

                                        @empty

                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                Aucune commande
                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                    
                </div>
            </div>
        </div>
        <!-- MAIN CONTENT END -->

    </main>

    @include('frontend.layout.script')
    @include('frontend.layout.cart')

    <div id="modal-container"></div>

@endsection
