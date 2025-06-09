<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <!-- Base CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/base.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/header.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/footer.css">
    <!-- Page specific CSS -->
    <?php if (isset($css)): ?>
        <?php foreach ($css as $file): ?>
            <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/<?php echo $file; ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>
    <?php require APPROOT . '/views/inc/header.php'; ?>
    
    <main>
        <?php require APPROOT . '/views/inc/flash.php'; ?>
        <?php echo $content; ?>
    </main>

    <?php require APPROOT . '/views/inc/footer.php'; ?>

    <!-- Base JavaScript -->
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>
    <!-- Page specific JavaScript -->
    <?php if (isset($js)): ?>
        <?php foreach ($js as $file): ?>
            <script src="<?php echo URLROOT; ?>/js/<?php echo $file; ?>.js"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html> 