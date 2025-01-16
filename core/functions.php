<?php
// هستخدم هنا دوال بحيث نتفادى تكرار الاكواد

//التحقق من نوع طلب المستخدم (POST أو GET)
function checkRequestMethod($method){
    if($_SERVER['REQUEST_METHOD'] == $method){
        return true;
    }

    return false;
}

// التحقق مما إذا كانت قيمة معينة مرسلة عبر POST موجودة أم لا
function checkPostInput($input){
    if(isset($_POST[$input])){
        return true;
    }

    return false;
}

//تنظيف وإزالة أي رموز خطرة أو فراغات زائدة من المدخلات
function sanitizeInput($input){
    return trim(htmlspecialchars(htmlentities($input)));
}

//إعادة توجيه المستخدم إلى صفحة أو رابط معين
function redirect($path){
    header("location:$path");
}