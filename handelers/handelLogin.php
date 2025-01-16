<?php
session_start();
include '../core/functions.php';
include '../core/validations.php';
$errors = [];

//check if the request is post method.
if (checkRequestMethod("POST") && checkPostInput("email")){
    
    //to clear the data
    foreach ($_POST as $key => $value){
        $$key = sanitizeInput($value);
    }
     //check of that we recieve right data.
    if (!requiredVal($email)){
        $errors[] = "email is required";
    }elseif (!emailVal($email)){
        $errors[] = "please enter a valid email";
    }

    if (!requiredVal($password)){
        $errors[] = "password is required";
    }


    //* يقوم بمعالجة تسجيل الدخول عن طريق مطابقة البيانات المدخلة مع البيانات المسجله في الملف*

    if (empty($errors)){ // في حالة انه مر بكل الشروط بدون اي اخطاء ف هيبتدي يفتح الملف و يقؤأ الداتا منه للتطابق
        $users_file = fopen("../data/users.csv", "r");
        $user_found = false; //متغير يساعد على تحديد اذا كان المستخدم موجود ام لا, يبدأ بقيمة خطأ و يتم تغييره اذا تم العثور عل المستخدم

        while (($user = fgetcsv($users_file)) !== false){ // لقراءة الصفوف و تخزين البيانات بداخل المتغير يوزر. و ليس خطأ تستخد لضمان استمرار حلقة القراءة اذا وجد اكثر من صف
            
            //لمطابقة البيانات المدخله مع بيانات الملف
            if ($email === $user[2] && sha1($password) === $user[3]) { //الارقام تدل على موقع المتغير داخل المصفوفه
                $user_found = true; // قيمة الخطأ في الكود السابق تتحول هنا لصحيحه اذا تم العثور على بيانات
                $_SESSION['auth'] = [$user[0], $user[1], $user[2]]; //تخزين البيانات في جلسة لتسجيل الدخول 
                                    //id      //name   //email
                if ($email === $user[2] && sha1($password) === $user[3]) {
    $user_found = true;
    $_SESSION['auth'] = [$user[0], $user[1], $user[2]]; // تخزين بيانات الجلسة
    
    // التحقق من وجود صفحة redirect
    if (isset($_SESSION['redirect_to'])) {
        $redirect_to = $_SESSION['redirect_to'];
        unset($_SESSION['redirect_to']); // حذف القيمة من الجلسة بعد استخدامها
        redirect("../$redirect_to");
    } else {
        redirect("../index.php");
    }
    die;
}
            }
        }
        fclose($users_file);
        
         // * يركز فقط على اضافة الخطأالى المصفوفه اذا لم يتم العثور على المستخدم* حفظ
        if (!$user_found) {
            $errors[] = "Invalid email or password";
        }
    }

    //* يتعامل مع تنفيذ الإجراءات المطلوبة عند وجود أخطاء * تنفيذ
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors; //حفظ الاخطاء في الجلسة
        redirect("../login.php"); //إعادة توجيه المستخدم
        die();  //إنهاء العملية
    }

}
    
    


