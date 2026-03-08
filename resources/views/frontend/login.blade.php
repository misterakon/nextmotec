@extends('frontend.layout.master')
@section('title', 'Connexion')

@section('main-content')
    <main>
        <!-- BREADCRUMB SECTION START -->
        <section class="pt-[327px] xl:pt-[287px] lg:pt-[237px] sm:pt-[200px] xxs:pt-[180px] pb-[158px] xl:pb-[118px] lg:pb-[98px] sm:pb-[68px] xs:pb-[48px] text-center bg-[url('../assets/img/breadcrumb-bg.jpg')] bg-no-repeat bg-cover bg-center relative z-[1] overflow-hidden before:absolute before:-z-[1] before:inset-0 before:bg-edblue/70 before:pointer-events-none">
            <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
                <h1 class="font-semibold text-[clamp(35px,6vw,56px)] text-white">Se connecter à son espace</h1>
                <ul class="flex items-center justify-center gap-[10px] text-white">
                    <li><a href="index.html" class="text-edyellow">Accueil</a></li>
                    <li><span class="text-[12px]"><i class="fa-solid fa-angle-double-right"></i></span></li>
                    <li>Connexion</li>
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
                <div class="flex md:flex-col justify-between items-center gap-x-[60px] xl:gap-x-[40px] gap-y-[40px]">
                    <!-- img -->
                    <div class="max-w-[50%] md:max-w-full grow relative">
                        <img src="{{ asset('public/frontend/assets/img/about-img.png') }}" alt="about image">
                        <img src="{{ asset('public/frontend/assets/img/about-img-vector.svg') }}" alt="vector" class="absolute -top-[25px] left-[25px] -z-[1] w-[90%] max-w-[100%]">
                    </div>

                    <!-- txt -->
                    <div class="bg-edoffwhite max-w-[50%] md:max-w-full shrink-0 grow mb-[12px]" style="padding: 20px 20px 20px 20px">
                        <h2 class="text-[40px] text-center md:text-[35px] sm:text-[30px] xxs:text-[28px] font-semibold text-edblue mb-[7px]">Formulaire de connexion</h2>
                        <p class="text-edgray text-center font-normal text-[16px] mb-[38px]">Veuillez vous connecter avec vos identiants</p>

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

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('connexion') }}" method="POST" class="grid gap-[30px] xs:gap-[20px] text-[16px]">
                            @csrf
                            
                            <div>
                                <label for="ed-contact-name" class="font-lato font-semibold text-edblue block mb-[12px]">Identifiant *</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="ed-contact-email" required placeholder="Votre email" class="border border-[#ECECEC] h-[55px] px-[20px] xs:px-[15px] rounded-[4px] w-full focus:outline-none">
                            </div>
                            <div>
                                <label for="ed-contact-email" class="font-lato font-semibold text-edblue block mb-[12px]">Mot de passe*</label>
                                <input type="password" name="password" value="{{ old('password') }}" id="password" required placeholder="Your mot de passe" class="border border-[#ECECEC] h-[55px] px-[20px] xs:px-[15px] rounded-[4px] w-full focus:outline-none">
                            </div>
                            <div class="text-center">
                                <p class="mb-2">Pas de compte? <a href="{{ route('inscription') }}">s'inscrire ici</a></p>
                                <button type="submit" class="bg-edpurple h-[55px] px-[24px] rounded-[10px] text-[16px] font-medium text-white" style="background-color:#1a474a; border-color:#1a474a">
                                    Se connecter <span class="icon pl-[10px]"><i class="fa-solid fa-user"></i></span>
                                </button>
                            </div>
                        </form>
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
