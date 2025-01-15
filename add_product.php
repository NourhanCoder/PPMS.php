<?php
$title = "Add Product";
include('inc/header.php'); ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Add New Product</h1>
            <p class="lead">Easily add products to your electronic store</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Add New Product</h2>
        <?php
        // عرض رسالة نجاح أو خطأ
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            unset($_SESSION['errors']);
        }
        ?>
        <form action="handelers/handle_add_product.php" method="POST" class="needs-validation" novalidate>

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
                <div class="invalid-feedback">Please provide the Product Name.</div>
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                <div class="invalid-feedback">Please provide a valid Product Price.</div>
            </div>

            <div class="mb-3">
                <label for="product_photo" class="form-label">Product Photo (URL)</label>
                <input type="url" class="form-control" id="photo" name="photo" required>
                <div class="invalid-feedback">Please provide a valid URL for the Product Photo.</div>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</section>

<?php include('inc/footer.php');
