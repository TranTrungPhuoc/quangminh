<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta name="description" content="Ceci est ma super page">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Đường dẫn gốc -->
    <base href="http://localhost/admin/">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- chèn css data table -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include "Admin/loader.view.php"; ?>
    <?php include "Admin/nav.view.php"; ?>
    <?php include "Admin/header.view.php"; ?>
    <?php include "Admin/main.view.php"; ?>
    <?php include "Admin/modal.view.php"; ?>
    <?php include "Admin/script.view.php"; ?>
</body>
</html>