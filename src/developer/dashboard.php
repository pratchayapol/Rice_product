<?php
session_start();
include '../connect/dbcon.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_token'])) {
    $token = $_POST['ajax_token'];
    $email = $_SESSION['email']; // หรือชื่อ session ที่เก็บ id ผู้ใช้

    $stmt = $pdo->prepare("UPDATE accounts SET access_token = ? WHERE email = ?");
    if ($stmt->execute([$token, $email])) {
        echo "บันทึก Token สำเร็จ";
    } else {
        echo "บันทึก Token ไม่สำเร็จ";
    }
    exit;
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นักพัฒนา</title>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>

<body class="bg t1">
    <?php include '../loadtab/h.php'; ?>
    <!-- Navigation Bar -->
    <?php include './plugin/navbar.php' ?>
    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-7xl px-4 md:px-8">
            <div class="text-center bg-white/75 py-24 px-10 rounded-2xl shadow-xl w-full mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-black mb-2 t1">ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว</h1>
                <p class="text-xl text-gray-800 mb-6 t1">Rice Product Processing Database</p>
                <p class="text-xl text-gray-800 mb-6 t1">สำหรับนักพัฒนา</p>

                <div class="flex justify-center mb-8">

                    <div class="text-center">
                        <button id="genTokenBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                            สร้าง Access Token
                        </button>
                        <div id="tokenContainer" class="hidden mt-4">
                            <input type="text" id="accessToken" class="border p-2 rounded w-full md:w-96 text-center" readonly>
                            <button onclick="copyToken()" class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                คัดลอก Token
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        function generateRandomToken(length = 64) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let token = '';
            for (let i = 0; i < length; i++) {
                token += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return token;
        }

        document.getElementById('genTokenBtn').addEventListener('click', function() {
            const token = generateRandomToken();
            document.getElementById('accessToken').value = token;
            document.getElementById('tokenContainer').classList.remove('hidden');

            $.post("", {
                ajax_token: token
            }, function(res) {
                alert(res);
            });
        });

        function copyToken() {
            const input = document.getElementById("accessToken");
            input.select();
            input.setSelectionRange(0, 99999); // mobile
            document.execCommand("copy");
            alert("คัดลอก Token แล้ว!");
        }
    </script>

    <?php include '../loadtab/f.php'; ?>
</body>

</html>