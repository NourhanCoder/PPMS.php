<?php
// هستخدم هنا اكواد عامه بحيث نتفادى تكرار الاكواد
// to validate form submission methods (POST or GET)
function checkRequestMethod($method){
    if($_SERVER['REQUEST_METHOD'] == $method){
        return true;
    }

    return false;
}

// to check about the input that we will recieve from any form
function checkPostInput($input){
    if(isset($_POST[$input])){
        return true;
    }

    return false;
}

//for filtration the inputs
function sanitizeInput($input){
    return trim(htmlspecialchars(htmlentities($input)));
}


function redirect($path){
    header("location:$path");
}