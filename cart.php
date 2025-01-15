<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

$title = 'Add to Cart'; 

// Include header
include('inc/header.php'); 
?>

<!-- Header -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Your Shopping Cart</h1>
            <p class="lead">Review your products before proceeding to checkout</p>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (isset($_SESSION['cartData'])):
                            $summisionofAllPricess = 0; // Total price of all items in the cart
                            $cart = $_SESSION['cartData'];
                            foreach ($cart as $index => $item):
                                $totalPrice = $item['price'] * $item['quantity'];
                                $summisionofAllPricess += $totalPrice;
                        ?>
                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= $item['name']; ?> </td>
                            <td>$<?= $item['price']; ?></td>
                            <td>
                                <input type="number" value="<?= $item['quantity']; ?>" min="1">
                            </td>
                            <td>$<?= $totalPrice; ?></td>
                            <td>
                            <a href="handelers/handelDelete.php?id=<?php echo htmlspecialchars(trim($item['id'])); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <tr>
                            <td colspan="4" class="text-right">
                                <strong>Total Price</strong>
                            </td>
                            <td colspan="2">
                                <h3>$<?= $summisionofAllPricess; ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <a href="checkout.php" class="btn btn-primary">Checkout</a>
                            </td>
                        </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php 
// Include footer
include('inc/footer.php'); 
?>
