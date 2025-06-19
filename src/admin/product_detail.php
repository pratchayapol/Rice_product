<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';
//รับค่า id และ type
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($id > 0) {

    //ไฟล์นี้เป็นการค้นหาข้อมูลแปรรูปผลิตภัณฑ์ทั้ง 3 table และ table rice (ข้อมูลข้าว)
    include 'sub_detail1.1.php';


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

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
        <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>

    </head>

    <body class="bg t1">
        <?php include '../loadtab/h.php'; ?>

        <div class="flex items-center justify-center min-h-screen p-6">
            <div class="w-full">
                <div class="grid grid-cols-12 gap-1">

                    <!-- Sidebar -->
                    <div class="col-span-12 md:col-span-3 rounded-lg p-6 text-center text-gray-800 flex flex-col items-center" style="background-color: #8b8550;">
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-white px-4 py-2 rounded-full">ผลิตภัณฑ์ <?php echo $product_name ?></h3>

                        <?php
                        $excludeImage = '../image/rice_product/A.jpg';
                        if (!empty($picture) && $picture !== $excludeImage): ?>
                            <div class="bg-white h-40 w-full rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                                <img src="<?= htmlspecialchars($picture) ?>" alt="Product Image" class="h-full object-contain" onclick="openImageModal(this.src)">
                            </div>
                        <?php endif; ?>

                        <p class="text-sm mb-4">
                            ที่มา : <a href="<?php echo $source_url ?>" class="text-inherit no-underline" target="_blank" rel="noopener noreferrer">
                                <?php echo $source ?>
                            </a>
                        </p>

                        <a href="./dashboard" class="bg-yellow-400 text-black px-4 py-2 rounded-full text-sm inline-block text-center">
                            หน้าแรก
                        </a>
                    </div>

                    <!-- Content -->
                    <div class="col-span-12 md:col-span-9 bg-blue-50 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-white px-4 py-2 rounded-full">
                            จาก ข้าวพันธุ์<?php echo $thai_name . ' ( ' . $english_name . ' )' ?>
                        </h3>

                        <!-- Tabs -->
                        <div class="flex justify-around mb-4">
                            <button onclick="showTab('method', this)" class="tab-button bg-yellow-400 px-4 py-2 rounded-full font-semibold text-sm">กรรมวิธีการผลิต</button>
                            <button onclick="showTab('rice', this)" class="tab-button bg-yellow-400 px-4 py-2 rounded-full font-semibold text-sm">ข้อมูลพันธุ์ข้าว</button>
                            <button onclick="showTab('nutrition', this)" class="tab-button bg-yellow-400 px-4 py-2 rounded-full font-semibold text-sm">ข้อมูลโภชนาการ</button>
                        </div>

                        <!-- Tab Contents -->



                        <div class="relative">
                            <?php
                            include 'sub_detail2.1.php'; //tab กรรมวิธีการผลิต
                            include 'sub_detail2.2.php'; //tab ข้อมูลพันธุ์ข้าว

                            include 'sub_detail2.3.php'; //tab ข้อมูลโภชนาการ
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal เต็มจอ (ใช้ร่วมกัน) -->
        <div id="imageModal"
            class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center hidden"
            onclick="closeImageModal()">
            <img id="modalImage" src="" alt="รูปเต็ม" class="max-w-full max-h-full rounded shadow-lg">
        </div>




        <script>
            function openImageModal(src) {
                const modal = document.getElementById("imageModal");
                const img = document.getElementById("modalImage");
                img.src = src;
                modal.classList.remove("hidden");
            }

            function closeImageModal() {
                const modal = document.getElementById("imageModal");
                modal.classList.add("hidden");
            }

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


        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            function createReadOnlyEditor(selector) {
                ClassicEditor.create(document.querySelector(selector), {
                        toolbar: [], // ไม่มี toolbar
                    })
                    .then(editor => {
                        // ทำให้เป็น read-only
                        editor.isReadOnly = true;

                        // ซ่อนเส้นขอบ (ต้องใช้ CSS เพิ่มเติม)
                        editor.ui.view.editable.element.style.border = "none";
                        editor.ui.view.editable.element.style.backgroundColor = "transparent";
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            createReadOnlyEditor('#ingredients_th');
            createReadOnlyEditor('#instructions');

            ClassicEditor.create(document.querySelector('#ingredients_and_equipment_en'));
            ClassicEditor.create(document.querySelector('#instructions_en'));
        </script>
        <?php include '../loadtab/f.php'; ?>
    </body>

    </html>

<?php

} else {
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
        <div class="flex items-center justify-center min-h-screen p-6">
            <div class="max-w-7xl w-full">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 md:col-span-12 bg-pink-100 rounded-lg p-6 text-center text-gray-800 flex flex-col items-center">
                        <h1 class="text-xl md:text-3xl font-semibold">ไม่มี ID นี้ในการตรวจสอบ</h1>
                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>
<?
}
