@extends('layouts.app')

@section('title', 'Pharm - Login')

@section('styles')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="d-flex flex-column justify-content-center align-items-center" style="height: 70vh;">
    <!-- عنوان الترحيب -->
    <h2 class="text-center text-success mb-3 mt-5">
        <span class="fs-2">🏥</span> Pharm! مرحبًا بك في
    </h2>
    <p class="text-center text-muted mb-4">يرجى تسجيل الدخول للمتابعة</p>

    <div class="card shadow-lg p-4 rounded-4" style="max-width: 400px; width: 100%;">
        <div class="card-body">
            <!-- رسالة خطأ عامة -->
            @if ($errors->any())
            <div class="alert alert-danger text-center">
                <strong>يرجى التحقق من الأخطاء أدناه</strong>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- حقل البريد الإلكتروني -->
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="example@email.com">
                    </div>
                    @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <!-- حقل كلمة المرور -->
                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                    </div>
                    @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                    @endif
                </div>

                <!-- زر تسجيل الدخول -->
                <button type="submit" class="btn btn-success w-100">تسجيل الدخول</button>
            </form>

            <!-- رابط التسجيل -->
            <div class="text-center mt-3">
                <p class="mb-0">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-secondary">إنشاء حساب جديد</a></p>
            </div>
        </div>
    </div>
</div>


@endsection