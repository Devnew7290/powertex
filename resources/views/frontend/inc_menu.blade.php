<?php
    use App\Models\News;
    $aboutUs = News::where('news_type', 'aboutUs')->first();
    $textHeader = App\Models\TextHaeder::where('texth_status', 'show')->first();
    $contact = App\Models\Contact::first();
    // dd($textHeader);
?>
<header class="header-bg">
    
    @if(!empty($textHeader) && !empty($textHeader->texth_text))
    <div class="header-promotion">
        <a @if($textHeader->texth_link) href="{{$textHeader->texth_link}}" target="_blank" @else href="#" @endif>
            @php
                $html = $textHeader->texth_text;

                // จับเฉพาะข้อความใน <p>...</p>
                preg_match_all('/<p[^>]*>(.*?)<\/p>/i', $html, $matches);

                if (count($matches[0]) === 1) {
                    // มี <p> เดียว → เอาแท็กออก
                    $cleanText = strip_tags($matches[0][0]);
                } elseif (count($matches[0]) > 1) {
                    // มีหลาย <p> → รวมด้วย <br>
                    $cleanText = implode('<br>', array_map('strip_tags', $matches[0]));
                } else {
                    // ไม่มี <p> → ไม่ต้องเปลี่ยนอะไร
                    $cleanText = $html;
                }
            @endphp

            {!! $cleanText !!}
        </a>
    </div>
    @endif
    
    <!-- <div class="header-promotion">
        <a href="#">
            ส่งฟรีเมื่อชื้อครบ 699.- / ลดทันที 80.- เมื่อซื้อครบ 999.-
        </a>
    </div> -->
    <nav class="header-menu">
        <div class="header-left">
            <div class="header-menu-btn">
                <div class="header-menu-btn-icon">
                    <span></span><span></span><span></span><span></span>
                </div>
                <div class="header-menu-btn-text">เมนู</div>
            </div>
            <a href="#" class="header-link hassub-product">สินค้า</a>
            <a href="{{ url('warranty') }}" class="header-link header-link-hide-mb">ลงทะเบียนรับประกันออนไลน์</a>
        </div>
        <a href="{{ url('/') }}" class="header-logo">
            {{-- logo เก่า --}}
            {{-- <img src="{{asset('images/powertex-logo.png')}}" alt=""> --}}
            <img src="{{asset('images/new-powertex-logo.jpg')}}" alt="">
        </a>
        <div class="header-right">
            <button class="header-search">
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.88771 0C3.53997 0 0 3.53593 0 7.88401C0 12.2321 3.53759 15.768 7.88771 15.768C9.71234 15.768 11.3873 15.1411 12.7249 14.0986L12.6892 14.1342L17.2532 18.696C17.4551 18.8979 17.7165 19 17.9778 19C18.2391 19 18.5029 18.8979 18.7024 18.696C19.0992 18.2995 19.0992 17.6464 18.7024 17.2498L14.1385 12.6857L14.1052 12.7189C15.1482 11.382 15.7754 9.70541 15.7754 7.88401C15.7778 3.53593 12.2378 0 7.88771 0ZM7.88771 13.7187C4.66848 13.7187 2.05033 11.1017 2.05033 7.88401C2.05033 4.66629 4.66848 2.04937 7.88771 2.04937C11.1069 2.04937 13.7251 4.66629 13.7251 7.88401C13.7275 11.1017 11.1069 13.7187 7.88771 13.7187Z" fill="black"/>
                </svg>
            </button>
            @php
                use Illuminate\Support\Facades\Auth;

                $member = Auth::guard('member')->user();
            @endphp

            @if($member)
            <a href="{{ route('member.address') }}" class="header-login">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.0555 12.1804C15.995 11.4412 16.6808 10.4275 17.0174 9.28044C17.354 8.13334 17.3247 6.90984 16.9336 5.78016C16.5425 4.65048 15.809 3.67079 14.8351 2.9774C13.8613 2.28401 12.6955 1.9114 11.5001 1.9114C10.3046 1.9114 9.13883 2.28401 8.16499 2.9774C7.19115 3.67079 6.45764 4.65048 6.06651 5.78016C5.67538 6.90984 5.64609 8.13334 5.9827 9.28044C6.31932 10.4275 7.0051 11.4412 7.94464 12.1804C6.33472 12.8254 4.93 13.8952 3.88025 15.2758C2.83049 16.6563 2.17506 18.2958 1.98381 20.0196C1.96996 20.1454 1.98104 20.2728 2.01642 20.3943C2.05179 20.5159 2.11076 20.6293 2.18996 20.7281C2.34991 20.9276 2.58256 21.0554 2.83672 21.0833C3.09089 21.1113 3.34575 21.0371 3.54524 20.8772C3.74474 20.7172 3.87252 20.4846 3.90047 20.2304C4.11091 18.3571 5.00417 16.6269 6.4096 15.3705C7.81503 14.1141 9.63409 13.4196 11.5192 13.4196C13.4044 13.4196 15.2234 14.1141 16.6288 15.3705C18.0343 16.6269 18.9275 18.3571 19.138 20.2304C19.164 20.4659 19.2764 20.6834 19.4534 20.8409C19.6303 20.9984 19.8594 21.0848 20.0963 21.0833H20.2017C20.4529 21.0544 20.6825 20.9274 20.8405 20.7299C20.9985 20.5325 21.072 20.2806 21.0451 20.0292C20.8529 18.3005 20.1939 16.6568 19.1388 15.2741C18.0836 13.8914 16.6721 12.822 15.0555 12.1804ZM11.5001 11.5C10.7419 11.5 10.0008 11.2752 9.37037 10.854C8.73998 10.4328 8.24865 9.83407 7.95852 9.13362C7.66838 8.43317 7.59247 7.66241 7.74038 6.91882C7.88829 6.17523 8.25338 5.49219 8.78948 4.95609C9.32558 4.41999 10.0086 4.0549 10.7522 3.90699C11.4958 3.75908 12.2666 3.83499 12.967 4.12513C13.6675 4.41526 14.2661 4.90659 14.6874 5.53698C15.1086 6.16737 15.3334 6.9085 15.3334 7.66667C15.3334 8.68333 14.9295 9.65835 14.2106 10.3772C13.4917 11.0961 12.5167 11.5 11.5001 11.5Z" fill="black"/>
                </svg>
                <span>{{ $member->name }} {{ $member->surname }}</span>
            </a>
            @else
            <a href="{{ route('member.login') }}" class="header-login">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.0555 12.1804C15.995 11.4412 16.6808 10.4275 17.0174 9.28044C17.354 8.13334 17.3247 6.90984 16.9336 5.78016C16.5425 4.65048 15.809 3.67079 14.8351 2.9774C13.8613 2.28401 12.6955 1.9114 11.5001 1.9114C10.3046 1.9114 9.13883 2.28401 8.16499 2.9774C7.19115 3.67079 6.45764 4.65048 6.06651 5.78016C5.67538 6.90984 5.64609 8.13334 5.9827 9.28044C6.31932 10.4275 7.0051 11.4412 7.94464 12.1804C6.33472 12.8254 4.93 13.8952 3.88025 15.2758C2.83049 16.6563 2.17506 18.2958 1.98381 20.0196C1.96996 20.1454 1.98104 20.2728 2.01642 20.3943C2.05179 20.5159 2.11076 20.6293 2.18996 20.7281C2.34991 20.9276 2.58256 21.0554 2.83672 21.0833C3.09089 21.1113 3.34575 21.0371 3.54524 20.8772C3.74474 20.7172 3.87252 20.4846 3.90047 20.2304C4.11091 18.3571 5.00417 16.6269 6.4096 15.3705C7.81503 14.1141 9.63409 13.4196 11.5192 13.4196C13.4044 13.4196 15.2234 14.1141 16.6288 15.3705C18.0343 16.6269 18.9275 18.3571 19.138 20.2304C19.164 20.4659 19.2764 20.6834 19.4534 20.8409C19.6303 20.9984 19.8594 21.0848 20.0963 21.0833H20.2017C20.4529 21.0544 20.6825 20.9274 20.8405 20.7299C20.9985 20.5325 21.072 20.2806 21.0451 20.0292C20.8529 18.3005 20.1939 16.6568 19.1388 15.2741C18.0836 13.8914 16.6721 12.822 15.0555 12.1804ZM11.5001 11.5C10.7419 11.5 10.0008 11.2752 9.37037 10.854C8.73998 10.4328 8.24865 9.83407 7.95852 9.13362C7.66838 8.43317 7.59247 7.66241 7.74038 6.91882C7.88829 6.17523 8.25338 5.49219 8.78948 4.95609C9.32558 4.41999 10.0086 4.0549 10.7522 3.90699C11.4958 3.75908 12.2666 3.83499 12.967 4.12513C13.6675 4.41526 14.2661 4.90659 14.6874 5.53698C15.1086 6.16737 15.3334 6.9085 15.3334 7.66667C15.3334 8.68333 14.9295 9.65835 14.2106 10.3772C13.4917 11.0961 12.5167 11.5 11.5001 11.5Z" fill="black"/>
                </svg>
                <span>เข้าสู่ระบบ</span>
            </a>
            @endif
            <div class="header-cart">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.2008 15.6071H9.9065C8.77293 15.6071 7.78722 14.835 7.51615 13.7425L5.77472 6.76857C5.66793 6.33321 5.93079 5.88143 6.37436 5.77464C6.44007 5.75821 6.50579 5.75 6.5715 5.75H20.5358C20.9876 5.75 21.3572 6.11964 21.3572 6.57143C21.3572 6.63714 21.349 6.70286 21.3326 6.76857L19.5912 13.7343C19.3201 14.835 18.3344 15.6071 17.2008 15.6071ZM7.62293 7.39286L9.10972 13.34C9.20008 13.7096 9.52865 13.9643 9.9065 13.9643H17.2008C17.5787 13.9643 17.9072 13.7096 17.9976 13.34L19.4844 7.39286H7.62293Z" fill="white"/>
                    <path d="M6.57164 7.39287C6.19378 7.39287 5.86521 7.13822 5.77485 6.76858L5.10949 4.10715H2.46449C2.01271 4.10715 1.64307 3.73751 1.64307 3.28572C1.64307 2.83394 2.01271 2.46429 2.46449 2.46429H5.75021C6.12807 2.46429 6.45664 2.71894 6.54699 3.08858L7.36842 6.37429C7.47521 6.80965 7.21235 7.26144 6.76878 7.36822C6.70307 7.38465 6.63735 7.39287 6.57164 7.39287Z" fill="white"/>
                    <path d="M9.03592 20.5357C8.13235 20.5357 7.39307 19.7964 7.39307 18.8929C7.39307 17.9893 8.13235 17.25 9.03592 17.25C9.9395 17.25 10.6788 17.9893 10.6788 18.8929C10.6788 19.7964 9.9395 20.5357 9.03592 20.5357Z" fill="white"/>
                    <path d="M18.0716 20.5357C17.168 20.5357 16.4287 19.7964 16.4287 18.8929C16.4287 17.9893 17.168 17.25 18.0716 17.25C18.9751 17.25 19.7144 17.9893 19.7144 18.8929C19.7144 19.7964 18.9751 20.5357 18.0716 20.5357Z" fill="white"/>
                </svg>
                {{-- <div class="header-cart-text">฿ 1,899.00 (2)</div> --}}
                @php
                    $cart = session('cart', []);
                    $products = \App\Models\Product::whereIn('products_id', array_keys($cart))->get()->keyBy('products_id');
                    $headerCartTotal = 0;
                    $headerCartQty = 0;
                    foreach ($cart as $pid => $qty) {
                        $product = $products[$pid] ?? null;
                        if (!$product) continue;
                        $price = $product->products_price_promotion ?: $product->products_price_full;
                        $headerCartTotal += $price * $qty;
                        $headerCartQty += $qty;
                    }
                @endphp
                <div class="header-cart-text">
                    {{-- ฿ {{ number_format($headerCartTotal, 2) }} ({{ $headerCartQty }}) --}}
                    {{ $headerCartQty ? '฿ ' . number_format($headerCartTotal,2) . ' (' . $headerCartQty . ')' : '' }}
                </div>
            </div>
        </div>
    </nav>
    <div class="submenu-product">
        <div class="container">
            <div class="row">
                @php
                    $brand = DB::table('brands')->where('brand_status', 'show')->get();
                @endphp
                <div class="col-12 submenu-product-grid">
                    @foreach($brand as $rs)
                        @php
                            $brandName = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->brand_name);
                            $URLbrand = $rs->brand_url ? $rs->brand_url : $brandName;
                        @endphp
                        <a href="{{ url('products/'.$rs->brand_id.'/'.$URLbrand) }}" class="submenu-product-list"><img src="{{asset($rs->brand_logo)}}" alt="">{{$rs->brand_name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="search-popup">
        <div class="container">
            <div class="row">
                <form action="{{ url('products/search/')}}" method="get">
                @csrf
                <div class="col-12 search-popup-box">
                    <input type="text" name="search_product" id="search_product" class="search-popup-input" @if(isset($searchProduct)) value="{{ $searchProduct }}" @endif>
                    <button class="search-popup-btn" onclick="location.href='search-result.php'">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.88771 0C3.53997 0 0 3.53593 0 7.88401C0 12.2321 3.53759 15.768 7.88771 15.768C9.71234 15.768 11.3873 15.1411 12.7249 14.0986L12.6892 14.1342L17.2532 18.696C17.4551 18.8979 17.7165 19 17.9778 19C18.2391 19 18.5029 18.8979 18.7024 18.696C19.0992 18.2995 19.0992 17.6464 18.7024 17.2498L14.1385 12.6857L14.1052 12.7189C15.1482 11.382 15.7754 9.70541 15.7754 7.88401C15.7778 3.53593 12.2378 0 7.88771 0ZM7.88771 13.7187C4.66848 13.7187 2.05033 11.1017 2.05033 7.88401C2.05033 4.66629 4.66848 2.04937 7.88771 2.04937C11.1069 2.04937 13.7251 4.66629 13.7251 7.88401C13.7275 11.1017 11.1069 13.7187 7.88771 13.7187Z" fill="black"/>
                        </svg>
                    </button>
                    <button class="search-popup-close">
                        <svg class="feather feather-x" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</header>
<nav class="main-nav">
    <ul>
        <li class="mb-nav hassub"><a href="#">สินค้า</a>
            <ul class="submenu">
                @foreach($brand as $rs)
                    @php
                        $brandName = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->brand_name);
                        $URLbrand = $rs->brand_url ? $rs->brand_url : $brandName;
                    @endphp
                    <li><a href="{{ url('products/'.$rs->brand_id.'/'.$URLbrand) }}">{{$rs->brand_name}}</a></li>
                    <!-- <a href="{{ url('products/'.$rs->brand_id.'/'.$URLbrand) }}" class="submenu-product-list"><img src="{{asset($rs->brand_logo)}}" alt="">{{$rs->brand_name}}</a> -->
                @endforeach
                <!-- <li><a href="{{ url('products') }}">POWERTEX TOOLS</a></li>
                <li><a href="{{ url('products') }}">HUGONG</a></li>
                <li><a href="{{ url('products') }}">SUN-FLOWER</a></li> -->
            </ul>
        </li>
        <li class="mb-nav"><a href="{{ url('warranty') }}">ลงทะเบียนรับประกันออนไลน์</a></li>
        <li><a href="{{ url('about-us/'.$aboutUs->news_url) }}">เกี่ยวกับเรา</a></li>
        <li><a href="{{ url('news/article') }}">บทความ</a></li>
        <li><a href="{{ url('news/news') }}">ข่าวสารและโปรโมชั่น</a></li>
        <li><a href="{{ url('one-stop-service') }}">One stop service (แจ้งซ่อม)</a></li>
        <li><a href="{{ url('distributor') }}">ตัวแทนจำหน่าย</a></li>
        @php
            $URLcontact = $contact->contacts_url ? $contact->contacts_url : 'powertex-contect';
        @endphp
        <li><a href="{{ url('contact/'.$URLcontact)}}">ติดต่อเรา</a></li>
        @if($member)
        <li class="mb-nav">
            <a href="{{ route('member.address') }}">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.0555 12.1804C15.995 11.4412 16.6808 10.4275 17.0174 9.28044C17.354 8.13334 17.3247 6.90984 16.9336 5.78016C16.5425 4.65048 15.809 3.67079 14.8351 2.9774C13.8613 2.28401 12.6955 1.9114 11.5001 1.9114C10.3046 1.9114 9.13883 2.28401 8.16499 2.9774C7.19115 3.67079 6.45764 4.65048 6.06651 5.78016C5.67538 6.90984 5.64609 8.13334 5.9827 9.28044C6.31932 10.4275 7.0051 11.4412 7.94464 12.1804C6.33472 12.8254 4.93 13.8952 3.88025 15.2758C2.83049 16.6563 2.17506 18.2958 1.98381 20.0196C1.96996 20.1454 1.98104 20.2728 2.01642 20.3943C2.05179 20.5159 2.11076 20.6293 2.18996 20.7281C2.34991 20.9276 2.58256 21.0554 2.83672 21.0833C3.09089 21.1113 3.34575 21.0371 3.54524 20.8772C3.74474 20.7172 3.87252 20.4846 3.90047 20.2304C4.11091 18.3571 5.00417 16.6269 6.4096 15.3705C7.81503 14.1141 9.63409 13.4196 11.5192 13.4196C13.4044 13.4196 15.2234 14.1141 16.6288 15.3705C18.0343 16.6269 18.9275 18.3571 19.138 20.2304C19.164 20.4659 19.2764 20.6834 19.4534 20.8409C19.6303 20.9984 19.8594 21.0848 20.0963 21.0833H20.2017C20.4529 21.0544 20.6825 20.9274 20.8405 20.7299C20.9985 20.5325 21.072 20.2806 21.0451 20.0292C20.8529 18.3005 20.1939 16.6568 19.1388 15.2741C18.0836 13.8914 16.6721 12.822 15.0555 12.1804ZM11.5001 11.5C10.7419 11.5 10.0008 11.2752 9.37037 10.854C8.73998 10.4328 8.24865 9.83407 7.95852 9.13362C7.66838 8.43317 7.59247 7.66241 7.74038 6.91882C7.88829 6.17523 8.25338 5.49219 8.78948 4.95609C9.32558 4.41999 10.0086 4.0549 10.7522 3.90699C11.4958 3.75908 12.2666 3.83499 12.967 4.12513C13.6675 4.41526 14.2661 4.90659 14.6874 5.53698C15.1086 6.16737 15.3334 6.9085 15.3334 7.66667C15.3334 8.68333 14.9295 9.65835 14.2106 10.3772C13.4917 11.0961 12.5167 11.5 11.5001 11.5Z" fill="black"/>
                </svg>
                <span>{{ $member->name }} {{ $member->surname }}</span>
            </a>
        </li>
        @else
        <li class="mb-nav">
            <a href="{{ url('frontend/login') }}">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.0555 12.1804C15.995 11.4412 16.6808 10.4275 17.0174 9.28044C17.354 8.13334 17.3247 6.90984 16.9336 5.78016C16.5425 4.65048 15.809 3.67079 14.8351 2.9774C13.8613 2.28401 12.6955 1.9114 11.5001 1.9114C10.3046 1.9114 9.13883 2.28401 8.16499 2.9774C7.19115 3.67079 6.45764 4.65048 6.06651 5.78016C5.67538 6.90984 5.64609 8.13334 5.9827 9.28044C6.31932 10.4275 7.0051 11.4412 7.94464 12.1804C6.33472 12.8254 4.93 13.8952 3.88025 15.2758C2.83049 16.6563 2.17506 18.2958 1.98381 20.0196C1.96996 20.1454 1.98104 20.2728 2.01642 20.3943C2.05179 20.5159 2.11076 20.6293 2.18996 20.7281C2.34991 20.9276 2.58256 21.0554 2.83672 21.0833C3.09089 21.1113 3.34575 21.0371 3.54524 20.8772C3.74474 20.7172 3.87252 20.4846 3.90047 20.2304C4.11091 18.3571 5.00417 16.6269 6.4096 15.3705C7.81503 14.1141 9.63409 13.4196 11.5192 13.4196C13.4044 13.4196 15.2234 14.1141 16.6288 15.3705C18.0343 16.6269 18.9275 18.3571 19.138 20.2304C19.164 20.4659 19.2764 20.6834 19.4534 20.8409C19.6303 20.9984 19.8594 21.0848 20.0963 21.0833H20.2017C20.4529 21.0544 20.6825 20.9274 20.8405 20.7299C20.9985 20.5325 21.072 20.2806 21.0451 20.0292C20.8529 18.3005 20.1939 16.6568 19.1388 15.2741C18.0836 13.8914 16.6721 12.822 15.0555 12.1804ZM11.5001 11.5C10.7419 11.5 10.0008 11.2752 9.37037 10.854C8.73998 10.4328 8.24865 9.83407 7.95852 9.13362C7.66838 8.43317 7.59247 7.66241 7.74038 6.91882C7.88829 6.17523 8.25338 5.49219 8.78948 4.95609C9.32558 4.41999 10.0086 4.0549 10.7522 3.90699C11.4958 3.75908 12.2666 3.83499 12.967 4.12513C13.6675 4.41526 14.2661 4.90659 14.6874 5.53698C15.1086 6.16737 15.3334 6.9085 15.3334 7.66667C15.3334 8.68333 14.9295 9.65835 14.2106 10.3772C13.4917 11.0961 12.5167 11.5 11.5001 11.5Z" fill="black"/>
                </svg>
                <span>เข้าสู่ระบบ</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
<div class="overlay"></div>
<div class="social-box">
    <?php $contact = App\Models\Contact::first(); ?>
    @if($contact->contacts_facebook) <a href="{{$contact->contacts_facebook}}"><img src="{{asset('images/facebook.svg')}}" alt=""></a> @endif
    @if($contact->contacts_ig) <a href="{{$contact->contacts_ig}}"><img src="{{asset('images/instagram.svg')}}" alt=""></a> @endif
    @if($contact->contacts_yt) <a href="{{$contact->contacts_yt}}"><img src="{{asset('images/youtube.svg')}}" alt=""></a> @endif
    @if($contact->contacts_twitter) <a href="{{$contact->contacts_twitter}}"><img src="{{asset('images/icon-x.svg')}}" alt=""></a> @endif
    @if($contact->contacts_line) <a href="{{$contact->contacts_line}}"><img src="{{asset('images/line.svg')}}" alt=""></a> @endif
</div>

@include('frontend.partials.cart_box')

{{-- //cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js --}}
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/modernizr.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>

{{-- <script>
    $(document).ready(function() {

        // เพิ่มจำนวน
        $(document).on('click', '.cart-qty-plus', function(){
            var pid = $(this).data('id');
            var $input = $(this).closest('.cart-item-quantity-box').find('.cart-item-quantity-input');
            var qty = parseInt($input.val()) || 1;
            qty++;
            updateCartQty(pid, qty);
        });

        // ลดจำนวน
        $(document).on('click', '.cart-qty-minus', function(){
            var pid = $(this).data('id');
            var $input = $(this).closest('.cart-item-quantity-box').find('.cart-item-quantity-input');
            var qty = parseInt($input.val()) || 1;
            if(qty > 1) qty--;
            updateCartQty(pid, qty);
        });

        // ลบสินค้า
        $(document).on('click', '.cart-del', function(){
            var pid = $(this).data('id');
            if(confirm('ต้องการลบสินค้านี้ออกจากตะกร้า?')){
                $.post("{{ route('cart.remove') }}", {
                    product_id: pid,
                    _token: '{{ csrf_token() }}'
                }, function(res){
                    if(res.status){
                        reloadCartBox();
                    }
                }, 'json');
            }
        });

        // ฟังก์ชันสำหรับ update จำนวน (เรียกใช้หลังเพิ่ม/ลด)
        function updateCartQty(pid, qty){
            $.post("{{ route('cart.update') }}", {
                product_id: pid,
                quantity: qty,
                _token: '{{ csrf_token() }}'
            }, function(res){
                if(res.status){
                    reloadCartBox();
                }
            }, 'json');
        }

        // ฟังก์ชัน reload cart box
        window.reloadCartBox = function(){
            $.get("{{ route('cart.index') }}?partial=1", function(html){
                $('.cart-box').replaceWith(html);
            });
        }

    });

    window.reloadCartBox = function(){
        $.get("{{ route('cart.index') }}?partial=1", function(html){
            $('.cart-box').replaceWith(html);
        });
    }

</script> --}}

<script>
    $(document).ready(function() {
        // เพิ่มจำนวน
        $(document).on('click', '.cart-qty-plus', function(e){
            e.preventDefault();
            var pid = $(this).data('id');
            var $input = $(this).closest('.cart-item-quantity-box').find('.cart-item-quantity-input');
            var qty = parseInt($input.val()) || 1;
            qty++;
            updateCartQty(pid, qty);
        });

        // ลดจำนวน
        $(document).on('click', '.cart-qty-minus', function(e){
            e.preventDefault();
            var pid = $(this).data('id');
            var $input = $(this).closest('.cart-item-quantity-box').find('.cart-item-quantity-input');
            var qty = parseInt($input.val()) || 1;

            if(qty > 1){
                updateCartQty(pid, qty - 1);
            }else{
                // qty == 1 → ถ้าลด จะเท่ากับ 0 → ให้ pop up confirm ลบสินค้า
                Swal.fire({
                    title: 'ลบสินค้าออกจากตะกร้า?',
                    text: "ต้องการลบสินค้านี้ออกจากตะกร้าหรือไม่",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ใช่, ลบเลย',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        removeCartItem(pid);
                    }
                });
            }
        });

        // ลบสินค้า
        $(document).on('click', '.cart-del', function(e){
            e.preventDefault();
            var pid = $(this).data('id');
            Swal.fire({
                title: 'ลบสินค้าออกจากตะกร้า?',
                text: "ต้องการลบสินค้านี้ออกจากตะกร้าหรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่, ลบเลย',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeCartItem(pid);
                }
            });
        });

        // ฟังก์ชันสำหรับ update จำนวน
        function updateCartQty(pid, qty){
            $.post("{{ route('cart.update') }}", {
                product_id: pid,
                quantity: qty,
                _token: '{{ csrf_token() }}'
            }, function(res){
                if(res.status){
                    reloadCartBox();
                    updateHeaderCartText();
                }
            }, 'json');
        }

        // ฟังก์ชันสำหรับลบสินค้า (ใช้ร่วม -/del)
        function removeCartItem(pid){
            $.post("{{ route('cart.remove') }}", {
                product_id: pid,
                _token: '{{ csrf_token() }}'
            }, function(res){
                if(res.status){
                    Swal.fire({
                        icon: 'success',
                        title: 'ลบสินค้าออกจากตะกร้าแล้ว',
                        timer: 1000,
                        showConfirmButton: false
                    });
                    reloadCartBox();
                    updateHeaderCartText();
                }
            }, 'json');
        }

        // ฟังก์ชัน reload cart box
        window.reloadCartBox = function(){
            $.get("{{ route('cart.index') }}?partial=1", function(html){
                $('.cart-box').html($(html).html());
            });
        }

        // อัปเดต header-cart-text
        window.updateHeaderCartText = function(){
            $.get("{{ route('cart.header_text') }}", function(html){
                $('.header-cart-text').html(html);
            });
        }
    });

</script>
