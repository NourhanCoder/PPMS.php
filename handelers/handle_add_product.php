<?php
session_start();
include('../core/functions.php');
include('../core/validations.php');
$errors = [];

// التحقق من الطلب وطريقة الإرسال
if (checkRequestMethod("POST") && checkPostInput("product_name")) {

    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value); // تنظيف البيانات المُدخلة
    }


    // التحقق من الحقل "name"
    if (!requiredVal($product_name)) {
        $errors[] = "Product name is required";
    } elseif (!minVal($product_name, 3)) {
        $errors[] = "Product name must be more than 3 characters";
    } elseif (!maxVal($product_name, 50)) {
        $errors[] = "Product name must be less than 50 characters";
    }

    // التحقق من الحقل "price"
    if (!requiredVal($price)) {
        $errors[] = "Price is required";
    } elseif (!numericVal($price) || $price <= 0) {
        $errors[] = "Price must be a positive number";
    }

    // التحقق من الحقل "photo"
    if (!requiredVal($photo)) {
        $errors[] = "Photo link is required";
    } elseif (!urlVal($photo)) {
        $errors[] = "Please enter a valid URL for the photo";
    }

    // إذا لم تكن هناك أخطاء
    if (empty($errors)) {
        $last_id = 0;
        $is_empty = true;
        $products_file = fopen("../data/products.csv", "r");
        
        while (($product = fgetcsv($products_file)) !== false){
            $last_id = $product[0];
        }
        fclose($products_file);

        $id = $last_id + 1;
       

        // فتح ملف CSV وتخزين البيانات
        $products_file = fopen("../data/products.csv", "a+");
        
        $product_data = [$id, $product_name, $price, $photo];
        fputcsv($products_file, $product_data);
        fclose($products_file);

        // رسالة نجاح وتوجيه إلى صفحة الإضافة
        $_SESSION['success'] = "Product added successfully!";
        redirect("../add_product.php");
        die();
    } else {
        // تخزين الأخطاء في الجلسة وإعادة التوجيه
        $_SESSION['errors'] = $errors;
        redirect("../add_product.php");
        die();
    }
}