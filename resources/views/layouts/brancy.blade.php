<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Brancy - Cosmetic & Beauty Salon Website Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Brancy - Cosmetic & Beauty Salon Website Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="bootstrap, ecommerce, ecommerce html, beauty, cosmetic shop, beauty products, cosmetic, beauty shop, cosmetic store, shop, beauty store, spa, cosmetic, cosmetics, beauty salon" />
    <meta name="author" content="codecarnival" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.webp')}}">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">

    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="{{asset('css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/fancybox.min.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/plugins/range-slider.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/plugins/nice-select.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}">
    @vite(['resources/js/app.js'])
    <script>
        // rename myToken as you like
        window.myToken =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
<div id="app">
    <!--== Wrapper Start ==-->
    <div class="wrapper">

        @yield('content')

    </div>
    <!--== Wrapper End ==-->
</div>
<!-- JS Vendor, Plugins & Activation Script Files -->

<!-- Vendors JS -->
<script  src="{{asset('js/vendor/modernizr-3.11.7.min.js')}}"></script>
<script  src="{{asset('js/vendor/jquery-3.6.0.min.js')}}"></script>
<script  src="{{asset('js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
{{--<script  src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>--}}

<!-- Plugins JS -->
<script  src="{{asset('js/plugins/swiper-bundle.min.js')}}"></script>
<script  src="{{asset('js/plugins/fancybox.min.js')}}"></script>
{{--<script  src="{{asset('js/plugins/range-slider.js')}}"></script>--}}
<script  src="{{asset('js/plugins/jquery.nice-select.min.js')}}"></script>

<!-- Custom Main JS -->
<script type="module" src="{{asset('js/main.js')}}"></script>

<!--== Scroll Top Button ==-->
<div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>

<!--== Start Aside Menu ==-->
<aside class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h1 class="d-none" id="offcanvasExampleLabel">Aside Menu</h1>
        <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i class="fa fa-chevron-left"></i></button>
    </div>
    <div class="offcanvas-body">
        <div id="offcanvasNav" class="offcanvas-menu-nav">
            <ul>
                <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">home</a>
                    <ul>
                        <li><a href="index.html">Home One</a></li>
                        <li><a href="index-two.html">Home Two</a></li>
                    </ul>
                </li>
                <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="about-us.html">about</a></li>
                <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">shop</a>
                    <ul>
                        <li><a href="#" class="offcanvas-nav-item">Shop Layout</a>
                            <ul>
                                <li><a href="product.html">Shop 3 Column</a></li>
                                <li><a href="product-four-columns.html">Shop 4 Column</a></li>
                                <li><a href="product-left-sidebar.html">Shop Left Sidebar</a></li>
                                <li><a href="product-right-sidebar.html">Shop Right Sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="offcanvas-nav-item">Single Product</a>
                            <ul>
                                <li><a href="product-details-normal.html">Single Product Normal</a></li>
                                <li><a href="product-details.html">Single Product Variable</a></li>
                                <li><a href="product-details-group.html">Single Product Group</a></li>
                                <li><a href="product-details-affiliate.html">Single Product Affiliate</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="offcanvas-nav-item">Others Pages</a>
                            <ul>
                                <li><a href="product-cart.html">Shopping Cart</a></li>
                                <li><a href="product-checkout.html">Checkout</a></li>
                                <li><a href="product-wishlist.html">Wishlist</a></li>
                                <li><a href="product-compare.html">Compare</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">Blog</a>
                    <ul>
                        <li><a class="offcanvas-nav-item" href="#">Blog Layout</a>
                            <ul>
                                <li><a href="blog.html">Blog Grid</a></li>
                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">Pages</a>
                    <ul>
                        <li><a href="account-login.html">My Account</a></li>
                        <li><a href="faq.html">Frequently Questions</a></li>
                        <li><a href="page-not-found.html">Page Not Found</a></li>
                    </ul>
                </li>
                <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="contact.html">Contact</a></li>
            </ul>
        </div>
    </div>
</aside>
<!--== End Aside Menu ==-->
</body>

</html>

