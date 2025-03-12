@extends('layouts.app')

@section('title', 'Pharm - Products')

@section('content')



<div class="container mt-5">
    <div class="row justify-content-between align-items-center mb-4">
        <!-- العنوان على أقصى اليمين -->
        <div class="col-auto">
            <h1 class="mb-0 text-end">Our Products</h1>
        </div>

        <!-- زر إنشاء منتج جديد على أقصى اليسار -->
        @if(auth()->check() && auth()->user()->is_admin)
        <div class="col-auto">
            <a href="{{ route('products.create') }}" class="btn btn-success">Create New Product</a>
        </div>
        @endif
    </div>

    <form method="GET" action="{{ route('products.products') }}" class="mb-4">
        <div class="form-group d-flex align-items-center">
            <label for="type" class="me-2">Filter by Type:</label>
            <div class="dropdown">
                <!-- زر لفتح المودال -->
                <button class="btn btn-outline-secondary btn-sm d-flex align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#productModal">
                    <i class="bi bi-funnel me-1"></i>
                    {{ request('type') ? request('type') : 'All Products' }}
                </button>

                <!-- المودال -->
                <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-left">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel">تصفية المنتجات / Filtrer les produits</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق / Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products') }}">📌 كل المنتجات / Tous les produits</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Cream']) }}">🧴 كريم / Crème</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Shampoing']) }}">🚿 شامبو / Shampoing</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Gel']) }}">🧼 جل / Gel</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Savon']) }}">🛁 صابون / Savon</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Huile']) }}">💧 زيت / Huile</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Eau de Cologne']) }}">🌿 ماء كولونيا / Eau de Cologne</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Après-shampoing']) }}">🪮 بلسم / Après-shampoing</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Dentifrice']) }}">🦷 معجون أسنان / Dentifrice</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Solution']) }}">💊 محلول / Solution</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Baume']) }}">🥥 مرهم / Baume</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Fluide']) }}">💦 سائل / Fluide</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Pain surgras']) }}">🛀 صابون مغذٍ / Pain surgras</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Lotion']) }}">🧪 لوشن / Lotion</a></li>
                                    <li><a id="filterL" class="list-group-item" href="{{ route('products.products', ['type' => 'Lait']) }}">🥛 حليب / Lait</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    @if($products->isEmpty())
    <p>No products available at the moment.</p>
    @else
    <div class="row">
        @foreach ($products as $product)
        <div class="col-6 col-lg-3 mb-4">
            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-sm w-100">
                <div class="card shadow-lg p-3 bg-white rounded h-100 hover-secondary product-card">
                    <div class="card-body text-center d-flex flex-column">
                        @if(isset($product) && $product->images)
                        @php
                        $images = json_decode($product->images, true);
                        $firstImage = $images[1] ?? null;
                        @endphp

                        @if($firstImage)
                        <img src="{{ asset('images/' . basename($firstImage)) }}" alt="{{ $product->name }}" class="product-image">
                        @endif
                        @endif

                        <h5 class="card-title text-start flex-grow-1 product-name" data-full-name="{{ $product->name }}">
                            {{ $product->name }}
                        </h5>


                        <p class="card-text text-start flex-grow-1"><strong>السعر:</strong> DA {{ $product->price }}</p>

                        <div class="mt-auto">
                            @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm w-100 mb-2">
                                تعديل <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    حذف <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>




<script>
    function shortenProductNames() {
        if (window.innerWidth <= 576) { // فقط على الهواتف
            document.querySelectorAll('.product-name').forEach(el => {
                let fullName = el.getAttribute('data-full-name');
                let words = fullName.split(' ').slice(0, 4).join(' ') + '...';
                el.textContent = words;
            });
        } else { // على الشاشات الكبيرة، عرض الاسم بالكامل
            document.querySelectorAll('.product-name').forEach(el => {
                el.textContent = el.getAttribute('data-full-name');
            });
        }
    }

    // تشغيل الوظيفة عند تحميل الصفحة وعند تغيير الحجم
    window.addEventListener('load', shortenProductNames);
    window.addEventListener('resize', shortenProductNames);
</script>


<script>
    function saveInfoAndRedirect(loginUrl) {
        // الحصول على بيانات الفورم
        const form = event.target.closest('form');
        const formData = new FormData(form);

        // حفظ البيانات في LocalStorage
        localStorage.setItem('purchaseInfo', JSON.stringify({
            name: formData.get('name'),
            phone: formData.get('phone'),
            address: formData.get('address')
        }));

        // توجيه المستخدم إلى صفحة تسجيل الدخول
        window.location.href = loginUrl;
    }
</script>



@endsection