<div class="ed-cart-bar group" id="cartBar">
  <div class="w-[420px] max-w-full fixed z-[100] right-0 top-0 h-full bg-white flex flex-col translate-x-[100%] duration-[400ms] group-[.active]:translate-x-0">

    <!-- heading -->
    <div class="flex items-center justify-between px-[25px] border-b border-edgray/20 pb-[23px] pt-[22px]">
      <h5 class="text-[20px] fw-bold">Mon panier</h5>
      <h6>(<span id="cart-count" class="fw-bold">0</span>)</h6>
      <h6><span id="close" class="fw-bold cursor-pointer" onclick="closeCart()">X</span></h6>
    </div>

    <!-- cart items -->
    <div id="cart-items" class="overflow-y-auto">
      <div class="py-[30px] px-[25px] text-edgray">Panier vide</div>
    </div>

    <!-- cart bottom -->
    <div class="mt-auto px-[25px] mb-[30px]">
      <div class="flex items-center justify-between font-medium text-[18px] text-edblue mb-[33px] fw-bold">
        <span>Total</span>
        <span id="cart-total">0 FCFA</span>
      </div>

      <div class="space-y-[15px]">
        <a href="{{ route('panier') }}" 
           class="ed-btn w-full !rounded-[10px] color:!text-white"
           style="background-color: #af2c05 !important">
          Voir le panier
        </a>

        <form action="{{ route('passer_commande') }}" method="POST">
            @csrf
            <button class="ed-btn w-full !h-[56px] !rounded-[8px] hover:!text-white" id="passer_commande"
                style="background-color:#1a474a; border-color:#1a474a">
                Procéder au paiement
            </button>
        </form>

      </div>
    </div>

  </div>
</div>