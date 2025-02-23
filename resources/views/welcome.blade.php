@extends('layouts.app')

@section('title', 'Pharm - Home')

@section('content')
<div class="bg-white p-0">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item header-carousel active">
                <div class="owl-carousel-item position-relative">
                    <img src="img/carousel-1.jpg" class="d-block w-100 img-fluid" alt="صورة 1">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, 0.6);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10">
                                    <h1 class="display-2 text-white fw-bold animated fadeInDown" style="font-family: 'Tajawal', sans-serif;">
                                        اكتشف الجودة والراحة في اختيار منتجاتك الصحية
                                    </h1>
                                    <p class="fs-4 fw-light text-white mb-4 pb-2 animated fadeInUp" style="font-family: 'Cairo', sans-serif;">
                                        نوفر لك أفضل الأدوية والمنتجات الطبية الموثوقة لتلبية احتياجاتك.
                                        صحتك وراحتك هي أولويتنا، اكتشف عالمًا من الحلول المتكاملة لرفاهيتك اليومية.
                                    </p>
                                    <a href="#Products" class="btn btn-lg btn-success py-3 px-5 me-3 animated zoomIn">تصفح المنتجات</a>
                                    <a href="#category" class="btn btn-lg btn-outline-light py-3 px-5 animated zoomIn">استكشاف الفئات</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item header-carousel">
                <div class="owl-carousel-item position-relative">
                    <img src="img/carousel-2.jpg" class="d-block w-100" alt="صورة 2">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, 0.6);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white fw-bold animated fadeInDown" style="font-family: 'Tajawal', sans-serif;">
                                        نقدم لك حلولًا موثوقة لصحة أفضل ورفاهية تدوم
                                    </h1>
                                    <p class="fs-4 fw-light text-white mb-4 pb-2 animated fadeInUp" style="font-family: 'Cairo', sans-serif;">
                                        نحرص على تقديم رعاية صحية شخصية ونصائح متخصصة، لضمان حصولك على أفضل الحلول لصحتك مع دعم وإرشاد موثوق به.
                                    </p>
                                    <a href="#Reviews" class="btn btn-lg btn-success py-3 px-5 me-3 animated zoomIn">آراء عملائنا</a>
                                    <a href="#Contact" class="btn btn-lg btn-outline-light py-3 px-5 animated zoomIn">اتصل بنا</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Search Start -->
    <div class="container-fluid bg-success mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <form action="{{ route('products.search') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control border-0" placeholder="Search for a product..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-select border-0">
                                    <option value="">All Categories</option>
                                    <option value="Cream" {{ request('category') == 'Cream' ? 'selected' : '' }}>Cream</option>
                                    <option value="Shampoing" {{ request('category') == 'Shampoing' ? 'selected' : '' }}>Shampoing</option>
                                    <option value="Gel" {{ request('category') == 'Gel' ? 'selected' : '' }}>Gel</option>
                                    <option value="Savon" {{ request('category') == 'Savon' ? 'selected' : '' }}>Savon</option>
                                    <option value="Huile" {{ request('category') == 'Huile' ? 'selected' : '' }}>Huile</option>
                                    <option value="Eau" {{ request('category') == 'Eau' ? 'selected' : '' }}>Eau</option>
                                    <option value="Après" {{ request('category') == 'Après' ? 'selected' : '' }}>Après</option>
                                    <option value="Dentifrice" {{ request('category') == 'Dentifrice' ? 'selected' : '' }}>Dentifrice</option>
                                    <option value="Solution" {{ request('category') == 'Solution' ? 'selected' : '' }}>Solution</option>
                                    <option value="Baume" {{ request('category') == 'Baume' ? 'selected' : '' }}>Baume</option>
                                    <option value="Fluide" {{ request('category') == 'Fluide' ? 'selected' : '' }}>Fluide</option>
                                    <option value="Pain" {{ request('category') == 'Pain' ? 'selected' : '' }}>Pain</option>
                                    <option value="Lotion" {{ request('category') == 'Lotion' ? 'selected' : '' }}>Lotion</option>
                                    <option value="Lait" {{ request('category') == 'Lait' ? 'selected' : '' }}>Lait</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark border-0 w-100">Search</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- Search End -->


    <!-- Category Start -->
    <div class="container-xxl py-5" id="category">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="cat-item rounded p-4" href="/products">
                        <i class="fa fa-3x fa-mail-bulk text-success mb-4"></i>
                        <h6 class="mb-3">All Products</h6>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a class="cat-item rounded p-4" href="#Reviews">
                        <i class="fa fa-3x fa-headset text-success mb-4"></i>
                        <h6 class="mb-3">Reviews</h6>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a class="cat-item rounded p-4" href="/contact">
                        <i class="fa fa-3x fa-user-tie text-success mb-4"></i>
                        <h6 class="mb-3">Contact us</h6>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <a class="cat-item rounded p-4" href="#about">
                        <i class="fa fa-3x fa-book-reader text-success mb-4"></i>
                        <h6 class="mb-3">About</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100" src="img/about-1.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid" src="img/about-2.jpg" style="width: 85%; margin-top: 15%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid" src="img/about-3.jpg" style="width: 85%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100" src="img/about-4.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn text-end" data-wow-delay="0.5s">
                    <h1 class="mb-4">نساعدك في الحصول على أفضل المنتجات والرعاية من خلالنا</h1>
                    <p class="mb-4">نحن ملتزمون بتقديم منتجات عالية الجودة وخدمة شخصية، مما يضمن لك العثور على ما تحتاجه بالضبط. التزامنا برفاهيتك يدفعنا إلى تقديم حلول موثوقة مصممة خصيصًا لصحتك، حتى تتمكن من الاستمتاع براحة البال كل يوم.</p>
                    <p><i class="fa fa-check text-success me-3"></i>رضا العملاء: تقييمات وآراء إيجابية.</p>
                    <p><i class="fa fa-check text-success me-3"></i>ضمان الجودة: معايير عالية وثابتة للمنتجات.</p>
                    <p><i class="fa fa-check text-success me-3"></i>دعم سريع: خدمة عملاء فعالة وسريعة.</p>
                    <a class="btn btn-success py-3 px-5 mt-3" href="">اقرأ المزيد</a>
                </div>
            </div>
        </div>
    </div>

    <!-- About End -->


    <!-- Jobs Start -->
    <div class="container-xxl py-5" id="Products">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Products</h1>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <!-- <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1" aria-selected="true" role="tab">
                            <h6 class="mt-n1 mb-0">Featured</h6>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2" aria-selected="false" tabindex="-1" role="tab">
                            <h6 class="mt-n1 mb-0">Full Time</h6>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3" aria-selected="false" tabindex="-1" role="tab">
                            <h6 class="mt-n1 mb-0">Part Time</h6>
                        </a>
                    </li>
                </ul> -->
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active" role="tabpanel">
                        @foreach ($products as $product)
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    @if(isset($product) && $product->images)
                                    @php
                                    $images = json_decode($product->images, true);
                                    $firstImage = $images[1] ?? null;
                                    @endphp

                                    @if($firstImage)
                                    <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="img-fluid mb-3 border zoom-image" style="max-height: 150px;" onclick="zoomImage(this)">
                                    @endif
                                    @endif
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">{{ $product->name }}</h5>
                                        <span class="text-truncate me-3">
                                            <i class="fa fa-info-circle text-primary me-2"></i>
                                            {{ \Illuminate\Support\Str::words($product->description, 5, '...') }}
                                        </span>

                                        <span class="text-truncate me-3"><i class="far fa-clock text-success me-2"></i>{{ $product->quantity }}</span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-success me-2"></i>{{ $product->price }} Da</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <!-- <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-success"></i></a> -->
                                        <a class="btn btn-success" href="{{ route('product.detail', $product->id) }}">اطلب الان</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-success me-2"></i>Date Line: {{ $product->created_at->format('d M, Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <a class="btn btn-success py-3 px-5" href="/products">تصفح المزيد من المنتجات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs End -->


    <!-- Testimonial Start -->
    

    @if(auth()->check() && auth()->user()->is_admin)
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" id="Reviews">
        <div class="container">
            <h1 class="text-center mb-5">Our Clients Say!!!</h1>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-success mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-success mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-success mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-success mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-4.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Testimonial End -->

   





    



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection