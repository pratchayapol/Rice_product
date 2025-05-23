<?php
session_start();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/bg.css">
    <!-- animation -->
    <link rel="stylesheet" href="../css/animation.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <?php include '../loadtab/h.php'; ?>
    <div class="header-logo-box container">
        <div class="row">
            <div class="align-self-center col-xl-1 col-lg-2 col-md-2 col-3"><a href="/"><img src="/static/media/rice_logo.6b89da99c2813fda6994.png" class="d-inline-block header-logo-img" alt="กรมการข้าว"></a></div>
            <div class="align-self-center col-xl-9 col-lg-8 col-md-7 col-8">
                <div class="header-title-text"><a href="/">ศูนย์วิจัยข้าวขอนแก่น</a></div>
                <div class="header-sub-text"><a href="/">Khon Kaen Rice Research Center</a></div>
            </div>
            <div class="header-hamburger col-md-3 col-1"><button aria-controls="responsive-navbar-nav" type="button" aria-label="Toggle navigation" class="ml-auto navbar-toggler collapsed"><span class="navbar-toggler-icon"></span></button></div>
        </div>
    </div>
    <?php include '../loadtab/f.php'; ?>
</body>

</html>