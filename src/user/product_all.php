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
    <?php include './plugin/navbar.php'; ?>

    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="bg-white/70 p-10 rounded-2xl shadow-xl max-w-4xl w-full text-center">

            <!-- Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-items-center">
                <!-- การ์ดอาหาร -->
                <a href="food" class="block w-full max-w-xs">
                    <div class="bg-[#FFF8E7] text-gray-800 p-8 rounded-xl shadow-sm hover:scale-105 transform transition duration-300">
                        <img src="../image/type1.png" alt="อาหาร" class="mx-auto mb-4 w-16 h-16">
                        <p class="font-bold text-xl">อาหาร</p>
                    </div>
                </a>

                <!-- การ์ดเวชสำอางค์ -->
                <a href="cosmetic" class="block w-full max-w-xs">
                    <div class="bg-[#FDE2E4] text-gray-800 p-8 rounded-xl shadow-sm hover:scale-105 transform transition duration-300">
                        <img src="../image/type2.png" alt="เวชสำอางค์" class="mx-auto mb-4 w-16 h-16">
                        <p class="font-bold text-xl">เวชสำอางค์</p>
                    </div>
                </a>

                <!-- การ์ดการแพทย์ -->
                <a href="medical" class="block w-full max-w-xs">
                    <div class="bg-[#E0EAFB] text-gray-800 p-8 rounded-xl shadow-sm hover:scale-105 transform transition duration-300">
                        <img src="../image/type3.png" alt="การแพทย์" class="mx-auto mb-4 w-16 h-16">
                        <p class="font-bold text-xl">การแพทย์</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
    </div>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            const menu = document.getElementById("mobile-menu");
            menu.classList.toggle("hidden");
        });
    </script>
    <?php include '../loadtab/f.php'; ?>
</body>

</html>