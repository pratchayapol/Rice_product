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

        #cookie-popup {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            max-width: 800px;
            width: 90%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            z-index: 9999;
            display: none;
        }

        #cookie-popup .cookie-text {
            flex: 1;
            margin-right: 20px;
        }

        #cookie-popup .cookie-text h4 {
            margin: 0 0 8px;
            font-size: 16px;
        }

        #cookie-popup .cookie-text p {
            margin: 0;
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }

        #cookie-popup .cookie-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .cookie-btn {
            padding: 10px 16px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s ease;
        }

        .accept-btn {
            background-color: #333;
            color: white;
        }

        .accept-btn:hover {
            background-color: #555;
        }

        .reject-btn {
            background-color: #333;
            color: white;
        }

        .reject-btn:hover {
            background-color: #555;
        }

        .manage-btn {
            background-color: #f1f3f5;
            color: #333;
            border: 1px solid #ccc;
        }

        .manage-btn:hover {
            background-color: #e2e6ea;
        }

        /* สำหรับหน้าจอกว้าง ปุ่มเรียงแนวนอน */
        @media (min-width: 600px) {
            #cookie-popup .cookie-buttons {
                flex-direction: row;
            }
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

    <div
        id="cookie-popup"
        class="fixed bottom-5 left-1/2 transform -translate-x-1/2 max-w-3xl w-[70%] bg-white rounded-xl shadow-lg p-5 z-[9999] hidden flex-col">
        <div class="cookie-text mb-4">
            <h4 class="text-lg font-semibold mb-2">We use cookies</h4>
            <p class="text-sm text-gray-800 leading-relaxed">
                Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent.
            </p>
        </div>

        <!-- ปุ่มแถวบน -->
        <div class="flex justify-between mb-4">
            <button
                class="accept-btn w-[15%] bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition"
                onclick="acceptCookies()">
                Accept all
            </button>
            <button
                class="reject-btn w-[15%] bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition"
                onclick="rejectCookies()">
                Reject all
            </button>
        </div>

        <!-- ปุ่มแถวล่าง -->
        <div class="flex justify-center">
            <button
                class="manage-btn w-[30%] bg-gray-200 text-gray-800 border border-gray-300 py-2 rounded hover:bg-gray-300 transition"
                onclick="managePreferences()">
                Manage Individual preferences
            </button>
        </div>
    </div>

    <script>
        function showCookiePopup() {
            const consent = localStorage.getItem('cookieConsent');
            if (!consent) {
                document.getElementById('cookie-popup').style.display = 'flex';
            }
        }

        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'accepted');
            document.getElementById('cookie-popup').style.display = 'none';
            console.log('Cookies accepted.');
            // Enable tracking cookies here
        }

        function rejectCookies() {
            localStorage.setItem('cookieConsent', 'rejected');
            document.getElementById('cookie-popup').style.display = 'none';
            console.log('Cookies rejected.');
            // Disable tracking cookies here
        }

        function managePreferences() {
            localStorage.setItem('cookieConsent', 'customize');
            document.getElementById('cookie-popup').style.display = 'none';
            alert('Open preferences modal here.');
            // Open a modal for detailed preferences if needed
        }

        window.onload = showCookiePopup;
    </script>

    <?php include './loadtab/f.php'; ?>
</body>

</html>