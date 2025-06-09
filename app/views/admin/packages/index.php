<?php
require_once APPROOT . '/helpers/session_helper.php';
requireAdmin();

$package = new Package();
$packages = $package->getAllPackages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Admin Panel</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/styles/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php require_once APPROOT . '/views/inc/admin_sidebar.php'; ?>

        <!-- Main Content -->
        <div class="admin-content">
            <div class="content-header">
                <h1>Manage Packages</h1>
                <a href="<?php echo URLROOT; ?>/admin/packages/add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Package
                </a>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Destination</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($packages)): ?>
                        <tr>
                            <td colspan="7" class="text-center">No packages found</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($packages as $package): ?>
                        <tr>
                            <td>
                                <?php if ($package->image_path): ?>
                                <img src="<?php echo URLROOT . '/' . $package->image_path; ?>" alt="<?php echo $package->title; ?>" class="thumbnail">
                                <?php else: ?>
                                <div class="no-image">No Image</div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $package->title; ?></td>
                            <td><?php echo $package->destination_name; ?></td>
                            <td><?php echo $package->duration_days; ?> days</td>
                            <td>$<?php echo number_format($package->price, 2); ?></td>
                            <td><?php echo ucfirst($package->type); ?></td>
                            <td class="actions">
                                <a href="<?php echo URLROOT; ?>/admin/packages/edit/<?php echo $package->id; ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deletePackage(<?php echo $package->id; ?>)" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deletePackage(id) {
            if (confirm('Are you sure you want to delete this package?')) {
                window.location.href = `<?php echo URLROOT; ?>/admin/packages/delete/${id}`;
            }
        }
    </script>
</body>
</html> 