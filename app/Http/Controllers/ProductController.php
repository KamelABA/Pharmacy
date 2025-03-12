<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;



class ProductController extends Controller
{
    // Show the form to create a new product
    public function create()
    {
        return view('products.create');
    }

    // Handle the form submission and save the product to the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'type' => 'required|string|max:1000',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->type = $request->input('type');

        if ($request->hasFile('images')) {
            $imagePaths = [];
        
            foreach ($request->file('images') as $image) {
                // إنشاء اسم فريد للصورة
                $imageName = time() . '_' . $image->getClientOriginalName();
        
                // حفظ الصورة مباشرة في مجلد 'public/images'
                $image->move(public_path('images'), $imageName);
        
                // حفظ المسار في المصفوفة
                $imagePaths[] = 'images/' . $imageName; // حفظ فقط المسار النسبي
            }
        
            // حفظ المسارات في قاعدة البيانات بصيغة JSON
            $product->images = json_encode($imagePaths);
        }
        
        
        $product->save();
        
        return redirect()->route('products.products')->with('success', 'تم إنشاء المنتج بنجاح!');
    }        


    public function index(Request $request)
    {
        // البدء باستعلام عام
        $query = Product::query();

        // تحقق من وجود فلتر 'type' وتطبيق الفلترة إذا كان موجودًا
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // تنفيذ الاستعلام وجلب النتائج
        $products = $query->get();

        return view('products.products', compact('products'));
    }


    public function destroy($id)
{
    $product = Product::findOrFail($id);

    // التحقق من أن المنتج يحتوي على صور
    if ($product->images) {
        $images = json_decode($product->images, true);

        foreach ($images as $image) {
            $imagePath = storage_path("app/public/{$image}"); // تحديد مسار الصورة

            if (file_exists($imagePath)) {
                unlink($imagePath); // حذف الصورة من السيرفر
            }
        }
    }

    // حذف المنتج من قاعدة البيانات
    $product->delete();

    return redirect()->route('products.products')->with('success', 'Product deleted successfully!');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function destroyO($id)
{
    $order = Order::find($id);

    if (!$order) {
        return response()->json(['success' => false, 'message' => 'الطلب غير موجود.'], 404);
    }

    $order->delete();

    return response()->json(['success' => true, 'message' => 'تم حذف الطلب بنجاح.']);
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        // Handle Image Update (If Provided)
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // تحديد اسم الصورة مع وقت التحميل لتجنب التكرار
            $imageName = time() . '_' . $image->getClientOriginalName();

            // حفظ الصورة في مجلد 'public/images'
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // حفظ مسار الصورة في قاعدة البيانات
            $product->image = $imagePath;
        }


        $product->save();

        return redirect()->route('products.products')->with('success', 'Product updated successfully!');
    }




    

    public function buy(Request $request, $id)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'state' => 'required|string',
            'city' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);
    
        Log::info('قبل جلب المنتج', ['data' => $validated, 'product_id' => $id]);
    
        // البحث عن المنتج
        $product = Product::find($id);
    
        if (!$product) {
            Log::error("المنتج غير موجود", ['product_id' => $id]);
            return back()->with('error', 'المنتج غير موجود.');
        }
    
        Log::info('تم العثور على المنتج', ['product' => $product]);
    
        // التحقق من الكمية المتاحة
        if ($validated['quantity'] > $product->quantity) {
            Log::warning('الكمية المطلوبة غير متوفرة', [
                'requested_quantity' => $validated['quantity'],
                'available_quantity' => $product->quantity
            ]);
            return back()->with('error', 'الكمية المطلوبة غير متوفرة.');
        }
    
        // تحديد مستخدم عشوائي في حال لم يكن المستخدم مسجلاً
        $randomUserId = auth()->id() ?? User::inRandomOrder()->first()->id ?? null;
    
        if (!$randomUserId) {
            Log::error('لم يتم العثور على مستخدم لإنشاء الطلب');
            return back()->with('error', 'حدث خطأ في إنشاء الطلب، يرجى المحاولة لاحقًا.');
        }
    
        // إنشاء الطلب بدون خصم الكمية الآن
        try {
            $order = Order::create([
                'user_id' => $randomUserId,
                'product_id' => $product->id,
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'state' => $validated['state'],
                'city' => $validated['city'],
                'quantity' => $validated['quantity'],
                'total_price' => ($product->price * $validated['quantity']) + 800, // إضافة تكاليف الشحن
                'status' => 'قيد المعالجة', // لم يتم تأكيد الطلب بعد
            ]);
    
            Log::info('تم إنشاء الطلب بنجاح', ['order' => $order]);
    
            return redirect()->route('products.details', ['id' => $product->id])
                ->with('success', 'تم تقديم الطلب بنجاح، سيتم معالجته قريبًا.');
        } catch (\Exception $e) {
            Log::error('خطأ أثناء إنشاء الطلب', ['error' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء معالجة الطلب.');
        }
    }
    



    





    public function orders()
    {
        // ✅ التحقق من أن المستخدم مسجل دخول وأنه مشرف
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك بدخول هذه الصفحة.');
        }

        $orders = Order::latest()->get();
        return view('products.orders', compact('orders'));
    }



    public function show($id)
    {
        
        $product = Product::findOrFail($id);


        return view('products.Pdetail', compact('product'));
    }


public function homePage()
{
    $products = Product::latest()->take(4)->get(); // جلب آخر 4 منتجات
    return view('welcome', compact('products'));
}

public function search(Request $request)
{
    $query = Product::query();

    // البحث عن المنتجات بأي كلمة في الاسم أو الوصف
    if ($request->has('search') && $request->search != '') {
        $searchWords = explode(' ', $request->search); // تقسيم الكلمات
        foreach ($searchWords as $word) {
            $query->where(function ($q) use ($word) {
                $q->where('name', 'LIKE', '%' . $word . '%')
                  ->orWhere('description', 'LIKE', '%' . $word . '%');
            });
        }
    }

    // تصفية حسب الفئة (category)
    if ($request->has('category') && $request->category != '') {
        $query->where('type', $request->category);
    }

    $products = $query->latest()->paginate(12);

    return view('products.products', compact('products'));
}


public function approve($id)
{
    $order = Order::findOrFail($id);
    
    // جلب المنتج المرتبط بالطلب
    $product = Product::find($order->product_id);
    
    // خصم الكمية من المنتج
    if ($product && $product->quantity >= $order->quantity) {
        $product->decrement('quantity', $order->quantity);
    }

    // حذف الطلب من قاعدة البيانات بعد الموافقة عليه
    $order->delete();

    return response()->json(['success' => true, 'message' => 'تمت الموافقة على الطلب وحذفه من النظام.']);
}



}
