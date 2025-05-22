<?php
session_start();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Thai Rice Processing Information System</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/bg.css">
    <!-- animation -->
    <link rel="stylesheet" href="./css/animation.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-green-100 to-blue-200">
    <?php include './loadtab/h.php'; ?>

    <div class="w-full max-w-md p-8 m-6 bg-white rounded-2xl shadow-2xl transition-transform duration-500 hover:scale-105">
        <div class="flex flex-col items-center">
            <!-- Logo -->
            <img src="image/logo.png" alt="Logo" class="w-28 h-28 rounded-full shadow-lg ring-4 ring-white mb-4">

            <!-- Title -->
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center leading-snug">
                ระบบบริการข้อมูลแปรรูปผลิตภัณฑ์ข้าวไทย
            </h1>
            <p class="text-gray-600 mt-2 text-sm text-center">
                Smart Thai Rice Processing Information System
            </p>
            <p class="text-gray-600 mt-1 text-sm text-center">
                ศูนย์วิจัยข้าวขอนแก่น กรมการข้าว
            </p>
            <p class="text-gray-600 mt-1 text-sm text-center">
                กระทรวงเกษตรและสหกรณ์
            </p>

            <!-- Button -->
            <a href="google_auth"
                class="mt-6 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md 
                      hover:bg-blue-700 hover:shadow-lg transition-all flex items-center gap-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/IOS_Google_icon.png"
                    alt="Google Logo" class="w-5 h-5">
                Login with Google
            </a>
        </div>
    </div>

    <?php include './loadtab/f.php'; ?>
</body>


</html>