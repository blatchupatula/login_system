<?php
require APPROOT . '/views/includes/header.php';
?>

<div class="container my-3">
    <table class="table table-bordered my-3">
        <thead>
            <tr>
                <th>S No</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>Ip Address</th>
            </tr>
        </thead>
        <tbody>
            <?php $sno=1; foreach($data['history'] as $user): ?>
            <tr>
                <td><?=$sno; ?></td>
                <td><?=$user->login_time ?></td>
                <td><?=$user->logout_time ?></td>
                <td><?=$user->ip_address ?></td>
            </tr>
            <?php $sno++; endforeach; ?>
        </tbody>
    </table>
    <?php if(empty($data['history'])): ?>
        <h1 class="text-center">No records found</h1>
    <?php endif; ?>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>