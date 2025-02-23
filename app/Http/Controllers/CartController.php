<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // إضافة منتج إلى السلة
    public function addToCart(Request $request, $id)
{
    $product = Product::find($id);
    
    if (!$product) {
        return redirect()->back()->with('error', 'المنتج غير موجود.');
    }

    // فك ترميز الصور من JSON إلى مصفوفة
    $images = json_decode($product->images, true);
    $firstImage = !empty($images) ? $images[0] : 'default.jpg'; // استخدام أول صورة أو صورة افتراضية

    // اجلب بيانات السلة من الجلسة أو قم بإنشاء مصفوفة جديدة
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += 1;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $firstImage, // حفظ أول صورة فقط
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة!');
}



    

    

    // عرض السلة
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // إزالة منتج من السلة
    public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return back()->with('success', 'تمت إزالة المنتج من السلة');
}

    
    
}
