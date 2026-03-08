@extends('frontend.layout.master')
@section('title', 'Profil')

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
        <div class="ed-event-details-content py-[120px] xl:py-[80px] md:py-[60px]" style="margin-bottom: 5%">
            <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
                <div class="flex gap-[30px] lg:gap-[20px] md:flex-col md:items-center">
                    <!-- left sidebar -->
                    <div class="left max-w-full w-[270px] lg:w-[360px] shrink-0 space-y-[30px] md:space-y-[25px]">

                        @include('frontend.layout.menu_client')

                    </div>
                    
                    <div class="right grow space-y-[30px] md:space-y-[20px] bg-edoffwhite">

                        <div class="border border-[#e5e5e5] rounded-[10px] px-[30px] lg:px-[20px] xxs:px-[15px] py-[35px] lg:py-[25px] xxs:py-[25px]">

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-[20px]" role="alert">
                                    <ul class="mt-2 mb-0">
                                        @foreach ($errors->all() as $error)
                                            <strong>Oups !</strong> {{ $error }}
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <h5 class="font-semibold text-[24px] text-edblue mb-[20px]">Mon profil</h5>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-[20px]" role="alert">
                                    <strong>Succès !</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-[20px]" role="alert">
                                    <strong>Oups !</strong> Veuillez corriger les erreurs ci-dessous.

                                    <ul class="mt-2 mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('profil') }}" method="POST" class="grid gap-[30px] xs:gap-[20px] text-[16px]">
                                @csrf

                                <div>
                                    <label for="ed-contact-name" class="font-lato font-semibold text-edblue block mb-[12px]">Nom d'utilisateur *</label>
                                    <input type="text" name="name" value="{{ $profil->name }}" id="ed-contact-email" required placeholder="Votre email" class="border border-[#ECECEC] h-[55px] px-[20px] xs:px-[15px] rounded-[4px] w-full focus:outline-none">
                                </div>
                                <div>
                                    <label for="ed-contact-name" class="font-lato font-semibold text-edblue block mb-[12px]">Email *</label>
                                    <input type="email" name="email" value="{{ $profil->email }}" id="ed-contact-email" required placeholder="Votre email" class="border border-[#ECECEC] h-[55px] px-[20px] xs:px-[15px] rounded-[4px] w-full focus:outline-none">
                                </div>
                                <div>
                                    <label for="ed-contact-name" class="font-lato font-semibold text-edblue block mb-[12px]">N° Téléphone *</label>
                                    <input type="text" name="phone" value="{{ $profil->phone }}" id="ed-contact-phone" required placeholder="Votre N° Téléphone" class="border border-[#ECECEC] h-[55px] px-[20px] xs:px-[15px] rounded-[4px] w-full focus:outline-none">
                                </div>
                                <div>
                                    <label for="ed-contact-name" class="font-lato font-semibold text-edblue block mb-[12px]">Adresse géographique *</label>
                                    <input type="text" name="adresse" value="{{ $profil->adresse }}" id="ed-contact-phone" required placeholder="Adresse" class="border border-[#ECECEC] h-[55px] px-[20px] xs:px-[15px] rounded-[4px] w-full focus:outline-none">
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="bg-edpurple h-[55px] px-[24px] rounded-[10px] text-[16px] font-medium text-white" style="background-color:#1a474a; border-color:#1a474a">
                                        MISE A JOUR <span class="icon pl-[10px]"><i class="fa-solid fa-arrow-right-long"></i></span>
                                    </button>
                                </div>
                            </form>

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
