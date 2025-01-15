<?php
$title = "Contact";
include('inc/header.php'); ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Contact Us</h1>
            <p class="lead">Have questions? We're here to assist you. Get in touch with us today!</p>
        </div>
    </div>
</header>
        
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-8 mx-auto">
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
                <form action="handelers/handelContact.php" method="POST" class="form border my-2 p-3">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="7"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Send" id="" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('inc/footer.php'); ?>