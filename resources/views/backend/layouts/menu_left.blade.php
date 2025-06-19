 <!-- BEGIN: Mobile Menu -->
<?php
    // use Auth;
?>
 <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-white/[0.08] py-5 hidden">
                <li>
                    <a href="{{url('/home')}}" class="menu">
                        <div class="menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="menu__title"> ลูกค้าของเรา </div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="menu__title">
                            แกลอรี่
                        <div class="menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul <?php if ($activePage =="gallery") {?> class="side-menu__sub-open" <?php }else{?> class=""<?php  } ?>>
                        <li>
                            <a href="{{url('backend/gallery')}}" class="menu menu--active">
                                <div class="menu__icon"> <i data-lucide="edit"></i> </div>
                                <div class="menu__title"> ข้อมูลแกลอรี่ </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('backend/gallery/type')}}" class="menu menu--active">
                                <div class="menu__icon"> <i data-lucide="type"></i> </div>
                                <div class="menu__title"> หมวดหมู่แกลอรี่ </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="{{url('home')}}" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="hidden xl:block text-white text-lg ml-3"> POWERTEX </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>

                    @if (in_array("home", auth()->user()->menus))
                    <li>
                        <a href="javascript:;" <?php if ($activePage =="home_page") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>>
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title">
                                หน้าแรก
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul <?php if ($activePage =="home_page") {?> class="side-menu__sub-open" <?php }else{?> class=""<?php  } ?>>


                            <li>
                                <a href="{{url('backend/home/text-header')}}" <?php if ($active =="text_header") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="type"></i> </div>
                                    <div class="side-menu__title"> ข้อความ </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('backend/home/banner')}}" <?php if ($active =="home_page_banner") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="image"></i> </div>
                                    <div class="side-menu__title"> แบนเนอร์ </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('backend/home/powertex')}}" <?php if ($active =="home_page_powertex") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                                    <div class="side-menu__title"> พาวเวอร์เท็กซ์ </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('backend/home/why')}}" <?php if ($active =="home_page_why") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                                    <div class="side-menu__title"> ทำไมต้องพาวเวอร์เท็กซ์ </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (in_array("product_detail", auth()->user()->menus))
                    <li>
                        <a href="javascript:;" <?php if ($activePage =="product") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>>
                            <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                            <div class="side-menu__title">
                                สินค้า
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul <?php if ($activePage =="product") {?> class="side-menu__sub-open" <?php }else{?> class=""<?php  } ?>>
                            <li>
                                <a href="{{url('backend/product/brand')}}" <?php if ($active =="brand") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="image"></i> </div>
                                    <div class="side-menu__title"> แบรนด์สินค้า </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('backend/product/type')}}" <?php if ($active =="type") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="type"></i> </div>
                                    <div class="side-menu__title"> หมวดหมู่สินค้า </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('backend/product/detail')}}" <?php if ($active =="detail") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                                    <div class="side-menu__title"> สินค้า </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (in_array("aboutus", auth()->user()->menus))
                    <li>
                        <a href="{{url('backend/news_promotion/aboutUs')}}" <?php if ($activePage =="aboutUs") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title"> เกี่ยวกับเรา </div>
                        </a>
                    </li>
                    @endif

                    <li>
                        <a href="javascript:;" <?php if ($activePage =="news_promotion") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>>
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title">
                                บทความ ข่าว<br>โปรโมชั่น
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul <?php if ($activePage =="news_promotion") {?> class="side-menu__sub-open" <?php }else{?> class=""<?php  } ?>>

                            @if (in_array("article", auth()->user()->menus))
                            <li>
                                <a href="{{url('backend/news_promotion/article')}}" <?php if ($active =="article") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                                    <div class="side-menu__title"> บทความ </div>
                                </a>
                            </li>
                            @endif

                            @if (in_array("news", auth()->user()->menus))
                            <li>
                                <a href="{{url('backend/news_promotion/news')}}" <?php if ($active =="news") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                                    <div class="side-menu__title"> ข่าว </div>
                                </a>
                            </li>
                            @endif

                            @if (in_array("promotion", auth()->user()->menus))
                            <li>
                                <a href="{{url('backend/promotion')}}" <?php if ($active =="file-text") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                                    data-page="acct">
                                    <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                                    <div class="side-menu__title"> โปรโมชั่น </div>
                                </a>
                            </li>
                            @endif

                        </ul>
                    </li>

                    @if (in_array("promocode", auth()->user()->menus))
                    <li>
                        <a href="{{url('/backend/promocode')}}" <?php if ($activePage =="file-text") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title"> โค้ดส่วนลด </div>
                        </a>
                    </li>
                    @endif

                    @if (in_array("dealer", auth()->user()->menus))
                    <li>
                        <a href="{{url('/backend/dealer')}}" <?php if ($activePage =="dealer") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title"> ตัวแทนจำหน่าย </div>
                        </a>
                    </li>
                    @endif

                    @if (in_array("contact", auth()->user()->menus))
                    <li>
                        <a href="{{url('/backend/contact')}}" <?php if ($activePage =="contact") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="phone"></i> </div>
                            <div class="side-menu__title"> ติดต่อเรา </div>
                        </a>
                    </li>
                    @endif


                    @if (in_array("repairs", auth()->user()->menus))
                    <?php $service = App\Models\Services::where('service_new', 'new')->get(); ?>
                    <li>
                        <a href="{{url('/backend/repairs')}}" <?php if ($activePage =="repairs") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title"> แจ้งซ่อม
                            </div>
                        </a>
                    </li>
                    @endif

                    @if (in_array("warranty", auth()->user()->menus))
                    <li>
                        <a href="{{url('backend/warranty')}}" <?php if ($activePage =="warranty") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title"> รับประกันสินค้าออนไลน์ </div>
                        </a>
                    </li>
                    @endif

                    @if (in_array("catalog", auth()->user()->menus))
                    <li>
                        <a href="{{url('backend/catalog')}}" <?php if ($activePage =="catalog") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>
                            data-page="acct">
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title"> แคตตาล็อก </div>
                        </a>
                    </li>
                    @endif


                    {{-- จัดการผู้ใช้งาน --}}
                    @if (in_array("manage_users", auth()->user()->menus))
                    <li>
                        <a href="{{ route('backend.users.index') }}" <?php if ($activePage =="users") {?> class="side-menu side-menu--active" <?php }else{?> class="side-menu"<?php  } ?>>
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title"> จัดการผู้ใช้ </div>
                        </a>
                    </li>
                    @endif


                </ul>

            </nav>
            <!-- END: Side Menu -->
