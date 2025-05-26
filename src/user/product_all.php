<?php
session_start();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลิตภัณฑ์ทั้งหมด</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/bg1.css">
    <!-- animation -->
    <link rel="stylesheet" href="../css/animation.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg t1">
    <?php include '../loadtab/h.php'; ?>
    <!-- Navigation Bar -->
    <?php include './plugin/navbar.php' ?>
    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="text-center bg-white/70 p-10 rounded-2xl shadow-xl max-w-xl w-full">
            <div class="flex justify-center space-x-6 mt-10">
                <!-- การ์ดอาหาร -->
                <a href="food.php" class="block">
                    <div class="bg-yellow-500 text-black p-8 rounded-xl shadow-md w-48 text-center hover:scale-105 transform transition">
                        <img src="../image/type1.png" alt="อาหาร" class="mx-auto mb-4 w-14 h-14">
                        <p class="font-bold text-lg">อาหาร</p>
                    </div>
                </a>

                <!-- การ์ดเวชสำอางค์ -->
                <a href="cosmetic.php" class="block">
                    <div class="bg-red-700 text-white p-8 rounded-xl shadow-md w-48 text-center hover:scale-105 transform transition">
                        <img src="../image/cosmetic-icon.png" alt="เวชสำอางค์" class="mx-auto mb-4 w-14 h-14">
                        <p class="font-bold text-lg">เวชสำอางค์</p>
                    </div>
                </a>

                <!-- การ์ดการแพทย์ -->
                <a href="medical.php" class="block">
                    <div class="bg-purple-900 text-white p-8 rounded-xl shadow-md w-48 text-center hover:scale-105 transform transition">
                        <img src="../image/medical-icon.png" alt="การแพทย์" class="mx-auto mb-4 w-14 h-14">
                        <p class="font-bold text-lg">การแพทย์</p>
                    </div>
                </a>
            </div>
        </div>


        <?php include '../loadtab/f.php'; ?>
</body>

</html>