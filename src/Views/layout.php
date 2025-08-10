<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Trading Journal' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="/assets/css/app.css" rel="stylesheet">
    
    <style>
        :root {
            --bs-primary: #3b82f6;
            --bs-success: #10b981;
            --bs-info: #06b6d4;
            --bs-warning: #f59e0b;
            --bs-danger: #ef4444;
            --bs-purple: #8b5cf6;
            
            /* Color-coded system */
            --trade-basics: #3b82f6;      /* Blue */
            --trade-performance: #10b981;  /* Green */
            --trade-metrics: #8b5cf6;     /* Purple */
            --trade-charts: #f59e0b;      /* Orange */
            --trade-comments: #06b6d4;    /* Teal */
        }
        
        [data-bs-theme="dark"] {
            --bs-body-bg: #111827;
            --bs-body-color: #f9fafb;
            --bs-border-color: #374151;
        }
        
        .transition-colors {
            transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }
        
        .color-basics { color: var(--trade-basics) !important; }
        .color-performance { color: var(--trade-performance) !important; }
        .color-metrics { color: var(--trade-metrics) !important; }
        .color-charts { color: var(--trade-charts) !important; }
        .color-comments { color: var(--trade-comments) !important; }
        
        .border-basics { border-color: var(--trade-basics) !important; }
        .border-performance { border-color: var(--trade-performance) !important; }
        .border-metrics { border-color: var(--trade-metrics) !important; }
        .border-charts { border-color: var(--trade-charts) !important; }
        .border-comments { border-color: var(--trade-comments) !important; }
    </style>
</head>
<body class="bg-light transition-colors" data-bs-theme="light">
    
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
    <script src="/assets/js/app.js"></script>
</body>
</html>