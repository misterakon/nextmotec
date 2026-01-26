@extends('frontend.layout.master')
@section('title', 'Accueil')


@section('main-content')

    <!-- COURSES SECTION START -->
    <section class="ed-2-courses py-[120px] xl:py-[80px] md:py-[60px]" style="margin-top: 6%">
        <div class="mx-[9.2%] xxxl:mx-[8.2%] xxl:mx-[3%]">
            <!-- section heading -->
            <div class="text-center mb-[21px]">
                <h1 class="ed-section-title" style="color: #1A474A">Votre Partenaire Stratégique en Immobilier</h1>
                <p style="font-size:18px; color: #4d4d4d">Des solutions logicielles et des formations conçues pour les professionnels qui façonnent<br> l'immobilier de demain en Afrique de l'Ouest.</p>
            </div>
            <br><br>
            <div class="text-center mb-[21px]">
                {{-- <h6 class="ed-section-sub-title">Nos solutions</h6> --}}
                {{-- <h2 class="ed-section-title">Trouvez la solution adaptée à votre métier</h2> --}}
                <h1 class="font-bold text-center">Trouvez la solution adaptée à votre métier</h1>
                <p style="font-size:16px; color: #4d4d4d">Sélectionnez votre profil pour découvrir les outils et formations que nous avons conçus pour vous.</p>
            </div>

            <div class="ed-2-courses-filter-navs flex flex-wrap justify-center gap-[10px] mb-[40px] xs:mb-[30px] pb-[30px] xs:pb-[20px] border-b border-[#002147]/15 mx-[200px] lg:mx-[100px] md:mx-[12px] *:border *:border-edpurple *:rounded-[6px] *:py-[5px] *:px-[10px] *:text-edpurple *:font-medium *:text-[14px]">
                <button class="hover:bg-edpurple hover:text-white" data-filter="all">Tous</button>
                <button class="hover:bg-edpurple hover:text-white" data-filter=".promotteur">Promotteur</button>
                <button class="hover:bg-edpurple hover:text-white" data-filter=".gestionnaire">Gestionnaire</button>
                <button class="hover:bg-edpurple hover:text-white" data-filter=".commercial">Commercial</button>
                <button class="hover:bg-edpurple hover:text-white" data-filter=".investisseur">Investisseur</button>
            </div>

            <!-- course cards -->
            <div class="ed-2-courses-container grid grid-cols-4 xl:grid-cols-3 md:grid-cols-2 xs:grid-cols-1 gap-[30px] xxl:gap-[20px]">
                <!-- single course -->
                <div class="ed-2-single-course mix promotteur border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-1.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        {{-- <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span> --}}
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">100 000 FCFA</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix gestionnaire investisseur border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-2.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        {{-- <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span> --}}
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">100 000 FCFA</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix commercial border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-3.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        {{-- <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span> --}}
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">100 000 FCFA</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix promotteur gestionnaire border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-4.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        {{-- <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span> --}}
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">100 000 FCFA</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix investisseur commercial border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-3.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span>
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">$59.00</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix promotteur border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-1.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span>
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">$59.00</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix promotteur gestionnaire border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-4.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span>
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">$59.00</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

                <!-- single course -->
                <div class="ed-2-single-course mix commercial border border-[#e5e5e5] rounded-[10px] p-[20px] group">
                    <!-- course image  -->
                    <div class="relative overflow-hidden rounded-[10px] mb-[24px]">
                        <img src="{{ asset('public/frontend/assets/img/course-2.jpg') }}" alt="Course Image" class="aspect-[330/223] w-full object-cover group-hover:scale-110">
                        <span class="absolute bg-edyellow px-[10px] h-[33px] flex gap-[8px] items-center top-[16px] left-[16px] rounded-[6px]">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/clock.svg') }}" alt="icon"></span>
                            <span class="txt">8h 30m</span>
                        </span>
                    </div>

                    <!-- course infos -->
                    <div class="flex justify-between items-center mb-[16px]">
                        <span class="inline-flex items-center justify-center border border-[#e5e5e5] px-[10px] h-[33px] rounded-[6px] font-medium text-[#808080] text-[14px]">Expert</span>
                        <span class="text-edpurple font-semibold text-[20px]">$59.00</span>
                    </div>

                    <!-- course title -->
                    <h5 class="font-semibold text-[20px] text-edblue mb-[23px]"><a href="course-details.html" class="hover:text-edpurple">Financial Analyst Training & Investing Course</a></h5>

                    <!-- course stats -->
                    <div class="flex flex-wrap items-center gap-x-[30px] gap-y-[10px]">
                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/user-group.svg') }}" alt="icon"></span>
                            <span class="txt">169 Students</span>
                        </div>

                        <div class="flex items-center gap-[8px] text-[14px] text-edgray">
                            <span class="icon"><img src="{{ asset('public/frontend/assets/img/icon/lesson.svg') }}" alt="icon"></span>
                            <span class="txt">12 Lesson</span>
                        </div>
                    </div>

                    <!-- course footer -->
                    <div class="flex flex-wrap gap-x-[20px] gap-y-[15px] justify-between items-center border-t border-[#E5E5E5] pt-[24px] mt-[24px]">
                        <button class="h-[50px] px-[22px] border border-edpurple rounded-[8px] flex gap-[8px] items-center justify-center group hover:text-white hover:bg-edpurple">
                            <span>Voir les détails</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- COURSES SECTION END -->


    <!-- ABOUT SECTION START -->
    {{-- <section class="ed-2-about bg-edoffwhite py-[120px] xl:py-[80px] md:py-[60px] relative z-[1] before:absolute before:inset-0 before:-z-[1] before:bg-[url('../assets/img/about-us-bg.png')] before:opacity-[5%] before:bg-no-repeat before:bg-cover before:bg-center before:mix-blend-multiply">
        <div class="mx-[19.7%] xxxl:mx-[14.7%] xxl:mx-[9.7%] xl:mx-[3.2%] md:mx-[15px]">
            <div class="flex md:flex-col gap-x-[75px] gap-y-[30px]">
                <!-- left -->
                <div class="max-w-[46%] md:max-w-full grow shrink-0">
                    <div class="relative flex items-end">
                        <img src="{{ asset('public/frontend/assets/img/about-2-image-1.png') }}" alt="About Image" class="border-[12px] border-white rounded-full">

                        <!-- video btn -->
                        <div class="relative shrink-0 -ml-[202px] lg:-ml-[262px] md:-ml-[202px] xs:-ml-[242px] -mb-[24px]">
                            <img src="{{ asset('public/frontend/assets/img/about-2-image-2.png') }}" alt="About Image" class="border-[8px] border-white rounded-full w-[292px] xs:w-[252px] aspect-square">
                            <a href="https://youtu.be/5ppDzM8m9lI?si=zml3HbV176DBsZlg" data-fslightbox="gallery" class="flex items-center justify-center w-[60px] aspect-square bg-white rounded-full text-edyellow absolute top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] before:border before:absolute before:top-[50%] before:-translate-y-[50%] before:left-[50%] before:-translate-x-[50%] before:w-[calc(100%+15px)] before:h-[calc(100%+15px)] before:rounded-full before:transition before:duration-[400ms] hover:bg-edpurple hover:text-white hover:before:border-edpurple"><i class="fa-solid fa-play"></i></a>
                        </div>

                        <!-- vectors -->
                        <div>
                            <img src="{{ asset('public/frontend/assets/img/about-2-img-vector.svg') }}" alt="vector" class="absolute pointer-events-none top-[60px] right-[65px] -z-[1]">
                            <img src="{{ asset('public/frontend/assets/img/about-2-img-vector-2.svg') }}" alt="vector" class="absolute pointer-events-none -bottom-[30px] right-0 -z-[1] md:hidden">
                        </div>
                    </div>
                </div>

                <!-- right -->
                <div class="max-w-[54%] md:max-w-full">
                    <h6 class="ed-section-sub-title">Qui sommes-nous?</h6>
                    <h2 class="ed-section-title mb-[6px]"><span class="inline-block font-bold relative before:absolute before:left-0 before:top-[calc(100%-6px)] before:w-[137px] before:h-[14px] before:bg-[url('../assets/img/banner-2-title-vector.svg')] before:bg-[length:100%_100%]">Alerte Foncier</span></h2>
                    <p class="text-edgray mb-[34px]">Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis sapien the.</p>
                    <ul class="ed-about-list font-medium text-[18px] text-edblue grid grid-cols-2 xxs:grid-cols-1 gap-[20px] xxs:gap-[15px] mb-[52px] *:pl-[40px] *:relative *:before:absolute *:before:left-0 *:before:-top-[3px] *:before:w-[30px] *:before:aspect-square *:before:border *:before:border-edpurple *:before:rounded-full *:before:bg-[url(../assets/img/icon/checkmark.svg)] *:before:bg-no-repeat *:before:bg-[length:15px_13px] *:before:bg-center">
                        <li>Une équipe expérimentée</li>
                        <li>Une approche personnalisée</li>
                        <li>Un accompagnement global</li>
                        <li>Lifetime Access</li>
                    </ul>
                    <a href="#" class="ed-btn">En savoir plus</a>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ABOUT SECTION END -->

    <!-- TESTIMONIAL SECTION START -->
    <section class="ed-2-about bg-edoffwhite py-[120px] xl:py-[80px] md:py-[60px] relative z-[1] before:absolute before:inset-0 before:-z-[1] before:bg-[url('../assets/img/about-us-bg.png')] before:opacity-[5%] before:bg-no-repeat before:bg-cover before:bg-center before:mix-blend-multiply">
        <div class="mx-[19.7%] xxxl:mx-[14.7%] xxl:mx-[9.7%] xl:mx-[3.2%] md:mx-[15px]">
            <div class="flex md:flex-col gap-[30px]">
                <!-- heading -->
                <div class="max-w-[370px] md:max-w-full shrink-0">
                    <h6 class="ed-section-sub-title">Temoignages</h6>
                    <h2 class="ed-section-title mb-[36px] md:mb-[26px]">Ce que disent nos clients</h2>
                    <!-- slider nav -->
                    <div class="ed-2-testimonial-slider-nav flex gap-[15px] *:w-[40px] *:h-[40px] *:rounded-full *:border *:border-[#808080]/20 *:text-edpurple *:text-[18px]">
                        <button class="prev hover:bg-edpurple hover:border-edpubg-edpurple hover:text-white"><i class="fa-solid fa-angle-left"></i></button>
                        <button class="next hover:bg-edpurple hover:border-edpubg-edpurple hover:text-white"><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>

                <!-- slider container -->
                <div>
                    <div class="ed-2-testimonial-slider swiper max-w-[1200px]">
                        <div class="swiper-wrapper">
                            <!-- single testimony -->
                            <div class="swiper-slide w-[570px] lg:w-[540px] xs:w-full">
                                <div class="et-testimony bg-white p-[30px] xxs:p-[20px] border border-[#d9d9d9] rounded-[20px]">
                                    <!-- single testimony heading -->
                                    <div class="et-testimony__heading flex xxs:flex-col items-center gap-[22px] mb-[42px] xxs:mb-[22px]">
                                        <img src="{{ asset('public/frontend/assets/img/user-2.png') }}" alt="reviewer image" class="w-[70px] aspect-square rounded-full shrink-0">

                                        <div class="flex items-center justify-between grow xxs:w-full">
                                            <div class="left">
                                                <h5 class="text-edblue font-semibold text-[20px] mb-[1px]">M. TRAORE</h5>
                                                <h6 class="text-[16px] text-edpurple font-normal">Investisseur chez Indépendant</h6>
                                            </div>

                                            <div class="right">
                                                <img src="{{ asset('public/frontend/assets/img/icon/quotation.svg') }}" alt="quotation mark">
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-[#445375] font-normal mb-[21px]">Grâce au guide d'investissement et aux conseils d'Alerte Foncier, j'ai pu sécuriser mon premier achat sans aucun problème. Un service de qualité !</p>

                                    <!-- rating stars -->
                                    <div class="inline-flex items-center gap-[6px] border border-edyellow rounded-full px-[10px] h-[40px]">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                    </div>
                                </div>
                            </div>

                            <!-- single testimony -->
                            <div class="swiper-slide w-[570px] lg:w-[540px] xs:w-full">
                                <div class="et-testimony bg-white p-[30px] xxs:p-[20px] border border-[#d9d9d9] rounded-[20px]">
                                    <!-- single testimony heading -->
                                    <div class="et-testimony__heading flex xxs:flex-col items-center gap-[22px] mb-[42px] xxs:mb-[22px]">
                                        <img src="{{ asset('public/frontend/assets/img/user-2.png') }}" alt="reviewer image" class="w-[70px] aspect-square rounded-full shrink-0">

                                        <div class="flex items-center justify-between grow xxs:w-full">
                                            <div class="left">
                                                <h5 class="text-edblue font-semibold text-[20px] mb-[1px]">Esther Howard</h5>
                                                <h6 class="text-[16px] text-edpurple font-normal">Nursing Assistant</h6>
                                            </div>

                                            <div class="right">
                                                <img src="{{ asset('public/frontend/assets/img/icon/quotation.svg') }}" alt="quotation mark">
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-[#445375] font-normal mb-[21px]">Donec ac lacus placerata dolor duis consequat placerat sit amet a elit. In volutpat, lacus in egestas finibus nisi orci tincidunt risus, a dapibus </p>

                                    <!-- rating stars -->
                                    <div class="inline-flex items-center gap-[6px] border border-edyellow rounded-full px-[10px] h-[40px]">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                    </div>
                                </div>
                            </div>

                            <!-- single testimony -->
                            <div class="swiper-slide w-[570px] lg:w-[540px] xs:w-full">
                                <div class="et-testimony bg-white p-[30px] xxs:p-[20px] border border-[#d9d9d9] rounded-[20px]">
                                    <!-- single testimony heading -->
                                    <div class="et-testimony__heading flex xxs:flex-col items-center gap-[22px] mb-[42px] xxs:mb-[22px]">
                                        <img src="{{ asset('public/frontend/assets/img/user-2.png') }}" alt="reviewer image" class="w-[70px] aspect-square rounded-full shrink-0">

                                        <div class="flex items-center justify-between grow xxs:w-full">
                                            <div class="left">
                                                <h5 class="text-edblue font-semibold text-[20px] mb-[1px]">Esther Howard</h5>
                                                <h6 class="text-[16px] text-edpurple font-normal">Nursing Assistant</h6>
                                            </div>

                                            <div class="right">
                                                <img src="{{ asset('public/frontend/assets/img/icon/quotation.svg') }}" alt="quotation mark">
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-[#445375] font-normal mb-[21px]">Donec ac lacus placerata dolor duis consequat placerat sit amet a elit. In volutpat, lacus in egestas finibus nisi orci tincidunt risus, a dapibus </p>

                                    <!-- rating stars -->
                                    <div class="inline-flex items-center gap-[6px] border border-edyellow rounded-full px-[10px] h-[40px]">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                        <img src="{{ asset('public/frontend/assets/img/icon/star.svg') }}" alt="star">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <img src="{{ asset('public/frontend/assets/img/testimonial-2-vector.svg') }}" alt="vector" class="absolute -z-[1] pointer-events-none left-[44px] bottom-[60px]">
    </section>
    <!-- TESTIMONIAL SECTION END -->

    {{-- RSSOURCES --}}
    <section class="py-[50px] xl:py-[80px] md:py-[60px]  bg-top bg-no-repeat">
        <div class="mx-[19.71%] xxxl:mx-[14.71%] xxl:mx-[9.71%] xl:mx-[5.71%] md:mx-[12px]">
            <!-- section heading -->
            <div class="text-center mb-[46px] lg:mb-[36px] xxs:mb-[26px]">
                {{-- <h6 class="ed-section-sub-title">academic classes</h6> --}}
                <h2 class="ed-section-title">Ressources & Actualités</h2>
            </div>

            <!-- cards -->
            <div class="grid grid-cols-3 md:grid-cols-2 xs:grid-cols-1 xs:max-w-[80%] xxs:max-w-full mx-auto gap-[30px] lg:gap-[20px]">
                <!-- single class card -->
                <div class="bg-[url('../assets/img/class-bg.png')] bg-no-repeat bg-center bg-[length:100%_100%] p-[25px] sm:p-[20px]">
                    <div class="mb-[22px]">
                        <img src="{{ asset('public/frontend/assets/img/program-2.jpg') }}" alt="class image" class="aspect-[161/108] object-cover w-full">
                    </div>
                    <!-- txt -->
                    <div>
                        <h5 class="font-semibold text-[20px] text-edblue mb-[8px]"><a href="#" class="hover:text-edpurple">Blog : Tendances du marché</a></h5>
                        <p class="text-edgray mb-[15px]">Analyses pointues sur les évolutions du secteur immobilier en Afrique de l'Ouest.</p>
                        <!-- infos -->
                        <a href="event-details.html" class="font-medium text-edpurple inline-flex items-center gap-[8px] hover:text-edblue">Lire nos articles <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                    </div>
                </div>
                <!-- single class card -->
                <div class="bg-[url('../assets/img/class-bg.png')] bg-no-repeat bg-center bg-[length:100%_100%] p-[25px] sm:p-[20px]">
                    <div class="mb-[22px]">
                        <img src="{{ asset('public/frontend/assets/img/program-3.jpg') }}" alt="class image" class="aspect-[161/108] object-cover w-full">
                    </div>
                    <!-- txt -->
                    <div>
                        <h5 class="font-semibold text-[20px] text-edblue mb-[8px]"><a href="#" class="hover:text-edpurple">Études de Cas : Nos succès</a></h5>
                        <p class="text-edgray mb-[15px]">Découvrez comment nos clients optimisent leurs opérations avec nos solutions.</p>
                        <!-- infos -->
                        <a href="event-details.html" class="font-medium text-edpurple inline-flex items-center gap-[8px] hover:text-edblue">Découvrir les études <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                    </div>
                </div>
                <!-- single class card -->
                <div class="bg-[url('../assets/img/class-bg.png')] bg-no-repeat bg-center bg-[length:100%_100%] p-[25px] sm:p-[20px]">
                    <div class="mb-[22px]">
                        <img src="{{ asset('public/frontend/assets/img/blog-1.png') }}" alt="class image" class="aspect-[161/108] object-cover w-full">
                    </div>
                    <!-- txt -->
                    <div>
                        <h5 class="font-semibold text-[20px] text-edblue mb-[8px]"><a href="#" class="hover:text-edpurple">Rapports gratuits</a></h5>
                        <p class="text-edgray mb-[15px]">Téléchargez nos guides et rapports d'experts sur les investissements fonciers.</p>
                        <!-- infos -->
                        <a href="event-details.html" class="font-medium text-edpurple inline-flex items-center gap-[8px] hover:text-edblue">Télécharger <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a href="https://wa.me/22501020304" target="_blank" class="float" title="Contactez-nous via WhatsApp">
        <i class="fa-brands fa-whatsapp fa-2x"></i>
    </a>

@endsection