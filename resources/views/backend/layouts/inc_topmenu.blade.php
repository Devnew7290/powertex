
<?php $locale = Session::get('locale');  ?>
@if($locale == 'th')
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent" id="topmenu">
    <div class="container-fluid justify-content-start justify-content-lg-between">
        <a class="navbar-brand logo" href="{{url('/')}}"><img src="{{asset('images/logo-uretek2.jpg')}}" alt=""></a>
        <ul class="navbar-nav d-flex d-lg-none ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{url('#')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_52_189)">
                            <path
                                d="M13.0999 2.5C11.7499 1.25 9.9749 0.5 7.9999 0.5C6.0249 0.5 4.2499 1.25 2.8999 2.5H13.0999ZM2.8999 13.5C4.2499 14.75 6.0249 15.5 7.9999 15.5C9.9749 15.5 11.7499 14.75 13.0999 13.5H2.8999Z"
                                fill="#ED4C5C" />
                            <path
                                d="M0.5 8C0.5 9.075 0.725 10.075 1.125 11H14.875C15.275 10.075 15.5 9.075 15.5 8C15.5 6.925 15.275 5.925 14.875 5H1.125C0.725 5.925 0.5 6.925 0.5 8Z"
                                fill="#004BA5" />
                            <path
                                d="M2.9001 13.5H13.0751C13.8251 12.8 14.4501 11.95 14.8501 11H1.1001C1.5501 11.95 2.1501 12.8 2.9001 13.5M13.1001 2.5H2.9001C2.1501 3.2 1.5251 4.05 1.1251 5H14.8751C14.4501 4.05 13.8501 3.2 13.1001 2.5"
                                fill="#F9F9F9" />
                        </g>
                        <defs>
                            <clipPath id="clip0_52_189">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    TH
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ url('change/th') }}">TH</a></li>
                    <li><a class="dropdown-item" href="{{ url('change/en') }}">EN</a></li>
                </ul>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-inline-flex w-100">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="linkMenuTop">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('about')}}">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('service')}}">บริการ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('pastwork')}}">ผลงานที่ผ่านมา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('news')}}">ข่าวสารและกิจกรรม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('brochure')}}">โบรชัวร์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}">ติดต่อเรา</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{url('#')}}" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_189)">
                                <path
                                    d="M13.0999 2.5C11.7499 1.25 9.9749 0.5 7.9999 0.5C6.0249 0.5 4.2499 1.25 2.8999 2.5H13.0999ZM2.8999 13.5C4.2499 14.75 6.0249 15.5 7.9999 15.5C9.9749 15.5 11.7499 14.75 13.0999 13.5H2.8999Z"
                                    fill="#ED4C5C" />
                                <path
                                    d="M0.5 8C0.5 9.075 0.725 10.075 1.125 11H14.875C15.275 10.075 15.5 9.075 15.5 8C15.5 6.925 15.275 5.925 14.875 5H1.125C0.725 5.925 0.5 6.925 0.5 8Z"
                                    fill="#004BA5" />
                                <path
                                    d="M2.9001 13.5H13.0751C13.8251 12.8 14.4501 11.95 14.8501 11H1.1001C1.5501 11.95 2.1501 12.8 2.9001 13.5M13.1001 2.5H2.9001C2.1501 3.2 1.5251 4.05 1.1251 5H14.8751C14.4501 4.05 13.8501 3.2 13.1001 2.5"
                                    fill="#F9F9F9" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_189">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        TH
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('change/th') }}">TH</a></li>
                        <li><a class="dropdown-item" href="{{ url('change/en') }}">EN</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif

<?php $locale = Session::get('locale');  ?>
    @if($locale == 'en')
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent" id="topmenu">
    <div class="container-fluid justify-content-start justify-content-lg-between">
        <a class="navbar-brand logo" href="{{url('/')}}"><img src="{{asset('images/logo-uretek2.jpg')}}" alt=""></a>
        <ul class="navbar-nav d-flex d-lg-none ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{url('#')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_52_189)">
                            <path
                                d="M13.0999 2.5C11.7499 1.25 9.9749 0.5 7.9999 0.5C6.0249 0.5 4.2499 1.25 2.8999 2.5H13.0999ZM2.8999 13.5C4.2499 14.75 6.0249 15.5 7.9999 15.5C9.9749 15.5 11.7499 14.75 13.0999 13.5H2.8999Z"
                                fill="#ED4C5C" />
                            <path
                                d="M0.5 8C0.5 9.075 0.725 10.075 1.125 11H14.875C15.275 10.075 15.5 9.075 15.5 8C15.5 6.925 15.275 5.925 14.875 5H1.125C0.725 5.925 0.5 6.925 0.5 8Z"
                                fill="#004BA5" />
                            <path
                                d="M2.9001 13.5H13.0751C13.8251 12.8 14.4501 11.95 14.8501 11H1.1001C1.5501 11.95 2.1501 12.8 2.9001 13.5M13.1001 2.5H2.9001C2.1501 3.2 1.5251 4.05 1.1251 5H14.8751C14.4501 4.05 13.8501 3.2 13.1001 2.5"
                                fill="#F9F9F9" />
                        </g>
                        <defs>
                            <clipPath id="clip0_52_189">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    TH
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ url('change/th') }}">TH</a></li>
                    <li><a class="dropdown-item" href="{{ url('change/en') }}">EN</a></li>
                </ul>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-inline-flex w-100">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="linkMenuTop">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('service')}}">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('pastwork')}}">Pastwork</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('news')}}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('brochure')}}">Brochure</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{url('#')}}" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_189)">
                                <path
                                    d="M13.0999 2.5C11.7499 1.25 9.9749 0.5 7.9999 0.5C6.0249 0.5 4.2499 1.25 2.8999 2.5H13.0999ZM2.8999 13.5C4.2499 14.75 6.0249 15.5 7.9999 15.5C9.9749 15.5 11.7499 14.75 13.0999 13.5H2.8999Z"
                                    fill="#ED4C5C" />
                                <path
                                    d="M0.5 8C0.5 9.075 0.725 10.075 1.125 11H14.875C15.275 10.075 15.5 9.075 15.5 8C15.5 6.925 15.275 5.925 14.875 5H1.125C0.725 5.925 0.5 6.925 0.5 8Z"
                                    fill="#004BA5" />
                                <path
                                    d="M2.9001 13.5H13.0751C13.8251 12.8 14.4501 11.95 14.8501 11H1.1001C1.5501 11.95 2.1501 12.8 2.9001 13.5M13.1001 2.5H2.9001C2.1501 3.2 1.5251 4.05 1.1251 5H14.8751C14.4501 4.05 13.8501 3.2 13.1001 2.5"
                                    fill="#F9F9F9" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_189">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        TH
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('change/th') }}">TH</a></li>
                        <li><a class="dropdown-item" href="{{ url('change/en') }}">EN</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif