<?php
session_start();

// التحقق من وجود id في الـ URL
if (isset($_GET['id']) && isset($_SESSION['cartData'])) {
    $productId = $_GET['id'];
    
    // البحث عن العنصر في السلة باستخدام الـ id
    foreach ($_SESSION['cartData'] as $index => $item) {
        if ($item['id'] == $productId) {
            // حذف العنصر من السلة
            unset($_SESSION['cartData'][$index]);
            break; // إنهاء الحلقة بعد حذف العنصر
        }
    }
    
    // إعادة ترتيب الفهارس في السلة بعد الحذف
    $_SESSION['cartData'] = array_values($_SESSION['cartData']);
}

// إعادة التوجيه إلى نفس الصفحة لعرض التحديثات
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;