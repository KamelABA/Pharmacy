@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ isset($product) ? 'Edit Product' : 'Add a New Product' }}</h1>

    <!-- Display success message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Product Form -->
    <form method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
        @method('PUT')
        @endif

        <!-- Product Name -->
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ isset($product) ? $product->name : old('name') }}" required>
        </div>

        <!-- Product Quantity -->
        <div class="form-group">
            <label for="quantity">Product Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1"
                value="{{ isset($product) ? $product->quantity : old('quantity') }}">
        </div>

        <!-- Product Type -->
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="Cream" {{ isset($product) && $product->type == 'Cream' ? 'selected' : '' }}>Cream</option>
                <option value="Shampoing" {{ isset($product) && $product->type == 'Shampoing' ? 'selected' : '' }}>Shampoing</option>
                <option value="Gel" {{ isset($product) && $product->type == 'Gel' ? 'selected' : '' }}>Gel</option>
                <option value="Savon" {{ isset($product) && $product->type == 'Savon' ? 'selected' : '' }}>Savon</option>
                <option value="Huile" {{ isset($product) && $product->type == 'Huile' ? 'selected' : '' }}>Huile</option>
                <option value="Eau de Cologne" {{ isset($product) && $product->type == 'Eau de Cologne' ? 'selected' : '' }}>Eau de Cologne</option>
                <option value="Après-shampoing" {{ isset($product) && $product->type == 'Après-shampoing' ? 'selected' : '' }}>Après-shampoing</option>
                <option value="Dentifrice" {{ isset($product) && $product->type == 'Dentifrice' ? 'selected' : '' }}>Dentifrice</option>
                <option value="Solution" {{ isset($product) && $product->type == 'Solution' ? 'selected' : '' }}>Solution</option>
                <option value="Baume" {{ isset($product) && $product->type == 'Baume' ? 'selected' : '' }}>Baume</option>
                <option value="Fluide" {{ isset($product) && $product->type == 'Fluide' ? 'selected' : '' }}>Fluide</option>
                <option value="Pain surgras" {{ isset($product) && $product->type == 'Pain surgras' ? 'selected' : '' }}>Pain surgras</option>
                <option value="Lotion" {{ isset($product) && $product->type == 'Lotion' ? 'selected' : '' }}>Lotion</option>
                <option value="Lait" {{ isset($product) && $product->type == 'Lait' ? 'selected' : '' }}>Lait</option>
            </select>

        </div>

        <!-- Product Description -->
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ isset($product) ? $product->description : old('description') }}</textarea>
        </div>

        <!-- Product Price -->
        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="number" name="price" id="price" class="form-control" required
                value="{{ isset($product) ? $product->price : old('price') }}">
        </div>

        <!-- Product Image -->
        <div class="form-group">
            <label for="images">صور المنتج</label>
            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple {{ isset($product) ? '' : 'required' }}>

            @if(isset($product) && $product->images)
            <div class="mt-2 d-flex flex-wrap">
                @foreach(json_decode($product->images, true) as $image)
                <div class="me-2">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="img-fluid rounded border" style="max-height: 150px;">
                </div>
                @endforeach
            </div>
            @endif
        </div>


        <button type="submit" class="btn btn-primary">
            {{ isset($product) ? 'Update Product' : 'Create Product' }}
        </button>
    </form>

</div>
@endsection