<?php
$title = "Register";
include('inc/header.php'); ?>
<?php if (isset($_SESSION['auth'])){ //لتفادي توجيه المستخدم لنفس الصفحة بعد نجاح التسجيل
    header("location:index.php");
    die;
} ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Join Our Tech Store</h1>
            <p class="lead text-white-50">Sign up now to explore the latest electronics and exclusive deals</p>
        </div>
    </div>
</header>
        
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto my-5">
            <h2 class="border p-2 my-2 text-center">Register</h2>

            <?php

            if (isset($_SESSION['errors'])): //للتأكد من وجود مفتاح اسمه ايرورز جوا السيشن علشان يعرضه
                foreach ($_SESSION['errors'] as $error):  // لعرض الاخطاء اذا وجدت عند التسجيل 
            ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
            <?php
                endforeach;
                unset($_SESSION['errors']); //لعدم تكرار عرض الاخطاء بعد الرجوع للصفحة مرة اخرى للتسجيل
            endif;
            ?>

            <form action="handelers/handelRegister.php" method="POST" class="border p-3">
                <div class="form-group p-2 my-1">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group p-2 my-1">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group p-2 my-1">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group p-2 my-1">
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>