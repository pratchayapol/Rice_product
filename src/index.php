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
        .cookie-banner {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            border: 1px solid #ccc;
            padding: 1em;
            width: 300px;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .cookie-banner__actions button {
            margin: 0.5em 0.25em;
        }

        .cookie-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 2000;
        }

        .cookie-modal.active {
            display: block;
        }

        .cookie-modal__overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            inset: 0;
        }

        .cookie-modal__content {
            background: #fff;
            margin: 5% auto;
            padding: 1em;
            max-width: 500px;
            position: relative;
            border-radius: 4px;
        }

        .cookie-modal__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cookie-modal__footer button {
            margin: 0.5em;
        }

        .link {
            background: none;
            color: blue;
            border: none;
            cursor: pointer;
            text-decoration: underline;
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

    <!-- Cookie Banner -->
    <div id="cookie-banner" class="cookie-banner">
        <div class="cookie-banner__body">
            <h2>เราใช้คุกกี้</h2>
            <p>
                เว็บไซต์นี้ใช้คุกกี้ที่จำเป็นเพื่อให้ทำงานได้ถูกต้อง และคุกกี้สำหรับติดตามเพื่อเข้าใจว่าคุณโต้ตอบกับเว็บไซต์อย่างไร
                <button id="btn-show-settings" class="link">ให้ฉันเลือก</button>
            </p>
            <div class="cookie-banner__actions">
                <button id="btn-accept-all">ยอมรับทั้งหมด</button>
                <button id="btn-decline-all">ปฏิเสธทั้งหมด</button>
            </div>
        </div>
    </div>

    <!-- Cookie Settings Modal -->
    <div id="cookie-modal" class="cookie-modal">
        <div class="cookie-modal__overlay"></div>
        <div class="cookie-modal__content">
            <div class="cookie-modal__header">
                <h2>การตั้งค่าคุกกี้</h2>
                <button id="btn-close-modal">&times;</button>
            </div>
            <div class="cookie-modal__body">
                <div class="cookie-section">
                    <h3>คุกกี้ที่จำเป็น</h3>
                    <p>คุกกี้เหล่านี้จำเป็นสำหรับการทำงานของเว็บไซต์</p>
                    <label><input type="checkbox" checked disabled> เปิดใช้งานเสมอ</label>
                </div>
                <div class="cookie-section">
                    <h3>คุกกี้วิเคราะห์</h3>
                    <p>ช่วยปรับปรุงประสบการณ์ใช้งานของคุณ</p>
                    <label><input type="checkbox" id="toggle-analytics"> เปิด/ปิด</label>
                </div>
                <div class="cookie-section">
                    <h3>คุกกี้โฆษณา</h3>
                    <p>ช่วยแสดงเนื้อหาและโฆษณาที่ตรงกับความสนใจ</p>
                    <label><input type="checkbox" id="toggle-ads"> เปิด/ปิด</label>
                </div>
            </div>
            <div class="cookie-modal__footer">
                <button id="btn-accept-all-modal">ยอมรับทั้งหมด</button>
                <button id="btn-decline-all-modal">ปฏิเสธทั้งหมด</button>
                <button id="btn-save-settings">บันทึกการตั้งค่า</button>
            </div>
        </div>
    </div>
    <script>
        // Banner buttons
        const btnShowSettings = document.getElementById('btn-show-settings');
        const btnAcceptAll = document.getElementById('btn-accept-all');
        const btnDeclineAll = document.getElementById('btn-decline-all');

        // Modal elements
        const modal = document.getElementById('cookie-modal');
        const btnCloseModal = document.getElementById('btn-close-modal');
        const btnAcceptAllModal = document.getElementById('btn-accept-all-modal');
        const btnDeclineAllModal = document.getElementById('btn-decline-all-modal');
        const btnSaveSettings = document.getElementById('btn-save-settings');

        // Toggles
        const toggleAnalytics = document.getElementById('toggle-analytics');
        const toggleAds = document.getElementById('toggle-ads');

        btnShowSettings.addEventListener('click', () => {
            modal.classList.add('active');
        });

        btnCloseModal.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        btnAcceptAll.addEventListener('click', () => {
            // Save consent for all cookies
            setCookieConsent(true, true);
            hideBanner();
        });

        btnDeclineAll.addEventListener('click', () => {
            setCookieConsent(false, false);
            hideBanner();
        });

        btnAcceptAllModal.addEventListener('click', () => {
            setCookieConsent(true, true);
            hideBanner();
            modal.classList.remove('active');
        });

        btnDeclineAllModal.addEventListener('click', () => {
            setCookieConsent(false, false);
            hideBanner();
            modal.classList.remove('active');
        });

        btnSaveSettings.addEventListener('click', () => {
            const analytics = toggleAnalytics.checked;
            const ads = toggleAds.checked;
            setCookieConsent(analytics, ads);
            hideBanner();
            modal.classList.remove('active');
        });

        function hideBanner() {
            document.getElementById('cookie-banner').style.display = 'none';
        }

        function setCookieConsent(analytics, ads) {
            localStorage.setItem('cookieConsent', JSON.stringify({
                analytics,
                ads
            }));
        }
    </script>

    <?php include './loadtab/f.php'; ?>
</body>

</html>