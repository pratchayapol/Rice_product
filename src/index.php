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

    <!-- Cookie popup (เดิม) -->
    <div
        id="cookie-popup"
        class="fixed bottom-10 left-1/2 transform -translate-x-1/2 max-w-3xl w-[800px] bg-white rounded-lg shadow-lg flex divide-x divide-gray-200 p-6">
        <!-- ฝั่งซ้ายข้อความ -->
        <div class="flex-1 pr-6">
            <h4 class="font-semibold text-gray-900 mb-2">We use cookies</h4>
            <p class="text-sm text-gray-600 leading-relaxed">
                Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. Let me choose
            </p>
        </div>

        <!-- ฝั่งขวาปุ่ม -->
        <div class="flex flex-col justify-center pl-6 space-y-3 w-[280px]">
            <div class="flex space-x-3">
                <button
                    class="flex-1 bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700 transition"
                    onclick="acceptCookies()">
                    Accept all
                </button>
                <button
                    class="flex-1 bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700 transition"
                    onclick="rejectCookies()">
                    Reject all
                </button>
            </div>
            <button
                class="w-full bg-gray-100 text-gray-800 py-2 rounded-md hover:bg-gray-200 transition"
                onclick="managePreferences()">
                Manage Individual preferences
            </button>
        </div>
    </div>

    <!-- Modal popup สำหรับจัดการ preferences -->
    <div id="preferences-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-[80vh] overflow-auto p-6 relative">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 id="pm__title" class="text-xl font-semibold">Cookie Settings</h2>
                <button
                    type="button"
                    aria-label="Close modal"
                    onclick="closePreferencesModal()"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19.5 4.5L4.5 19.5M4.5 4.5L19.5 19.5"></path>
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="mt-4 text-gray-700">
                <p class="mb-4">
                    I use cookies to ensure the basic functionalities of the website and to enhance your online experience. You can choose for each category to opt-in/out whenever you want. For more details relative to cookies and other sensitive data, please read the full
                    <a href="https://www.ricethailand.go.th/page/27011" target="_blank" class="text-blue-600 underline hover:text-blue-800">privacy policy</a>.
                </p>
                <!-- เพิ่มส่วนอื่นๆ ตามเนื้อหาที่คุณให้มาได้เลย -->
            </div>

            <!-- Footer -->
            <div class="mt-6 flex justify-between border-t pt-4">
                <div class="space-x-3">
                    <button onclick="acceptCookiesFromModal()" class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition">Accept all</button>
                    <button onclick="rejectCookiesFromModal()" class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition">Reject all</button>
                </div>
                <button onclick="saveSettings()" class="bg-gray-100 text-gray-800 py-2 px-4 rounded hover:bg-gray-200 transition">Save settings</button>
            </div>
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
            console.log('Set cookieConsent:', localStorage.getItem('cookieConsent'));
            document.getElementById('cookie-popup').style.display = 'none';
            // Enable tracking cookies here
        }

        function rejectCookies() {
            localStorage.setItem('cookieConsent', 'rejected');
            console.log('Set cookieConsent:', localStorage.getItem('cookieConsent'));
            document.getElementById('cookie-popup').style.display = 'none';
            // Disable tracking cookies here
        }

        function managePreferences() {
            localStorage.setItem('cookieConsent', 'customize');
            document.getElementById('cookie-popup').style.display = 'none';

            // แสดง modal popup
            document.getElementById('preferences-modal').style.display = 'block';
        }

        function closePreferencesModal() {
            document.getElementById('preferences-modal').style.display = 'none';
        }

        // ฟังก์ชันรับมือปุ่มใน modal
        function acceptCookiesFromModal() {
            localStorage.setItem('cookieConsent', 'accepted');
            closePreferencesModal();
            console.log('Set cookieConsent: accepted (from modal)');
        }

        function rejectCookiesFromModal() {
            localStorage.setItem('cookieConsent', 'rejected');
            closePreferencesModal();
            console.log('Set cookieConsent: rejected (from modal)');
        }

        function saveSettings() {
            // เก็บค่าที่ผู้ใช้เลือกใน modal (ถ้ามี)
            alert('Settings saved.');
            closePreferencesModal();
        }

        window.onload = showCookiePopup;
    </script>


    <?php include './loadtab/f.php'; ?>
</body>

</html>