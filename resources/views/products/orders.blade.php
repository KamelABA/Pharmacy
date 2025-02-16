@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">📦 طلبات الشراء</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="bg-success text-white">
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>الولايةوالبلدية</th>
                    <th>المنتج</th>
                    <th>الكمية</th>
                    <th>السعر الإجمالي</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->state }},{{ $order->city}}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_price }} دج</td>
                    <td><span class="badge bg-warning">{{ $order->status }}</span></td>
                    <td>
    <button class="btn btn-sm btn-primary" onclick="approveOrder({{ $order->id }})">موافقة</button>
    <button class="btn btn-sm btn-danger" onclick="deleteOrder({{ $order->id }})">إلغاء</button>
</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<script>

function approveOrder(orderId) {
    if (confirm("هل تريد تأكيد هذا الطلب؟")) {
        fetch(`/orders/${orderId}/approve`, {
            method: "PUT",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("تمت الموافقة على الطلب بنجاح!");
                location.reload();
            } else {
                alert("حدث خطأ أثناء الموافقة على الطلب.");
            }
        })
        .catch(error => console.error("Error:", error));
    }
}
    function deleteOrder(orderId) {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

        if (!csrfTokenMeta) {
            alert("خطأ: لم يتم العثور على CSRF Token في الصفحة!");
            return;
        }

        const csrfToken = csrfTokenMeta.getAttribute("content");

        if (confirm("هل أنت متأكد أنك تريد إلغاء هذا الطلب؟")) {
            fetch(`/orders/${orderId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("تم إلغاء الطلب بنجاح!");
                    location.reload(); // تحديث الصفحة بعد الحذف
                } else {
                    alert("حدث خطأ أثناء إلغاء الطلب.");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }
</script>




@endsection
