<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}
unset($_SESSION['cartData']);
echo"<pre>";
print_r($_SESSION['cartData']);
echo"<pre>";

