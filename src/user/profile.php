<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}
include '../connect/dbcon.php';

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
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
        <div class="text-center bg-white/70 p-10 rounded-2xl shadow-xl max-w-xl w-full hover:scale-105 transform transition duration-300">
            <h1 class="text-3xl md:text-4xl font-bold text-black mb-6">โปรไฟล์</h1>

            <?php if (isset($_SESSION['user'])): ?>
                <img
                    src="<?= htmlspecialchars($_SESSION['user']['picture']) ?>"
                    alt="Profile Picture"
                    class="mx-auto rounded-full w-32 h-32 object-cover mb-4 shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($_SESSION['user']['name']) ?></h2>
                <p class="text-gray-600 text-sm md:text-base"><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
            <?php else: ?>
                <p class="text-red-500">ไม่มีข้อมูลผู้ใช้</p>
            <?php endif; ?>
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