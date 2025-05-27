<?php
session_start();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดผลิตภัณท์</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/bg.css">
    <!-- animation -->
    <link rel="stylesheet" href="../css/animation.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg t1">
    <?php include '../loadtab/h.php'; ?>

    <div class="flex items-center justify-center min-h-screen p-6">
        <div class="max-w-7xl w-full">
            <div class="grid grid-cols-12 gap-6">

                <!-- Sidebar -->
                <div class="col-span-12 md:col-span-4 bg-pink-100 rounded-lg p-6 text-center text-gray-800 flex flex-col items-center">
                    <h2 class="text-2xl font-bold mb-4">ผลิตภัณฑ์<br>ข้าวกล้องอัดแท่ง</h2>
                    <div class="bg-white h-40 w-full rounded-lg mb-4 flex items-center justify-center">
                        <span class="text-gray-400">รูปภาพ</span>
                    </div>
                    <p class="text-sm mb-4">ที่มา : สำนักวิจัยและพัฒนาข้าว กรมการข้าว</p>
                    <a href="./dashboard" class="bg-yellow-400 text-black px-4 py-2 rounded-full text-sm inline-block text-center">
                        หน้าแรก
                    </a>
                </div>

                <!-- Content -->
                <div class="col-span-12 md:col-span-8 bg-blue-100 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-white px-4 py-2 rounded-full">
                        จาก ข้าวกล้องพันธุ์สังข์หยดพัทลุง
                    </h3>

                    <!-- Tabs -->
                    <div class="flex justify-around mb-4">
                        <button onclick="showTab('method', this)" class="tab-button bg-yellow-400 px-4 py-2 rounded-full font-semibold text-sm">กรรมวิธีการผลิต</button>
                        <button onclick="showTab('rice', this)" class="tab-button bg-yellow-400 px-4 py-2 rounded-full font-semibold text-sm">ข้อมูลพันธุ์ข้าว</button>
                        <button onclick="showTab('nutrition', this)" class="tab-button bg-yellow-400 px-4 py-2 rounded-full font-semibold text-sm">ข้อมูลโภชนาการ</button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="relative min-h-[320px]">
                        <div id="method" class="tab-content">
                            <div class="bg-orange-100 p-4 rounded-lg mb-4">
                                <h4 class="font-bold mb-2">อุปกรณ์</h4>
                                <ul class="list-disc list-inside text-sm">
                                    <li>ข้าวกล้องข้าวเหนียวดำ ข้าวกล้องพันธุ์สังข์หยดพัทลุง ข้าวกล้องเล็บนกปัตตานี และข้าวกล้องพันธุ์เชียงพัทลุง</li>
                                    <li>น้ำตาลทราย</li>
                                    <li>เครื่องปั่น (blender)</li>
                                    <li>กระทะไฟฟ้า</li>
                                    <li>เครื่องชั่งไฟฟ้า</li>
                                    <li>ตู้อบไฟฟ้า</li>
                                </ul>
                            </div>
                            <div class="bg-orange-100 p-4 rounded-lg">
                                <h4 class="font-bold mb-2">วิธีทำ</h4>
                                <ol class="list-decimal list-inside text-sm space-y-2">
                                    <li>แช่น้ำ ต้มข้าว อุณหภูมิ 60-100°C เป็นเวลา 40 นาที</li>
                                    <li>
                                        บดละเอียด แล้วอัดเป็นแท่ง โดยมี 2 กรรมวิธี:
                                        <ul class="list-disc list-inside ml-4 mt-1">
                                            <li>วิธีที่ 1: ข้าว 100g + น้ำตาล 40g อัดเป็นแผ่น อบ</li>
                                            <li>วิธีที่ 2: ผสมข้าวบด + น้ำตาล แล้วอัดเป็นแท่งในอัตราส่วนต่าง ๆ</li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div id="rice" class="tab-content hidden absolute inset-0">
                            <div class="bg-orange-100 p-4 rounded-lg">
                                <h4 class="font-bold mb-2">ข้อมูลพันธุ์ข้าว</h4>
                                <p class="text-sm">
                                    ข้าวพันธุ์สังข์หยดพัทลุง เป็นข้าวกล้องมีสารต้านอนุมูลอิสระสูง มีธาตุเหล็กและใยอาหารมาก เหมาะสำหรับแปรรูปเพื่อสุขภาพ
                                </p>
                            </div>
                        </div>

                        <div id="nutrition" class="tab-content hidden absolute inset-0">
                            <div class="bg-orange-100 p-4 rounded-lg">
                                <h4 class="font-bold mb-2">ข้อมูลโภชนาการ</h4>
                                <ul class="list-disc list-inside text-sm">
                                    <li>ใยอาหารสูง</li>
                                    <li>มีสารต้านอนุมูลอิสระ</li>
                                    <li>ให้พลังงานพอเหมาะ</li>
                                    <li>มีวิตามินและแร่ธาตุที่จำเป็น</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function showTab(tabId, btn) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.getElementById(tabId).classList.remove('hidden');

            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('bg-yellow-600', 'text-white');
                button.classList.add('bg-yellow-400', 'text-black');
            });
            btn.classList.remove('bg-yellow-400', 'text-black');
            btn.classList.add('bg-yellow-600', 'text-white');
        }

        // แสดงแท็บแรกเมื่อโหลด
        window.onload = () => showTab('method', document.querySelector('.tab-button'));
    </script>



    <?php include '../loadtab/f.php'; ?>
</body>

</html>