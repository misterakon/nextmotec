<div class="ed-cart-bar group" id="cartBar">
  <div class="w-[420px] max-w-full fixed z-[100] right-0 top-0 h-full bg-white flex flex-col translate-x-[100%] duration-[400ms] group-[.active]:translate-x-0">

    <!-- heading -->
    <div class="flex items-center justify-between px-[25px] border-b border-edgray/20 pb-[23px] pt-[22px]">
      <h5 class="text-[20px]">Mon panier</h5>
      <h6>(<span id="cart-count">0</span> items)</h6>
    </div>

    <!-- cart items -->
    <div id="cart-items" class="overflow-y-auto">
      <div class="py-[30px] px-[25px] text-edgray">Panier vide</div>
    </div>

    <!-- cart bottom -->
    <div class="mt-auto px-[25px] mb-[30px]">
      <div class="flex items-center justify-between font-medium text-[18px] text-edblue mb-[33px]">
        <span>Total</span>
        <span id="cart-total">0 FCFA</span>
      </div>

      <div class="space-y-[15px]">
        <a href="#" {{-- route('checkout.index')--}}
           class="ed-btn w-full !rounded-[10px] !bg-transparent border border-edblue !text-edblue hover:!bg-edblue hover:!text-white">
          Voir le panier
        </a>

        <a href="#" {{-- route('checkout.index')--}}
           class="ed-btn w-full !rounded-[10px]">
          Procéder au paiement
        </a>
      </div>
    </div>

  </div>
</div>
