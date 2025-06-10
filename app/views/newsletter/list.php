<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h1 class="page-title">Newsletter Subscribers</h1>
    <?php if (empty($data['subscribers'])): ?>
        <p>No subscribers found.</p>
    <?php else: ?>
        <table class="subscribers-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Subscribed At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['subscribers'] as $subscriber): ?>
                    <tr>
                        <td><?php echo $subscriber->email; ?></td>
                        <td><?php echo date('M d, Y H:i', strtotime($subscriber->subscribed_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 