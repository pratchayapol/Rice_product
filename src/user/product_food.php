<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลิตภัณฑ์ด้านอาหาร</title>
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
    <?php include './plugin/navbar.php'; ?>

    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="w-full px-6"> <!-- ขยายเต็มจอและมี padding ขอบ -->
            <div class="bg-white/70 p-10 rounded-2xl shadow-xl w-full text-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl shadow p-4 flex flex-col items-center">
                        <img src="URL_ของภาพสินค้า" alt="สินค้า" class="rounded-xl mb-4 w-full aspect-[4/3] object-cover" />
                        <p class="text-gray-800 font-semibold text-sm mb-1">ชื่อผลิตภัณฑ์</p>
                        <p class="text-gray-500 text-sm mb-3">ชื่อพันธุ์ข้าว</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-700 hover:bg-gray-100">ปุ่ม 1</button>
                            <button class="px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-700 hover:bg-gray-100">ปุ่ม 2</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl shadow p-4 flex flex-col items-center">
                        <img src="URL_ของภาพสินค้า" alt="สินค้า" class="rounded-xl mb-4 w-full aspect-[4/3] object-cover" />
                        <p class="text-gray-800 font-semibold text-sm mb-1">ชื่อผลิตภัณฑ์</p>
                        <p class="text-gray-500 text-sm mb-3">ชื่อพันธุ์ข้าว</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-700 hover:bg-gray-100">ปุ่ม 1</button>
                            <button class="px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-700 hover:bg-gray-100">ปุ่ม 2</button>
                        </div>
                    </div>

                    <!-- เพิ่มการ์ดต่อได้เรื่อย ๆ -->
                </div>
            </div>
        </div>
    </div>

    </div>

    <?php include '../loadtab/f.php'; ?>
</body>

</html>