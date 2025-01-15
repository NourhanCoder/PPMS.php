<?php
session_start(); //لحماية بيانات المستخدم من الظهور في العنوان و لتخزين البيانات
include '../core/functions.php';
include '../core/validations.php';
$errors = []; //لتخزين الاخطاء فيها لما المستخدم ميتبعش القواعد فتبتدي تظهرله
 
//للتحقق من الطريقه اللى جايه من الفورم و التحقق ايضا من اول مدخل فيه اللى هو الاسم
if (checkRequestMethod("POST") && checkPostInput('name')) {

    foreach ($_POST as $key => $value) {
        //حولناه لمتغير لتفادي تكرار الاكواد علشان نفلتر القيم المستلمه من الفورم
        $$key = sanitizeInput($value); 
    }
     // شروط التحقق من القيم المستلمه من الفورم

    if (!requiredVal($name)) {
        $errors[] = "name is required";
    } elseif (!minVal($name, 3)) {
        $errors[] = "name must be more than 3 chars";
    } elseif (!maxVal($name, 25)) {
        $errors[] = "name must be less than 25 chars";
    }


    if (!requiredVal($email)) {
        $errors[] = "email is required";
    } elseif (!emailVal($email)) {
        $errors[] = "please entire a valid email";
    }


    if (!requiredVal($password)) {
        $errors[] = "password is required";
    } elseif (!minVal($password, 6)) {
        $errors[] = "password must be more than 6 chars";
    } elseif (!maxVal($password, 15)) {
        $errors[] = "password must be less than 15 chars";
    }


    

      // لو مفيش اخطاء ف هيبتدي يدخل ع الفايل و يسجل جواه البيانات 
    if (empty($errors)) {
        $last_id = 0;
        $users_file = fopen("../data/users.csv", "r");
        
        while (($user = fgetcsv($users_file)) !== false){
            $last_id = $user[0];
        }
        fclose($users_file);
        $id = $last_id + 1;

        $users_file = fopen("../data/users.csv", "a+");
        $data = [$id,$name,$email,sha1($password)];
        fputcsv($users_file,$data);
        fclose($users_file);
        
        $_SESSION['auth'] = [$id,$name,$email]; //بتظهر فقط في حالة الدخول او التسجيل " لتخزين البيانات للتحقق لاحقا من بيانات المستخدم عند التسجيل "
        redirect("../index.php"); // للدخول على الصفحة في حالة ان التسجيل تم بنجاح
        die();
    } else { 
        $_SESSION['errors'] = $errors; //لعرض الاخطاء لان وظيفة سيشن تخزين بيانات
       redirect("../register.php"); // لو البيانات غلط هيرجع على صفحة التسجيل تاني
        die;
    }
}
