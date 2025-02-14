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
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-funnel me-1"></i>
                    {{ request('type') ? request('type') : 'All Products' }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('products.products') }}">All Products</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Cream']) }}">Cream</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Shampoing']) }}">Shampoing</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Gel']) }}">Gel</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Savon']) }}">Savon</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Huile']) }}">Huile</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Eau de Cologne']) }}">Eau de Cologne</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Après-shampoing']) }}">Après-shampoing</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Dentifrice']) }}">Dentifrice</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Solution']) }}">Solution</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Baume']) }}">Baume</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Fluide']) }}">Fluide</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Pain surgras']) }}">Pain surgras</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Lotion']) }}">Lotion</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.products', ['type' => 'Lait']) }}">Lait</a></li>
                </ul>

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
                <div class="card shadow-lg p-3 bg-white rounded h-100 hover-secondary">
                    <div class="card-body text-center d-flex flex-column">
                        @if(isset($product) && $product->images)
                        @php
                        $images = json_decode($product->images, true);
                        $firstImage = $images[0] ?? null;
                        @endphp

                        @if($firstImage)
                        <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="img-fluid mb-3 border" style="max-height: 150px;">
                        @endif
                        @endif
                        <h5 class="card-title text-start">{{ $product->name }}</h5>
                        <p class="card-text text-start"><strong>السعر:</strong> DA {{ $product->price }}</p>


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
                            @else
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
    $(document).ready(function() {
        // Handle the Buy button click
        $('.buy-form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var productId = form.closest('.col-md-4').attr('id').split('-')[2]; // Get product ID
            var quantityElement = $('#quantity-' + productId);

            // Send AJAX request to buy the product
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Update the quantity in the product card
                    var currentQuantity = parseInt(quantityElement.text());
                    if (currentQuantity > 0) {
                        quantityElement.text(currentQuantity - 1);
                    }

                    // If the quantity becomes 0, show an out-of-stock message
                    if (currentQuantity - 1 === 0) {
                        alert('Product is out of stock!');
                    }
                },
                error: function() {
                    alert('An error occurred while processing your purchase. Please try again.');
                }
            });
        });
    });
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