<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multi level dropdown menu laravel</title>
    <link rel="stylesheet" href="{{ url('assets/css/main.css?v=3.4') }}">

    <style>
        .main-menu>nav>ul>li ul.mega-menu {
            width: 800px;
            max-width: 100%;
            transform: translate(-50%, 0px);
            position: absolute;
            left: 50%;
            top: 100%;

        }

        .main-menu>nav>ul>li ul.sub-menu {
            padding: 15px 0px;
        }

        .main-menu>nav>ul>li ul.sub-menu li ul.level-menu {
            padding: 15px 0px;
        }

        .main-menu>nav>ul>li ul.mega-menu {
            padding: 20px 15px 20px 20px;
        }
    </style>
</head>

<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="#">
                            <h1>Logo</h1>
                        </a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <div class="logo logo-width-1 d-block ">
                                <a href="#">
                                    <h1>Logo</h1>
                                </a>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    @foreach ($parent_menu_item as $p_menu_item)
                                        <li id="menu_id_{{ $p_menu_item->id }}"
                                            class="@if ($p_menu_item->is_mega_menu == 1) position-static @endif "><a
                                                class="" href="{{ $p_menu_item->slug }}">
                                                {{ $p_menu_item->name }}
                                                @if (count($p_menu_item->child_menu))
                                                    <i class="fi-rs-angle-down"></i>
                                                @endif
                                            </a>
                                            @if ($p_menu_item->is_mega_menu == 1)
                                                @if (count($p_menu_item->child_menu))
                                                    @include('front.child_mega_menu', [
                                                        'child_menus' => $p_menu_item->child_menu,
                                                        'parent_menu_item' => $p_menu_item,
                                                        'all_menu_item' => $all_menu_item,
                                                        'level' => 2,
                                                        'is_mega_menu' => 'mega-menu',
                                                    ])
                                                @endif
                                            @else
                                                @if (count($p_menu_item->child_menu))
                                                    @include('front.child_menu', [
                                                        'child_menus' => $p_menu_item->child_menu,
                                                        'parent_menu_item' => $p_menu_item,
                                                        'all_menu_item' => $all_menu_item,
                                                        'level' => 2,
                                                        'is_mega_menu' => 'mega-menu',
                                                    ])
                                                @endif
                                            @endif

                                        </li>
                                    @endforeach


                                    <li>
                                        <a href="page-contact.html">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-headset"></i><span>Hotline</span> 1900 - 888 </p>
                    </div>
                    <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%
                    </p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Evara" src="assets/imgs/icons/icon-heart.svg">
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="shop-cart.html">
                                    <img alt="Evara" src="assets/imgs/icons/icon-cart.svg">
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Evara"
                                                        src="assets/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Evara"
                                                        src="assets/imgs/shop/thumbnail-4.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html">
                        <h1>Logo</h1>
                    </a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            @foreach ($parent_menu_item as $p_menu_item)
                                <li id="menu_id_{{ $p_menu_item->id }}"
                                    class="@if (count($p_menu_item->child_menu)) menu-item-has-children @endif "><a
                                        class="" href="{{ $p_menu_item->slug }}">
                                        {{ $p_menu_item->name }}
                                        @if (count($p_menu_item->child_menu))
                                            <i class="fi-rs-angle-down"></i>
                                        @endif
                                    </a>
                                    @if (count($p_menu_item->child_menu))
                                        @include('front.child_menu', [
                                            'child_menus' => $p_menu_item->child_menu,
                                            'parent_menu_item' => $p_menu_item,
                                            'all_menu_item' => $all_menu_item,
                                            'level' => 2,
                                        ])
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="page-contact.html"> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login-register.html">Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">(+01) - 2345 - 6789 </a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container text-center mt-5 pt-5">
        <a href="{{ url('admin/menu') }}" class="btn btn-primary">Got to admin menu managemnet</a>
    </div>


</body>

</html>
