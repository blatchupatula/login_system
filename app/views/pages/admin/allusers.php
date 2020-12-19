<?php
require APPROOT . '/views/includes/header.php';
?>

<div class="container">
    <h1>All Users</h1>
    <table class="table table-bordered my-3">
        <thead>
            <tr>
                <th>User Id</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Login/Logout History</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['users'] as $user): ?>
            <tr>
                <td><?=$user->user_id ?></td>
                <td><?=$user->user_name ?></td>
                <td><?=$user->user_email ?></td>
                <td><a href="<?= URLROOT . '/admin/user/' . $user->user_id ?>">View history</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
require APPROOT . '/views/includes/footer.php';
?>