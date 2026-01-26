<header class="absolute z-[99] top-0 inset-x-[100px] xxl:inset-x-[30px] xl:inset-x-0 bg-white rounded-bl-[10px] rounded-br-[10px]">
    <!-- top header -->
    <div class="bg-edblue flex items-center justify-between lg:justify-center lg:gap-x-[20px]">
        <!-- contacts -->
        <div class="flex items-center gap-x-[32px] xl:gap-x-[15px] gap-y-[6px] py-[18px] pl-[30px] xl:pl-[10px] lg:pl-0 lg:order-2 sm:pt-0 sm:pb-[10px] xl:hidden">
            <!-- single contact -->
            <a href="mailto:info@example.com" class="flex items-center gap-x-[10px] font-light text-white/80">
                <span class="icon shrink-0 xl:hidden">
                    <img src="{{ asset('public/frontend/assets/img/icon/mail.svg') }}" alt="icon">
                </span>
                <span>info@alertefoncier.ci</span>
            </a>
            <!-- single contact -->
            <a href="tel:+20866660112" class="flex items-center gap-x-[10px] font-light text-white/80">
                <span class="icon shrink-0 xl:hidden">
                    <img src="{{ asset('public/frontend/assets/img/icon/phone.svg') }}" alt="icon">
                </span>
                <span>(+225) 27 22 43 51 88 - 07 08 53 11 11 - 01 51 87 45 45</span>
            </a>
        </div>

        <!-- notice -->
        <p class="font-medium text-white text-[16px] xxs:text-[14px] xl:pl-[15px] lg:order-1 lg:w-full lg:my-[10px] text-center lg:text-left sm:text-center" style="padding-right:20px"> 
            {{-- <span class="text-edyellow">Cité SYNATRESOR</span> en face de la Pharmacie Jules Verne --}}
            <span class="inline-flex gap-[16px] text-[#d9d9d9]" style="padding-right:20px">
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-youtube"></i></a>
            </span>
        </p>

        <!-- actions -->
        {{-- <div class="shrink-0 flex items-center gap-x-[30px] xl:gap-x-[15px] text-white lg:order-3 sm:hidden">
            <span class="inline-flex gap-[16px] text-[#d9d9d9]" style="padding-right:20px">
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" class="hover:text-edyellow"><i class="fa-brands fa-youtube"></i></a>
            </span>
        </div> --}}
    </div>

    <!-- bottom header -->
    <div class="px-[30px] xxl:px-[15px] lg:px-[20px] py-[15px] lg:py-[18px] flex justify-between to-be-fixed">
        <div class="logo xxs:max-w-[30%]"><a href="index.html"><img src="{{ asset('public/frontend/assets/img/logo_alertf.png') }}" alt="logo" class="logo"></a></div>

        <div class="flex lg:items-center lg:gap-[70px] xxs:gap-[30px]">
            <div class="flex items-center gap-[100px] xl:gap-[30px] lg:gap-y-0">
                
                <!-- nav -->
                @include('frontend.layout.menu')

                <!-- right actions -->
                <div class="flex items-center gap-x-[30px] xxs:gap-[30px]">
                    {{-- <button class="ed-search-opener-btn group">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M15.962 15.9063L12.0216 12.0025C13.0011 10.8356 13.5911 9.33716 13.5911 7.70448C13.5911 3.992 10.5427 0.97168 6.79561 0.97168C3.04849 0.97168 0 3.992 0 7.70448C0 11.4167 3.04849 14.4368 6.79561 14.4368C8.44348 14.4368 9.95601 13.8523 11.1338 12.8819L15.0743 16.7858C15.1968 16.9072 15.3575 16.9679 15.5181 16.9679C15.6788 16.9679 15.8395 16.9072 15.9621 16.7858C16.2072 16.5429 16.2072 16.1491 15.962 15.9063ZM1.25549 7.70448C1.25549 4.67786 3.74076 2.21553 6.79561 2.21553C9.85038 2.21553 12.3356 4.67786 12.3356 7.70448C12.3356 10.7309 9.85038 13.1929 6.79561 13.1929C3.74076 13.1929 1.25549 10.7309 1.25549 7.70448Z" class="fill-edblue group-hover:fill-edpurple" />
                            </g>
                        </svg>
                    </button> --}}
                    {{-- <button class="ed-cart-opener-btn group">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M12.9894 13.6354H6.93871C6.06616 13.6354 5.2925 13.0682 5.05637 12.2557L3.01122 5.38995C2.93856 5.14134 2.69705 4.97072 2.42122 4.97072H0.818742C0.446713 4.97072 0.145996 4.67212 0.145996 4.30421C0.145996 3.93629 0.446713 3.6377 0.818742 3.6377H2.42122C3.29377 3.6377 4.06676 4.2049 4.30289 5.01737L4.68568 6.30374H14.9753C15.3951 6.30374 15.7934 6.50169 16.0403 6.83361C16.2852 7.16287 16.3558 7.57477 16.234 7.96402L14.8462 12.3283C14.5744 13.1161 13.8296 13.6354 12.9894 13.6354Z" class="fill-edblue group-hover:fill-edpurple" />
                                <path d="M7.54617 16.9687C6.80414 16.9687 6.20068 16.3707 6.20068 15.6353C6.20068 14.9 6.80414 14.302 7.54617 14.302C8.28821 14.302 8.89167 14.9 8.89167 15.6353C8.89167 16.3707 8.28821 16.9687 7.54617 16.9687Z" class="fill-edblue group-hover:fill-edpurple" />
                                <path d="M12.2556 16.9687C11.5136 16.9687 10.9102 16.3707 10.9102 15.6353C10.9102 14.9 11.5136 14.302 12.2556 14.302C12.9977 14.302 13.6011 14.9 13.6011 15.6353C13.6011 16.3707 12.9977 16.9687 12.2556 16.9687Z" class="fill-edblue group-hover:fill-edpurple" />
                            </g>
                        </svg>
                    </button> --}}
                    {{-- <button class="relative w-12 h-12 flex items-center justify-center rounded-full bg-gray-200">
                        <!-- Icône -->
                        <svg class="w-7 h-7 text-black"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4h-2l-1 2h2l3.6 7.59-1.35 2.44a2 2 0 002 3h12v-2h-12l1.1-2h7.45a2 2 0 001.8-1.1l3.58-6.49a1 1 0 00-.87-1.46h-14.3l-.94-2z"/>
                            <circle cx="10.5" cy="20.5" r="1.5"/>
                            <circle cx="17.5" cy="20.5" r="1.5"/>
                        </svg>

                        <!-- Badge -->
                        <span class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center
                                    text-xs font-bold text-white bg-red-600 rounded-full">
                            3
                        </span>
                    </button> --}}
                    <button class="ed-cart-opener-btn" title="Panier">
                        <!-- Icône panier -->
                        <svg class="ed-cart-icon"
                            viewBox="0 0 17 17"
                            xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M12.9894 13.6354H6.93871C6.06616 13.6354 5.2925 13.0682 5.05637 12.2557L3.01122 5.38995C2.93856 5.14134 2.69705 4.97072 2.42122 4.97072H0.818742C0.446713 4.97072 0.145996 4.67212 0.145996 4.30421C0.145996 3.93629 0.446713 3.6377 0.818742 3.6377H2.42122C3.29377 3.6377 4.06676 4.2049 4.30289 5.01737L4.68568 6.30374H14.9753C15.3951 6.30374 15.7934 6.50169 16.0403 6.83361C16.2852 7.16287 16.3558 7.57477 16.234 7.96402L14.8462 12.3283C14.5744 13.1161 13.8296 13.6354 12.9894 13.6354Z"/>
                                <path d="M7.54617 16.9687C6.80414 16.9687 6.20068 16.3707 6.20068 15.6353C6.20068 14.9 6.80414 14.302 7.54617 14.302C8.28821 14.302 8.89167 14.9 8.89167 15.6353C8.89167 16.3707 8.28821 16.9687 7.54617 16.9687Z"/>
                                <path d="M12.2556 16.9687C11.5136 16.9687 10.9102 16.3707 10.9102 15.6353C10.9102 14.9 11.5136 14.302 12.2556 14.302C12.9977 14.302 13.6011 14.9 13.6011 15.6353C13.6011 16.3707 12.9977 16.9687 12.2556 16.9687Z"/>
                            </g>
                        </svg>

                        <!-- Badge notification -->
                        <span class="ed-cart-badge">3</span>
                    </button>



                </div>
            </div>

            <!-- mobile menu button -->
            <button type="button" class="ed-mobile-menu-open-btn hidden lg:inline-block text-edblue text-[18px]"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</header>