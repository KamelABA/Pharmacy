function updateDeliveryFee{{ $product->id }}() {
    console.log("how")
    var state = document.getElementById('state{{ $product->id }}').value;
    var deliveryFee = 200;

if (state === '01: أدرار') {
    deliveryFee = 900;
 } else if (state === '02: الشلف') {
    deliveryFee = 900;
 } else if (state === '03: الأغواط') {
    deliveryFee = 1000;
 } else if (state === '04: أم البواقي') {
    deliveryFee = 900;
 } else if (state === '05: باتنة') {
    deliveryFee = 900;
 } else if (state === '06: بجاية') {
    deliveryFee = 900;
 } else if (state === '07: بسكرة') {
    deliveryFee = 900;
 } else if (state === '08: بشار') {
    deliveryFee = 900;
 } else if (state === '09: البليدة') {
    deliveryFee = 900;
 } else if (state === '10: البويرة') {
    deliveryFee = 900;
 } else if (state === '11: تمنراست') {
    deliveryFee = 1800;
 } else if (state === '12: تبسة') {
     deliveryFee = 1000;
 } else if (state === '13: تلمسان') {
    deliveryFee = 900;
 } else if (state === '14: تيارت') {
    deliveryFee = 200;
 } else if (state === '15: تيزي وزو') {
    deliveryFee = 900;
 } else if (state === '16: الجزائر') {
    deliveryFee = 900;
 } else if (state === '17: الجلفة') {
    deliveryFee = 1000;
 } else if (state === '18: جيجل') {
    deliveryFee = 900;
 } else if (state === '19: سطيف') {
    deliveryFee = 900;
 } else if (state === '20: سعيدة') {
    deliveryFee = 900;
 } else if (state === '21: سكيكدة') {
    deliveryFee = 900;
 } else if (state === '22: سيدي بلعباس') {
    deliveryFee = 900;
 } else if (state === '23: عنابة') {
    deliveryFee = 900;
 } else if (state === '24: قالمة') {
    deliveryFee = 900;
 } else if (state === '25: قسنطينة') {
    deliveryFee = 900;
 } else if (state === '26: المدية') {
    deliveryFee = 900;
 } else if (state === '27: مستغانم') {
    deliveryFee = 900;
 } else if (state === '28: المسيلة') {
    deliveryFee = 900;
 } else if (state === '29: معسكر') {
    deliveryFee = 900;
 } else if (state === '30: ورقلة') {
    deliveryFee = 1500;
 } else if (state === '31: وهران') {
    deliveryFee = 900;
 } else if (state === '32: البيض') {
    deliveryFee = 1200;
 } else if (state === '33: إليزي') {
    deliveryFee = 1800;
 } else if (state === '34: برج بوعريريج') {
    deliveryFee = 900;
 } else if (state === '35: بومرداس') {
    deliveryFee = 900;
 } else if (state === '36: الطارف') {
    deliveryFee = 900;
 } else if (state === '37: تندوف') {
    deliveryFee = 1800;
 } else if (state === '38: تيسمسيلت') {
    deliveryFee = 900;
 } else if (state === '39: الوادي') {
    deliveryFee = 1500;
 } else if (state === '40: خنشلة') {
    deliveryFee = 900;
 } else if (state === '41: سوق أهراس') {
    deliveryFee = 900;
 } else if (state === '42: تيبازة') {
    deliveryFee = 900;
 } else if (state === '43: ميلة') {
    deliveryFee = 900;
 } else if (state === '44: عين الدفلى') {
    deliveryFee = 900;
 } else if (state === '45: النعامة') {
    deliveryFee = 1200;
 } else if (state === '46: عين تموشنت') {
    deliveryFee = 900;
 } else if (state === '47: غرداية') {
    deliveryFee = 1500;
 } else if (state === '48: غليزان') {
    deliveryFee = 900;
 } else if (state === '49: تميمون') {
    deliveryFee = 1500;
 } else if (state === '50: برج باجي مختار') {
    deliveryFee = 1800;
 } else if (state === '51: أولاد جلال') {
    deliveryFee = 1200;
 } else if (state === '52: بني عباس') {
    deliveryFee = 1500;
 } else if (state === '53: إن صالح') {
    deliveryFee = 1800;
 } else if (state === '54: إن قزام') {
    deliveryFee = 2000;
 } else if (state === '55: توقرت') {
    deliveryFee = 1500;
 } else if (state === '56: جانت') {
    deliveryFee = 2000;
 } else if (state === '57: المغير') {
    deliveryFee = 1500;
 } else if (state === '58: المنيعة') {
    deliveryFee = 1800;
 }
 else
 {
    deliveryFee = 0; // قيمة افتراضية في حالة عدم العثور على الولاية
}

    // عرض الرسوم الجديدة
    document.getElementById('deliveryFee{{ $product->id }}').innerText = deliveryFee + " دج";
 }


 function calculateTotal{{ $product->id }}() {
    // تحديث رسوم التوصيل قبل الحساب
    updateDeliveryFee{{ $product->id }}();

    let quantity = document.getElementById('quantity{{ $product->id }}').value;
    let availableQuantity = {{ $product->quantity }};
    let price = {{ $product->price }} * quantity;

    // الحصول على قيمة التوصيل مباشرة من العنصر HTML
    let deliveryFeeText = document.getElementById('deliveryFee{{ $product->id }}').innerText;
    let deliveryFee = parseInt(deliveryFeeText.replace(" دج", "").trim()) || 0;

    // حساب المبلغ الإجمالي
    let totalAmount = price + deliveryFee;

    document.getElementById('productAmount{{ $product->id }}').innerText = price + " دج";
    document.getElementById('totalAmount{{ $product->id }}').innerText = totalAmount + " دج";

    // التحقق من الكمية
    if (quantity > availableQuantity) {
        document.getElementById('quantityWarning{{ $product->id }}').style.display = 'block';
    } else {
        document.getElementById('quantityWarning{{ $product->id }}').style.display = 'none';
    }
 }


 function checkForm{{ $product->id }}() {
    let name = document.getElementById('name{{ $product->id }}').value;
    let phone = document.getElementById('phone{{ $product->id }}').value;
    let state = document.getElementById('state{{ $product->id }}').value;
    let city = document.getElementById('city{{ $product->id }}').value;
    let quantity = document.getElementById('quantity{{ $product->id }}').value;

    let isQuantityValid = quantity <= {{ $product->quantity }}; // Check if quantity is valid

    if (name && phone && state && city && quantity && isQuantityValid) {
        document.getElementById('completePurchaseBtn{{ $product->id }}').disabled = false;
    } else {
        document.getElementById('completePurchaseBtn{{ $product->id }}').disabled = true;
    }

    // Disable buttons if quantity is invalid
    if (!isQuantityValid) {
        document.getElementById('completePurchaseBtn{{ $product->id }}').disabled = true;
    }
 }