<?php
// هنستخدم هنا الاكواد الخاصه بالتحقق من المدخلات  لتفدي تكرار اكواد الايرور

//   لو الحقل فاضي هيرجع خطأ لو مش فاضي و المدخلات صح هيسجل
function requiredVal($input){
    if(empty($input)){
        return false;
    }
    return true;
}

// التحقق من الحد الأدنى للطول
function minVal($input, $lenght){
    if(strlen($input) < $lenght){
        return false;
    }
    return true;
}

// التحقق من الحد الأقصى للطول
function maxVal($input, $lenght){
    if(strlen($input) > $lenght){
        return false;
    }
    return true;
}

// التحقق من صحة البريد الإلكتروني
function emailVal($email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true;
}


// التحقق من أن المدخل عبارة عن رقم
function numericVal($input){
    if(!is_numeric($input)){
        return false;
    }
    return true;
}

// التحقق من صحة الرابط (URL)
function urlVal($url){
    if(!filter_var($url, FILTER_VALIDATE_URL)){
        return false;
    }
    return true;
}