<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {

    $id = $_GET['id'];

    // Initialize product data variables
    $name = '';
    $price = '';

    // Open the product CSV file and find the product details
    $file = fopen("../data/products.csv", 'r');
    while ($res = fgets($file)) {
        $rowdata = explode(",", $res);
        if ($id === $rowdata[0]) {
            $name = $rowdata[1];
            $price = $rowdata[2];
            break; // Exit the loop once the product is found
        }
    }
    fclose($file); // Close the file after reading

    // Prepare product data
    $product = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'quantity' => 1 // Initial quantity set to 1
    ];

    // Check if the cart session exists and is an array
    if (isset($_SESSION['cartData']) && is_array($_SESSION['cartData'])) {
        $cart = $_SESSION['cartData'];
        $found = false;

        // Check if the product is already in the cart
        foreach ($cart as $index => $item) {
            if ($item['id'] === $id) {
                // If the product is found, increase the quantity
                $cart[$index]['quantity'] += 1;
                $found = true;
                break;
            }
        }

        // If the product was not found, add it to the cart
        if (!$found) {
            $cart[] = $product;
        }

        // Update the session with the new cart
        $_SESSION['cartData'] = $cart;
    } else {
        // If the cart doesn't exist, create a new one with the product
        $_SESSION['cartData'] = [$product];
    }
    // unset($_SESSION["cartData"]);
     
    // Redirect to the index page after updating the cart
    header("location: ../index.php");
    exit;
}
?>
