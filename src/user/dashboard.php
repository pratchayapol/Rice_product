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
    <link rel="stylesheet" href="../css/bg1.css">
    <!-- animation -->
    <link rel="stylesheet" href="../css/animation.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg t1">
    <?php include '../loadtab/h.php'; ?>
    <!-- Navigation Bar -->
<nav class="fixed top-0 left-0 w-full z-50 bg-cover bg-center" style="background-image: url('../images/nav.png');">
  <div class="bg-black bg-opacity-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <!-- Logo and Title -->
        <div class="flex items-center space-x-4">
          <img src="../image/logo.png" alt="Rice Department Logo" class="w-12 h-12 rounded-full border border-white" />
          <div class="text-white">
            <div class="text-lg font-semibold">กรมการข้าว</div>
            <div class="text-sm">Rice Department</div>
          </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-4">
          <a href="#" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">หน้าหลัก</a>
          <a href="#" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">ผลิตภัณฑ์ทั้งหมด</a>
          <a href="#" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">บัญชีผู้ใช้งาน</a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button id="menu-toggle" class="text-white focus:outline-none">
            ☰
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden mt-4 space-y-2 pb-4">
        <a href="#" class="block bg-white text-gray-700 rounded-full px-4 py-2">หน้าหลัก</a>
        <a href="#" class="block bg-white text-gray-700 rounded-full px-4 py-2">ผลิตภัณฑ์ทั้งหมด</a>
        <a href="#" class="block bg-white text-gray-700 rounded-full px-4 py-2">บัญชีผู้ใช้งาน</a>
      </div>
    </div>
  </div>
</nav>

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            const menu = document.getElementById("mobile-menu");
            menu.classList.toggle("hidden");
        });
    </script>
    <?php include '../loadtab/f.php'; ?>
</body>

</html>