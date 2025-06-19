<div class="cart-box">
    @php
        $cart = session('cart', []);
        $products = \App\Models\Product::whereIn('products_id', array_keys($cart))->get()->keyBy('products_id');
        $subtotal = 0;
        $cartCount = 0;
    @endphp
    <h5>ตะกร้าสินค้า</h5>
    <div class="cart-box-scroll">
        @forelse($cart as $pid => $qty)
            @php
                $p = $products[$pid] ?? null;
                if (!$p) continue;
                $price = $p->products_price_promotion ?: $p->products_price_full;
                $price_full = $p->products_price_full;
                $price_total = $price * $qty;
                $subtotal += $price_total;
                $cartCount += $qty;
                $productTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $p->products_code);
                $urlProduct = $p->products_url ? $p->products_url : $productTopic;
            @endphp
            <figure class="cart-item" data-id="{{ $pid }}">
                <a href="{{ url('product/detail/'.$p->products_id.'/'.$urlProduct) }}" class="cart-img">
                    {{-- <img src="{{ asset($p->products_image) }}" alt=""> --}}
                    <img src="{{ $p->image_url }}" alt="">
                </a>
                <figcaption>
                    <a href="{{ url('product/detail/'.$p->products_id.'/'.$urlProduct) }}">
                        <h3>{{ $p->products_name }}</h3>
                        <p>รหัสสินค้า {{ $p->products_code }}</p>
                    </a>
                    <div class="cart-qty">
                        <div class="cart-item-quantity-box">
                            <button class="cart-item-quantity-btn qty-btn cart-qty-minus" data-id="{{ $pid }}">-</button>
                            <input type="text" class="cart-item-quantity-input qty-input" value="{{ $qty }}" data-id="{{ $pid }}" readonly>
                            <button class="cart-item-quantity-btn qty-btn qty-plus cart-qty-plus" data-id="{{ $pid }}">+</button>
                        </div>
                        <div class="product-price {{ $p->products_price_promotion ? 'product-price-sale' : '' }}">
                            @if($p->products_price_promotion)
                                <span>฿ {{ number_format($price_full) }}</span>
                                <div>฿ {{ number_format($price) }}</div>
                            @else
                                <div>฿ {{ number_format($price) }}</div>
                            @endif
                        </div>
                    </div>
                    <button class="cart-del" data-id="{{ $pid }}"></button>
                </figcaption>
            </figure>
        @empty
            <div class="text-center py-4">ยังไม่มีสินค้าในตะกร้า</div>
        @endforelse
    </div>
    <div class="cart-price-box">
        <div class="cart-price-box-subtotal">
            <h6>Subtotal</h6>
            <div class="cart-price-box-subtotal-number">฿ {{ number_format($subtotal) }}</div>
            {{-- <p>ระบบจะคำนวณค่าจัดส่งในขั้นตอนการชำระเงิน</p> --}}
        </div>
        <div class="cart-price-box-total">
            <h6>Total</h6>
            <div class="cart-price-box-total-number">฿ {{ number_format($subtotal) }}</div>
        </div>
        {{-- <a href="{{ route('checkout') }}" class="cart-submit-button">
            <img src="{{ asset('images/icon-cart.svg') }}" alt="">สั่งซื้อสินค้า ({{ $cartCount }})
        </a> --}}
        <a href="{{ route('checkout') }}" class="cart-submit-button {{ $cartCount == 0 ? 'disabled' : '' }}"
            @if($cartCount == 0) onclick="return false;" @endif>
            <img src="{{ asset('images/icon-cart.svg') }}" alt="">สั่งซื้อสินค้า ({{ $cartCount }})
        </a>

    </div>
</div>
