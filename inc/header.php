<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= isset($title) ? $title : null ?> </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <!-- Navigation-->



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">EraaSoft PMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <?php // لو السيشن موحوده هيعرضها
                    if (isset($_SESSION['auth'])): ?>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="add_product.php">Add Product</a></li>
                    <?php //لو مش موجوده مش هيعرضم
                    endif; ?>
                    <?php // في حالة انه ملاقاش السيشن و ده معناه ان لسه متمش تسجيل ف هيعرضهم
                    if (!isset($_SESSION['auth'])): ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php //لو السيشن موجوده مش هيعرضهم
                    endif; ?>
                </ul>
                <?php // لو السيشن موحوده هيعرضها
                if (isset($_SESSION['auth'])): ?>

<?php
            // Check if the session cartData is set, if not initialize it as an empty array
            if (!isset($_SESSION['cartData']) || !is_array($_SESSION['cartData'])) {
                $_SESSION['cartData'] = []; // Initialize as an empty array if not set
            }
            $countProduct = 0;
            foreach ($_SESSION['cartData'] as $item) {
                $countProduct += $item['quantity'];
            }
            ?>
                    <form class="d-flex" action="cart.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $countProduct ?></span>

                        </button>
                        <ul>

                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        </ul>
                    <?php //لو مش موجوده مش هيعرضم
                endif; ?>

                    </form>
            </div>
        </div>
    </nav>