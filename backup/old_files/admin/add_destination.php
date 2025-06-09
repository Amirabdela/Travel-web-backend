<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';

// Check admin login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

$name = $description = $image = $price = "";
$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);
    $price = floatval($_POST['price']);

    if ($name && $description && $image && $price > 0) {
        try {
            $stmt = $pdo->prepare("INSERT INTO destinations (name, description, image, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $description, $image, $price]);
            $success = "Destination added successfully!";
            $name = $description = $image = $price = "";
        } catch (PDOException $e) {
            $error = "Error adding destination: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields with valid data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Destination - Admin</title>
</head>

<body>
    <h2>Add New Destination</h2>
    <?php if ($success): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
    <?php elseif ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Name:</label><br />
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required /><br /><br />

        <label>Description:</label><br />
        <textarea name="description" required><?= htmlspecialchars($description) ?></textarea><br /><br />

        <label>Image Path (e.g., assets/dp5.jpg):</label><br />
        <input type="text" name="image" value="<?= htmlspecialchars($image) ?>" required /><br /><br />

        <label>Price (USD):</label><br />
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($price) ?>" required /><br /><br />

        <button type="submit">Add Destination</button>
    </form>
</body>

</html>