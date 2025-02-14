@extends('layouts.app')

@section('title', 'PharmAK - Contact Us')


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg p-4 rounded-4">
                <h2 class="text-center text-success mb-3">📞 تواصل معنا</h2>
                <p class="text-center text-muted">نحن هنا للمساعدة، لا تتردد في إرسال رسالتك!</p>

                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" id="name" class="form-control" required placeholder="أدخل اسمك">
                        </div>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="example@email.com">
                        </div>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">رسالتك</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required placeholder="اكتب رسالتك هنا..."></textarea>
                        @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100">إرسال الرسالة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
