<?php
require APPROOT . '/views/includes/header.php';
?>

<div class="container">
    <div>
        <?php if(isLogout()){ ?>
            <h1 class="text-center my-3">Your profile is locked, please contact admin</h1>
        <?php } else { ?>
        <h1 class="text-center my-3">Welcome <?=$_SESSION['user_name']; ?></h1>
        <?php } ?>
    </div>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>