<?php
session_start();
$line_login_url = 'https://liff.line.me/2007460484-WlA3R3By';
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rice Product Processing Database</title>
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

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0RGNMK85DQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-0RGNMK85DQ');
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .cm {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            z-index: 9999;
            padding: 20px;
        }

        .cm__title {
            margin-top: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .cm__desc {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .cc-link {
            background: none;
            border: none;
            color: #007BFF;
            text-decoration: underline;
            cursor: pointer;
            font-size: 14px;
            padding: 0;
        }

        .cm__btns {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .cm__btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .cm__btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .cm__btn--secondary {
            background-color: #6c757d;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg t1">
    <?php include './loadtab/h.php'; ?>
    <div class="w-full max-w-md md:max-w-lg lg:max-w-xl p-8 m-6 bg-white rounded-2xl shadow-2xl transform transition duration-500 hover:scale-105">
        <div class="flex flex-col items-center">
            <!-- Logo -->
            <img src="image/logo.png" alt="Logo" class="w-28 h-28 rounded-full shadow-lg ring-4 ring-white mb-4">

            <!-- Title -->
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 text-center leading-snug">
                ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว
            </h1>

            <p class="text-gray-600 mt-2 text-sm text-center">
                Rice Product Processing Database
            </p>
            <p class="text-gray-600 mt-1 text-sm text-center">
                ศูนย์วิจัยข้าวขอนแก่น กรมการข้าว
            </p>
            <p class="text-gray-600 mt-1 text-sm text-center">
                กระทรวงเกษตรและสหกรณ์
            </p>
            <!-- Button -->
            <!-- Google Sign-In Button -->
            <a href="google_auth"
                class="w-full mt-4 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md 
          hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-3">
                <img src="image/Google_Favicon_2025.svg.webp"
                    alt="Google Logo" class="w-6 h-6 bg-white rounded p-1">
                Sign in with Google
            </a>

            <!-- LINE Sign-In Button -->
            <a href="<?= $line_login_url ?>"
                class="w-full mt-4 px-6 py-3 bg-green-500 text-white font-medium rounded-lg shadow-md 
          hover:bg-green-600 hover:shadow-lg transition-all flex items-center justify-center gap-3">
                <img src="image/LINE_logo.svg.webp"
                    alt="LINE Logo" class="w-6 h-6 bg-white rounded p-1">
                Sign in with LINE
            </a>
            <a
                href="/คู่มือการใช้งาน%20เว็บแอปพลิเคชัน%20ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว.pdf"
                target="_blank"
                class="w-full mt-4 px-6 py-3 bg-orange-500 text-white font-medium rounded-lg shadow-md 
         hover:bg-orange-600 hover:shadow-lg transition-all flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6 bg-white text-orange-600 rounded p-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5V19a2.003 2.003 0 002 2h14a2.003 2.003 0 002-2v-2.5M7 10l5 5m0 0l5-5m-5 5V3" />
                </svg>
                ดาวน์โหลดคู่มือการใช้งาน
            </a>


        </div>
    </div>


    <div class="cm" role="dialog" aria-modal="true" aria-describedby="cm__desc" aria-labelledby="cm__title">
        <div class="cm__body">
            <div class="cm__texts">
                <h2 id="cm__title" class="cm__title">เราใช้คุกกี้</h2>
                <p id="cm__desc" class="cm__desc">
                    สวัสดี เว็บไซต์นี้ใช้คุกกี้ที่จำเป็นเพื่อให้แน่ใจว่าทำงานได้อย่างถูกต้อง และคุกกี้สำหรับติดตามเพื่อทำความเข้าใจว่าคุณโต้ตอบกับเว็บไซต์อย่างไร คุกกี้จะถูกตั้งค่าหลังจากได้รับความยินยอมเท่านั้น
                    <button type="button" id="btn-settings" class="cc-link">ให้ฉันเลือก</button>
                </p>
            </div>
            <div class="cm__btns">
                <div class="cm__btn-group">
                    <button type="button" class="cm__btn" onclick="acceptAll()">ยอมรับทั้งหมด</button>
                    <button type="button" class="cm__btn" onclick="rejectAll()">ปฏิเสธทั้งหมด</button>
                </div>
                <div class="cm__btn-group">
                    <button type="button" class="cm__btn cm__btn--secondary" onclick="managePreferences()">จัดการการตั้งค่าส่วนบุคคล</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function acceptAll() {
            alert("คุณยอมรับคุกกี้ทั้งหมด");
            document.querySelector('.cm').style.display = 'none';
        }

        function rejectAll() {
            alert("คุณปฏิเสธคุกกี้ทั้งหมด");
            document.querySelector('.cm').style.display = 'none';
        }

        function managePreferences() {
            alert("เปิดหน้าต่างจัดการการตั้งค่า (ตัวอย่าง)");
            // ที่นี่คุณสามารถเปิด modal หรือไปยังหน้าการตั้งค่า
        }

        document.getElementById('btn-settings').addEventListener('click', managePreferences);
    </script>

    <?php include './loadtab/f.php'; ?>
</body>

</html>