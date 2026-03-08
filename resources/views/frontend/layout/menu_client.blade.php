<div class="bg-edoffwhite rounded-[10px] p-[30px] xxs:px-[20px] pt-[20px] xxs:pt-[10px]">
    <h4 class="font-semibold text-[18px] text-black border-b border-[#dddddd] relative pb-[11px] before:content-normal before:absolute before:left-0 before:bottom-0 before:w-[50px] before:h-[2px] before:bg-edpurple">
        TABLEAU DE BORD
    </h4>

    
    <ul class="mt-[30px] text-[16px]">
        <li class="text-black py-[16px] border-b border-t border-[#D9D9D9]">
            <a href="{{ route('panier') }}" class="flex items-center justify-between hover:text-edpurple">
                <span class="{{ ($menu=='panier') ? 'fw-bold':'' }}">Panier</span>
                <span class="{{ ($menu=='panier') ? 'fw-bold':'' }}" id="cart-badge-count2">{{ collect(session('cart', []))->sum('qty') }}</span>
            </a>
        </li>
        @if(Auth::guard('customer')->check())
            <li class="text-black py-[16px] border-b border-[#D9D9D9]">
                <a href="{{ route('checkout.commande') }}" class="flex items-center justify-between hover:text-edpurple">
                    <span class="{{ ($menu=='commande') ? 'fw-bold':'' }}">Commandes</span>
                    <span class="{{ ($menu=='commande') ? 'fw-bold':'' }}">{{ $nb_commande }}</span>
                </a>
            </li>
            <li class="text-black py-[16px] border-b border-[#D9D9D9]">
                <a href="{{ route('profil') }}" class="flex items-center justify-between hover:text-edpurple">
                    <span class="{{ ($menu=='profil') ? 'fw-bold':'' }}">Profil</span>
                </a>
            </li>
        @endif 
    </ul>
</div>