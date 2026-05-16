<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Pharm')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&amp;family=Inter:wght@700;800&amp;display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    @vite('resources/js/app.js')

</head>

<body>

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Include your navigation bar or header here -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="\" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
            <h1 class="m-0 text-success">PharmAK</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link active">Home</a>

                <div class="nav-item dropdown">
                    <a href="#Products" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Products</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="#Products" class="dropdown-item">New Products</a>
                        <a href="/products" class="dropdown-item">All Products</a>
                        @if(auth()->check() && auth()->user()->is_admin)
                        <a class="dropdown-item" href="{{ route('products.orders') }}">Orders</a>
                        @endif
                    </div>
                </div>

                @if(request()->is('/'))
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="#category" class="dropdown-item">Category</a>
                        <a href="#Reviews" class="dropdown-item">Testimonial</a>
                        <a href="#about" class="dropdown-item">About</a>
                    </div>
                </div>
                @endif

                <a href="/guide" class="nav-item nav-link">Guide</a>
                <a href="/contact" class="nav-item nav-link">Contact</a>

                @if(Auth::check())
                <!-- If the user is logged in, display their name -->
                <div class="d-flex align-items-center">
                    <a href="{{ route('logout') }}" class="btn btn-danger rounded-0 py-4 px-lg-5 w-100"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ Auth::user()->name }}
                    </a>
                </div>

                <!-- Logout form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <!-- If the user is not logged in, show the Log in button -->
                <a href="{{ route('login') }}" class="btn btn-success rounded-0 py-4 px-lg-5">
                    Log in <i class="fa fa-arrow-right ms-3"></i>
                </a>
                @endif
            </div>
        </div>
    </nav>



    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel">
        <div class="modal-dialog modal-dialog-slideout modal-lg" style="position: fixed; left: 0; top: 0; height: 100%; margin: 0; max-width: 350px;">
            <div class="modal-content h-100">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">🛒 سلة المشتريات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                    $totalPrice = 0;
                    $cart = session('cart', []); // تأكد من أن cart موجودة، وإذا لم تكن موجودة، ستُعيد مصفوفة فارغة
                    @endphp

                    @if(count($cart) > 0)
                    <ul class="list-group">
                        @foreach($cart as $id => $product)
                        @php
                        $totalPrice += ($product['price'] ?? 0) * ($product['quantity'] ?? 1);
                        @endphp

                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <!-- صورة المنتج -->


                            @if(isset($product['image']) && !empty($product['image']))
                            @php
                            // التحقق مما إذا كانت الصور مخزنة كمصفوفة JSON
                            $images = is_array(json_decode($product['image'], true)) ? json_decode($product['image'], true) : [$product['image']];
                            $firstImage = $images[0] ?? 'default.jpg';
                            @endphp

                            <img src="{{ asset('images/' . basename($firstImage)) }}"
                                class="d-block rounded border"
                                style="max-height: 80px; object-fit: cover;"
                                alt="{{ $product['name'] }}">
                            @endif


                            <!-- تفاصيل المنتج -->
                            <div class="flex-grow-1 mx-3">
                                <span class="fw-bold">
                                    {{ implode(' ', array_slice(explode(' ', trim($product['name'] ?? 'اسم غير متوفر')), 0, 3)) }}
                                </span>
                                <span class="d-block text-muted">
                                    {{ $product['price'] ?? 0 }} DA × {{ $product['quantity'] ?? 1 }} =
                                    <strong>{{ ($product['price'] ?? 0) * ($product['quantity'] ?? 1) }} DA</strong>
                                </span>

                            </div>

                            <!-- زر إزالة المنتج -->
                            <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">❌</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>

                    <!-- إجمالي السعر -->
                    <div class="mt-3 text-center">
                        <strong>الإجمالي:</strong> <span class="fw-bold">{{ $totalPrice }} DA</span>
                    </div>

                    <button class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#buyModal">إتمام الطلب</button>
                    @else
                    <p class="text-center text-muted">السلة فارغة 🛒</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Main content of the page -->

    @yield('content') <!-- This is where the content of the page will be inserted -->


    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Company</h5>
                    <a class="btn btn-link text-white-50" href="#about">About Us</a>
                    <a class="btn btn-link text-white-50" href="\contact">Contact Us</a>
                    <a class="btn btn-link text-white-50" href="/guide">Guide</a>
                    <!-- <a class="btn btn-link text-white-50" href="">Our Services</a>
                    <a class="btn btn-link text-white-50" href="">Privacy Policy</a> -->
                    <!-- <a class="btn btn-link text-white-50" href="">Terms &amp; Condition</a> -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link text-white-50" href="https://www.instagram.com/pharmacy_ilyas/">Instagram</a>
                    <a class="btn btn-link text-white-50" href="https://www.facebook.com/profile.php?id=61566844845807">Facebook</a>
                    <a class="btn btn-link text-white-50" href="\">Our WebSite</a>
                    <!-- <a class="btn btn-link text-white-50" href="">Terms &amp; Condition</a> -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Contact</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Sougueur, Tiaret</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+0777792300</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>dahmanipharmacie16@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/pharmacy_ilyas/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/profile.php?id=61566844845807"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/@AbadaKamel-v9v"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/in/abada-kamel-b3554333b/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-success py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        © <a class="border-bottom" href="#">IlyasPharm</a>, All Right Reserved.
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://www.linkedin.com/in/abada-kamel-b3554333b/">KamelAB</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="\">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        window.onload = function() {
            let spinner = document.getElementById('spinner');
            if (spinner) {
                spinner.style.zIndex = "1000"; // ضمان ظهور الـ spinner أثناء التحميل
                setTimeout(() => {
                    spinner.style.opacity = "0"; // تقليل الشفافية تدريجيًا
                    setTimeout(() => {
                        spinner.style.zIndex = "-1"; // جعله خلف باقي الصفحة بعد الاختفاء
                        spinner.style.display = "none"; // إزالته نهائيًا بعد التأثير
                    }, 800); // مدة الانتقال (يجب أن تتطابق مع مدة الـ transition في CSS)
                }, 500);
            }
        };
    </script>


</body>

</html>
