<?php
require_once APPROOT . '/helpers/session_helper.php';
requireAdmin();

$errors = [];
$success = '';

// Get package data
$package = new Package();
$packageData = $package->getPackageById($data['id']);

if (!$packageData) {
    redirect('admin/packages');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = cleanInput($_POST['title']);
    $destination_id = cleanInput($_POST['destination_id']);
    $description = cleanInput($_POST['description']);
    $duration_days = cleanInput($_POST['duration_days']);
    $price = cleanInput($_POST['price']);
    $type = cleanInput($_POST['type']);
    $difficulty = cleanInput($_POST['difficulty']);
    $min_age = cleanInput($_POST['min_age']);
    
    // Validate inputs
    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }
    
    if (empty($destination_id)) {
        $errors['destination_id'] = 'Destination is required';
    }
    
    if (empty($description)) {
        $errors['description'] = 'Description is required';
    }
    
    if (!is_numeric($duration_days) || $duration_days < 1) {
        $errors['duration_days'] = 'Duration must be at least 1 day';
    }
    
    if (!is_numeric($price) || $price <= 0) {
        $errors['price'] = 'Price must be a positive number';
    }
    
    // Handle image upload
    $image_path = $packageData->image_path;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['image']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $errors['image'] = 'Only JPG, PNG and GIF images are allowed';
        } else {
            $upload_dir = PUBLICROOT . '/assets/uploads/packages/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $file_name = uniqid('package_') . '.' . $file_ext;
            $file_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // Delete old image if exists
                if ($packageData->image_path && file_exists(PUBLICROOT . '/' . $packageData->image_path)) {
                    unlink(PUBLICROOT . '/' . $packageData->image_path);
                }
                $image_path = 'assets/uploads/packages/' . $file_name;
            } else {
                $errors['image'] = 'Failed to upload image';
            }
        }
    }
    
    if (empty($errors)) {
        if($package->updatePackage($data['id'], $destination_id, $title, $description, $duration_days, $price, $image_path, $type, $difficulty, $min_age)) {
            $success = 'Package updated successfully!';
            $packageData = $package->getPackageById($data['id']); // Refresh data
        } else {
            $errors['database'] = 'Failed to update package';
        }
    }
}

// Get destinations for dropdown
$destination = new Destination();
$destinations = $destination->getAllDestinations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package - Admin Panel</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/styles/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php require_once APPROOT . '/views/inc/admin_sidebar.php'; ?>

        <!-- Main Content -->
        <div class="admin-content">
            <h1>Edit Package</h1>

            <a href="<?php echo URLROOT; ?>/admin/packages" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Packages
            </a>

            <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (isset($errors['database'])): ?>
            <div class="error"><?php echo $errors['database']; ?></div>
            <?php endif; ?>

            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Package Title</label>
                        <input type="text" id="title" name="title" value="<?php echo $packageData->title; ?>" required>
                        <?php if (isset($errors['title'])): ?>
                        <span class="error"><?php echo $errors['title']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="destination_id">Destination</label>
                        <select id="destination_id" name="destination_id" required>
                            <option value="">Select Destination</option>
                            <?php foreach ($destinations as $dest): ?>
                            <option value="<?php echo $dest->id; ?>" <?php echo ($dest->id == $packageData->destination_id) ? 'selected' : ''; ?>>
                                <?php echo $dest->name; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['destination_id'])): ?>
                        <span class="error"><?php echo $errors['destination_id']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required><?php echo $packageData->description; ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                        <span class="error"><?php echo $errors['description']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="duration_days">Duration (Days)</label>
                        <input type="number" id="duration_days" name="duration_days" min="1" value="<?php echo $packageData->duration_days; ?>" required>
                        <?php if (isset($errors['duration_days'])): ?>
                        <span class="error"><?php echo $errors['duration_days']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo $packageData->price; ?>" required>
                        <?php if (isset($errors['price'])): ?>
                        <span class="error"><?php echo $errors['price']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="type">Package Type</label>
                        <select id="type" name="type" required>
                            <option value="standard" <?php echo ($packageData->type == 'standard') ? 'selected' : ''; ?>>Standard</option>
                            <option value="premium" <?php echo ($packageData->type == 'premium') ? 'selected' : ''; ?>>Premium</option>
                            <option value="luxury" <?php echo ($packageData->type == 'luxury') ? 'selected' : ''; ?>>Luxury</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="difficulty">Difficulty Level</label>
                        <select id="difficulty" name="difficulty" required>
                            <option value="easy" <?php echo ($packageData->difficulty == 'easy') ? 'selected' : ''; ?>>Easy</option>
                            <option value="moderate" <?php echo ($packageData->difficulty == 'moderate') ? 'selected' : ''; ?>>Moderate</option>
                            <option value="challenging" <?php echo ($packageData->difficulty == 'challenging') ? 'selected' : ''; ?>>Challenging</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="min_age">Minimum Age</label>
                        <input type="number" id="min_age" name="min_age" min="0" value="<?php echo $packageData->min_age; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Package Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <?php if (isset($errors['image'])): ?>
                        <span class="error"><?php echo $errors['image']; ?></span>
                        <?php endif; ?>
                        <?php if ($packageData->image_path): ?>
                        <img src="<?php echo URLROOT . '/' . $packageData->image_path; ?>" alt="Current Package Image" class="current-image">
                        <?php endif; ?>
                        <img id="image-preview" class="image-preview" src="#" alt="Preview" style="display: none;">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Package</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html> 