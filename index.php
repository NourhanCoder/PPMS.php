<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
$title = "HomePage"; 

// Include the header file
include('inc/header.php'); 
?>

<!-- Header Section -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Discover Our Best Products</h1>
            <p class="lead fw-normal text-white-50 mb-0">Shop the latest and greatest at unbeatable prices</p>
        </div>
    </div>
</header>

<?php

// Read product data from the CSV file
$products = [];
if (($handle = fopen("data/products.csv", "r")) !== false) {
    fgetcsv($handle); // Skip the header row
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        if (count($data) >= 4) { // Ensure required data exists
            $products[] = $data;
        }
    }
    fclose($handle);
}
?>

<!-- Products Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100" style="width: 18rem;">
                            <!-- Product Image -->
                            <?php $image = htmlspecialchars($product[3]); ?>
                            <img class="card-img-top" src="<?= filter_var($image, FILTER_VALIDATE_URL) ? $image : 'default-image.jpg' ?>" alt="Product Image" style="height: 200px; object-fit: cover;">
                            
                            <!-- Product Details -->
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product[1]) ?></h5>
                                <p class="card-text">Price: $<?= number_format(floatval($product[2]), 2) ?></p>
                            </div>
                            
                            <!-- Add to Cart Button -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="handelers/addToCard.php?id=<?php echo $product[0]; ?>">Add to cart</a>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php 
// Include the footer file
include('inc/footer.php'); 
?>
