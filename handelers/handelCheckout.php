<?php
session_start();
include ('../core/functions.php');
include ('../core/validations.php');
$errors = [];

if (checkRequestMethod("POST") && checkPostInput("name")){

    foreach ($_POST as $key => $value){
        $$key = sanitizeInput($value);
    }

    if (!requiredVal($name)){
        $errors[] = "name is required";
    }elseif (!minVal($name, 3)){
        $errors[] = "name must be more than 3 chars";
    }elseif (!maxVal($name, 25)){
        $errors[] = "name must be less than 25 chars";
    }

    if (!requiredVal($email)){
        $errors[] = "email is required";
    }elseif (!emailVal($email)){
        $errors[] = "please enter a valid email";   
    }

    if (!requiredVal($address)) {
        $errors[] = "Address is required";
    } elseif (!minVal($address, 10)) {
        $errors[] = "Address must be more than 10 chars";
    } elseif (!maxVal($address, 150)) {
        $errors[] = "Address must be less than 150 chars";
    }

    if (!requiredVal($phone)) {
        $errors[] = "Phone number is required";
    } elseif (!numericVal($phone)) {
        $errors[] = "Phone number must contain only numbers";
    } elseif (!minVal($phone, 10)) {
        $errors[] = "Phone number must be at least 10 digits";
    } elseif (!maxVal($phone, 15)) {
        $errors[] = "Phone number must be less than 15 digits";
    }

    if (!requiredVal($notes)) {
        $errors[] = "Notes  is required";
    }elseif  (!minVal($notes, 5)){
        $errors[] = "Notes must be more than 5 chars";
    }elseif (!maxVal($notes, 50)){
        $errors[] = "Notes must be less than 50 chars";

    }



    if (empty($errors)){
        $check_file = fopen("../data/checkout.csv", "a+");
        $check_data = [$name,$email,$address,$phone,$notes];
        fputcsv($check_file, $check_data);
        fclose($check_file);

        $_SESSION['success'] = "Order received successfully!";
        redirect("../checkout.php");
        die();
    }else {
        $_SESSION['errors'] = $errors;
        redirect("../checkout.php");
        die;

    }

}