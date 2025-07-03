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
        }

        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f2f2f2;
            padding: 16px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1000;
        }

        .cookie-btn {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
        }

        .accept-btn {
            background-color: #4CAF50;
            color: white;
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
        }

        #manage-preferences {
            background-color: #2196F3;
            color: white;
            padding: 8px 16px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Popup styling */
        .cookie-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            max-width: 500px;
            width: 90%;
            border-radius: 8px;
            position: relative;
        }

        .popup-content h2 {
            margin-top: 0;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
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
    <div class="cookie-banner">
        <div>
            <button class="cookie-btn accept-btn" onclick="acceptCookies()">Accept all</button>
            <button class="cookie-btn reject-btn" onclick="rejectCookies()">Reject all</button>
        </div>
        <div>
            <button id="manage-preferences">Manage Individual Preferences</button>
        </div>
    </div>

    <!-- Popup -->
    <div class="cookie-popup" id="cookie-popup">
        <div class="popup-content">
            <button class="close-btn" onclick="closePopup()">×</button>
            <h2>Cookie Settings</h2>
            <p>You can customize your cookie preferences below:</p>
            <label><input type="checkbox" checked disabled /> Necessary Cookies (always enabled)</label><br />
            <label><input type="checkbox" id="analytics-checkbox" /> Analytics Cookies</label><br />
            <label><input type="checkbox" id="ads-checkbox" /> Advertising Cookies</label><br />
            <div style="margin-top: 15px;">
                <button onclick="savePreferences()">Save Preferences</button>
            </div>
        </div>
    </div>

    <script>
        function acceptCookies() {
            alert('You accepted all cookies.');
            // Place your accept logic here
        }

        function rejectCookies() {
            alert('You rejected all cookies.');
            // Place your reject logic here
        }

        const manageBtn = document.getElementById('manage-preferences');
        const popup = document.getElementById('cookie-popup');

        manageBtn.addEventListener('click', () => {
            popup.style.display = 'flex';
        });

        function closePopup() {
            popup.style.display = 'none';
        }

        function savePreferences() {
            const analytics = document.getElementById('analytics-checkbox').checked;
            const ads = document.getElementById('ads-checkbox').checked;
            alert(`Preferences saved.\nAnalytics: ${analytics}\nAds: ${ads}`);
            closePopup();
        }
    </script>
    <?php include './loadtab/f.php'; ?>
</body>

</html>