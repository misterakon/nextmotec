<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.head')
</head>

<body>
    <div class="ed-overlay group">
        <div class="fixed inset-0 z-[100] group-[.active]:bg-edblue/80 duration-[400ms] pointer-events-none group-[.active]:pointer-events-auto"></div>
    </div>

    <!-- cart -->
    @include('frontend.layout.cart')

    <!-- search -->
    <div class="ed-search group">
        <form action="#" class="bg-white fixed z-[100] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] h-[100px] md:h-[70px] xxs:h-[50px] w-[1224px] max-w-[95%] flex gap-[10px] rounded-full overflow-hidden px-[40px] xxs:px-[20px] pointer-events-none opacity-0 group-[.active]:pointer-events-auto group-[.active]:opacity-100 duration-[400ms]">
            <input type="search" name="ed-search" placeholder="Recherche..." class="bg-transparent w-full focus:outline-none">
            <button class="text-[25px] md:text-[22px] xxs:text-[20px]"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <!-- sidebar -->
    <div class="ed-sidebar">
        <div class="translate-x-[100%] transition-transform ease-linear duration-300 fixed right-0 w-full max-w-[25%] xl:max-w-[30%] lg:max-w-[40%] md:max-w-[50%] sm:max-w-[60%] xxs:max-w-full bg-white h-full z-[100] overflow-auto">
            <!-- heading -->
            <div class="ed-sidebar-heading p-[20px] lg:p-[20px] border-b border-edgray/20">
                <div class="logo flex justify-between items-center">
                    <a href="index.html"><img src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo"></a>

                    <button type="button" class="ed-sidebar-close-btn border border-edgray/20 w-[45px] aspect-square shrink-0 text-black text-[22px] rounded-full hover:text-edpurple"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <!-- mobile menu -->
            <div class="ed-header-nav-in-mobile"></div>
        </div>
    </div>

    <!-- HEADER SECTION START -->
    <header>
        @include('frontend.layout.header')
    </header>
    <!-- HEADER SECTION END -->

    <main>
        @yield('main-content')
    </main>

    @include('frontend.layout.footer')
</body>

</html>