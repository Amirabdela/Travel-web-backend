<?php
require_once '../connect.php';
require_once '../auth.php';

// Redirect if not admin
redirectIfNotAdmin();

$errors = [];
$success = '';

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
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['image']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $errors['image'] = 'Only JPG, PNG and GIF images are allowed';
        } else {
            $upload_dir = '../assets/uploads/packages/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $file_name = uniqid('package_') . '.' . $file_ext;
            $file_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                $image_path = 'assets/uploads/packages/' . $file_name;
            } else {
                $errors['image'] = 'Failed to upload image';
            }
        }
    } else {
        $errors['image'] = 'Package image is required';
    }
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO packages (destination_id, title, description, duration_days, price, 
                                    image_path, type, difficulty, min_age)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([
                $destination_id,
                $title,
                $description,
                $duration_days,
                $price,
                $image_path,
                $type,
                $difficulty,
                $min_age
            ]);
            
            $success = 'Package added successfully!';
        } catch (PDOException $e) {
            $errors['database'] = 'Database error: ' . $e->getMessage();
        }
    }
}

// Get destinations for dropdown
$stmt = $pdo->query("SELECT id, name FROM destinations ORDER BY name");
$destinations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Package - Admin Panel</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    .admin-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        min-height: 100vh;
    }

    .admin-sidebar {
        background: #2c3e50;
        color: white;
        padding: 20px;
    }

    .admin-content {
        padding: 20px;
    }

    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-group textarea {
        min-height: 150px;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-secondary {
        background: #95a5a6;
        color: white;
    }

    .error {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
    }

    .success {
        color: #27ae60;
        margin-bottom: 20px;
        padding: 10px;
        background: #d4edda;
        border-radius: 4px;
    }

    .image-preview {
        max-width: 300px;
        margin-top: 10px;
        display: none;
    }
    </style>
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin-packages.php" class="active"><i class="fas fa-suitcase"></i> Packages</a></li>
                <li><a href="admin-destinations.php"><i class="fas fa-map-marker-alt"></i> Destinations</a></li>
                <li><a href="admin-hotels.php"><i class="fas fa-hotel"></i> Hotels</a></li>
                <li><a href="admin-cars.php"><i class="fas fa-car"></i> Rental Cars</a></li>
                <li><a href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a></li>
                <li><a href="admin-users.php"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="admin-messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="../index.php"><i class="fas fa-home"></i> Back to Site</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <h1>Add New Package</h1>

            <a href="admin-packages.php" class="btn btn-secondary">
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
                        <input type="text" id="title" name="title" required>
                        <?php if (isset($errors['title'])): ?>
                        <span class="error"><?php echo $errors['title']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="destination_id">Destination</label>
                        <select id="destination_id" name="destination_id" required>
                            <option value="">Select Destination</option>
                            <?php foreach ($destinations as $dest): ?>
                            <option value="<?php echo $dest['id']; ?>"><?php echo $dest['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['destination_id'])): ?>
                        <span class="error"><?php echo $errors['destination_id']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required></textarea>
                        <?php if (isset($errors['description'])): ?>
                        <span class="error"><?php echo $errors['description']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="duration_days">Duration (days)</label>
                        <input type="number" id="duration_days" name="duration_days" min="1" required>
                        <?php if (isset($errors['duration_days'])): ?>
                        <span class="error"><?php echo $errors['duration_days']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" required>
                        <?php if (isset($errors['price'])): ?>
                        <span class="error"><?php echo $errors['price']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="type">Package Type</label>
                        <select id="type" name="type" required>
                            <option value="cultural">Cultural</option>
                            <option value="adventure">Adventure</option>
                            <option value="relax">Relax</option>
                            <option value="sport">Sport</option>
                            <option value="historical">Historical</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="difficulty">Difficulty</label>
                        <select id="difficulty" name="difficulty" required>
                            <option value="easy">Easy</option>
                            <option value="moderate">Moderate</option>
                            <option value="difficult">Difficult</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="min_age">Minimum Age</label>
                        <input type="number" id="min_age" name="min_age" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label for="image">Package Image</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                        <img id="imagePreview" class="image-preview" src="#" alt="Image Preview">
                        <?php if (isset($errors['image'])): ?>
                        <span class="error"><?php echo $errors['image']; ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Package</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Show image preview when file is selected
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>