<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container mt-4">
    <h1>Registered Users</h1>
    <?php if(empty($data['users'])): ?>
        <div class="alert alert-info">
            No users registered yet.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->full_name; ?></td>
                            <td><?php echo $user->role; ?></td>
                            <td><?php echo $user->created_at; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?> 