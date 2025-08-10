<?php require_once __DIR__ . '/../../functions.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : APP_NAME ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Phoenix Bootstrap Custom CSS -->
    <link href="<?= css_url('phoenix-bootstrap.css') ?>" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?= css_url('app.css') ?>" rel="stylesheet">
</head>
<body class="bg-light" data-bs-theme="light">
    
    <!-- Dark Mode Toggle -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <button id="darkModeToggle" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <div class="min-vh-100 py-4">
        <?php 
        if (isset($content_view)) {
            include $content_view . '.php';
        }
        ?>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= js_url('app.js') ?>"></script>
</body>
</html>