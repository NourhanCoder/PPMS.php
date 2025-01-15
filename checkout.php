<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = "CheckOut";
include('inc/header.php'); ?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
            <p class="lead">Complete your purchase by filling out the necessary details below</p>
        </div>
    </div>
</header>
<?php
// تحقق إذا كانت بيانات الكارت موجودة
if (!isset($_SESSION['cartData']) || empty($_SESSION['cartData'])) {
    echo "<h2>Your cart is empty. <a href='cart.php'>Go back to cart</a></h2>";
    exit;
}

// جلب بيانات الكارت
$cartData = $_SESSION['cartData'];
?>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-4">
                <div class="border p-2">
                    <div class="products">
                        <ul class="list-unstyled">
                            <?php
                            if (isset($_SESSION['cartData']) && !empty($_SESSION['cartData'])):
                                $cart = $_SESSION['cartData'];
                                foreach ($cart as $index => $item):
                                    $totalPrice = $item['price'] * $item['quantity'];
                            ?>
                                    <li class="border p-2 my-1">
                                        <?= $item['name']; ?> - 
                                        <span class="text-success mx-2 mr-auto bold"><?= $item['quantity']; ?> x $<?= $item['price']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="border p-2 my-1">Your cart is empty</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <h3>Total:
                        <?php
                        $totalPrice = 0;
                        if (isset($_SESSION['cartData']) && !empty($_SESSION['cartData'])):
                            foreach ($cart as $item):
                                $totalPrice += $item['price'] * $item['quantity'];
                            endforeach;
                        endif;
                        ?>
                        $<?= $totalPrice; ?>
                    </h3>
                </div>
            </div>
            <div class="col-8">
                <?php
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']); // حذف الرسالة بعد عرضها
                }
                ?>

                <?php
                if (isset($_SESSION['errors'])):
                    foreach ($_SESSION['errors'] as $error):
                ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $error; ?>
                        </div>
                <?php
                    endforeach;
                    unset($_SESSION['errors']);
                endif;
                ?>

                <form action="handelers/handelCheckout.php" method="POST" class="form border my-2 p-3">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" id="notes" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Send" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div> <!-- End of col-8 -->
        </div> <!-- End of row -->
    </div> <!-- End of container -->
</section> <!-- End of section -->
<?php include('inc/footer.php'); ?>