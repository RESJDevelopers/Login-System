<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>public/css/style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>public/css/admin_dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <?php include_once $viewPath; ?>
    </div>
    <script src="<?php echo $base_url; ?>public/js/scripts.js"></script>
</body>

</html>