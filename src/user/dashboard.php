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

<body class="flex items-center justify-center min-h-screen bg t1">
    <?php include '../loadtab/h.php'; ?>
    <div class="w-full max-w-md md:max-w-lg lg:max-w-xl p-8 m-6 bg-white rounded-2xl shadow-2xl transform transition duration-500 hover:scale-105">
        <div class="flex flex-col items-center">
            <!-- Logo -->
            <img src="/image/logo.png" alt="Logo" class="w-28 h-28 rounded-full shadow-lg ring-4 ring-white mb-4">

            <!-- Title -->
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 text-center leading-snug">
                กำลังดำเนินการนะครับ
            </h1>
            <div class="text-center mt-6">
                <a href="https://riceproduct.pcnone.com/google_auth?logout=true"
                    class="inline-block px-6 py-3 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                    Logout
                </a>
            </div>
        </div>
    </div>
    <?php include '../loadtab/f.php'; ?>
</body>

</html>