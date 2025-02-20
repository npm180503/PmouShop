<div>
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">Giỏ hàng của bạn</span>
                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full" id="cart-items">
                    @if(!empty($cartItems))
                        @foreach($cartItems as $item)
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img">
                                    <img src="{{ $item->product->thumb }}" alt="IMG">
                                </div>
                                <div class="header-cart-item-txt p-t-8">
                                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        {{ $item->product->name }}
                                        ( {{ $item->getSize()->name }} )
                                    </a>
                                    <span class="header-cart-item-info">
                                        {{ $item->quantity }} x {{ $item->product->price }}VND
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-txt p-t-8">
                                <span class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    Giỏ hàng trống.
                                </span>
                            </div>
                        </li>
                    @endif
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Total: $<span id="cart-total">{{ session('cart_total', 0) }}</span>
                    </div>

                    <a href="{{ route('cart.view') }}" 
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
