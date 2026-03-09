@php
    $labels = [
        'logiciels' => 'LOGICIELS',
        'services & templates' => 'TEMPLATES',
        'formations & documentation' => 'FORMATION',
    ];
@endphp

<div class="ed-header-nav-container">
    <ul class="to-go-to-sidebar-in-mobile ed-header-nav flex lg:flex-col gap-x-[43px] xl:gap-x-[33px] font-kanit text-[17px] font-normal">
        @foreach($categories as $category)
            @php
                $key = strtolower(trim($category->name));
                $label = $labels[$key] ?? strtoupper($category->name);
            @endphp

            <li>
                <a href="#{{ $category->slug }}">
                    <b>{{ $label }}</b>
                </a>
            </li>
        @endforeach
        <li><a href="#temoignages"><b>TEMOIGNAGES</b></a></li>
        {{-- <li><a href="{{route('login')}}"><b>SE CONNECTER</b></a></li> --}}
        
        {{-- <li class="has-sub-menu relative">
            <a role="button">Accueil</a>
            <ul class="ed-header-submenu">
                <li><a href="index.html">Home</a></li>
                <li><a href="index-2.html">Home 02</a></li>
            </ul>
        </li> --}}
        
    </ul>
</div>