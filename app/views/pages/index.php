<?php
require APPROOT . '/views/includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <form action="<?= URLROOT; ?>/" method="POST">
                <h1 class="text-center my-3">Login Form</h1>

                <div class="form-group">
                    <input class="form-control form-control-lg" placeholder="User email" name="email" type="text">
                    <span class="invalidFeedback"><?= $data['emailError']; ?></span>
                </div>

                <div class="form-group">
                    <input class="form-control form-control-lg" placeholder="Password" name="password" type="password">
                    <span class="invalidFeedback"><?= $data['passwordError']; ?></span>
                </div>

                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>