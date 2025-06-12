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
include 'sub_detail1.php';
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

    </head>

    <body class="bg t1">
        <?php include '../loadtab/h.php'; ?>

        <div class="flex items-center justify-center min-h-screen p-6">
            <div class="w-full">
                <div class="grid grid-cols-12 gap-1">

                    <!-- Sidebar -->
                    <div class="col-span-12 md:col-span-4 rounded-lg p-6 text-center text-gray-800 flex flex-col items-center" style="background-color: #8b8550;">
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
                    <div class="col-span-12 md:col-span-8 bg-blue-50 rounded-lg p-6">
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
                            <div id="method" class="tab-content">
                                <div class="bg-white p-4 rounded-lg mb-4">
                                    <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">อุปกรณ์</h4>
                                    <div style='border:0px solid #ccc; padding:10px;'>
                                        <?php
                                        if (is_null($ingredients_and_equipment) || $ingredients_and_equipment === '') {
                                            echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                                        } else {
                                            echo $ingredients_and_equipment;
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="bg-white p-4 rounded-lg">
                                    <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">วิธีทำ</h4>
                                    <div style='border:0px solid #ccc; padding:10px;'>
                                        <?php
                                        if (is_null($instructions) || trim($instructions) === '') {
                                            echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                                        } else {
                                            echo $instructions;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <div id="rice" class="tab-content hidden">
                                <div class="bg-white p-4 rounded-lg mx-auto w-full">
                                    <div class="flex justify-center">
                                        <!-- กล่องเนื้อหา -->
                                        <div class="w-full max-w-2xl">
                                            <!-- ข้อมูลทั่วไป -->
                                            <div>
                                                <h4 class="text-sm font-semibold mb-2 bg-white text-center rounded-full w-fit px-4 py-1 mx-auto shadow">
                                                    ข้อมูลทั่วไป
                                                </h4>
                                                <br>
                                                <?php if (!empty($picture_rice)): ?>
                                                    <div class="flex justify-center">
                                                        <img src="<?php echo htmlspecialchars($picture_rice) ?>"
                                                            alt="รูปต้นข้าว"
                                                            class="rounded border object-cover w-48 h-48 cursor-pointer"
                                                            onclick="openImageModal(this.src)" />
                                                    </div>
                                                <?php endif; ?>
                                                <br>

                                                <!-- ตารางข้อมูล -->
                                                <div class="overflow-x-auto">
                                                    <table class="min-w-full text-sm text-gray-700 table-auto">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold whitespace-nowrap">หมายเลขประจำพันธุ์ (G.S. No.):</td>
                                                                <td class="text-left px-2 py-1"><?php echo $gs_no; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">ชื่อพันธุ์ไทย:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($display_thai_name); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">ชื่อพันธุ์อังกฤษ:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($display_english_name); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">ชื่อวิทยาศาสตร์:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($scientific_name); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">นิเวศการปลูกข้าว:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($rice_ecosystem); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">วันเดือนปีที่รับรอง/แนะนำ:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($date_of_approval_or_recommendation); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">สภาพภาพทั่วไป:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($general_status); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">อายุเก็บเกี่ยว (วัน):</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($harvest_age_days); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left px-2 py-1 font-semibold">ความไวต่อช่วงแสง:</td>
                                                                <td class="text-left px-2 py-1"><?php echo htmlspecialchars($photoperiod_sensitivity); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- overflow-x-auto -->
                                                <?php if (!empty($link_url)): ?>
                                                    <div class="mt-4 text-center">
                                                        <a href="<?php echo htmlspecialchars($link_url); ?>"
                                                            target="_blank"
                                                            class="inline-block bg-[#454b0b] hover:bg-[#5c6113] text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                                                            ดูข้อมูลพันธุ์ข้าวเพิ่มเติม
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="nutrition" class="tab-content hidden">
                                <div class="bg-white p-4 rounded-lg">
                                    <h4 class="inline-block font-bold mb-4 bg-white px-6 py-2 rounded-full text-sm mx-auto shadow"> กำลังดำเนินการพัฒนา Code เริ่ม 12 / 06 / 2568 </h4>
                                    <div class="overflow-x-auto">
                                        
                                    </div>
                                </div>
                            </div>
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
