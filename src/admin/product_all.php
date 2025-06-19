<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // โหลด Composer autoload

use JasonGrimes\Paginator;

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';

$stmt = $pdo->prepare("SELECT * FROM food_product ORDER BY food_product_id");
$stmt->execute();
$products_food = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM cosmetic_product ORDER BY cosmetic_product_id");
$stmt->execute();
$products_cosmetic = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM medical_product ORDER BY medical_product_id");
$stmt->execute();
$products_medical = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผลิตภัณฑ์ทั้งหมด</title>
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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</head>

<body class="bg t1">
    <?php include '../loadtab/h.php'; ?>
    <!-- Navigation Bar -->
    <?php include './plugin/navbar.php'; ?>

    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="w-full px-6"> <!-- ขยายเต็มจอและมี padding ขอบ -->
            <div class="bg-white p-10 rounded-2xl shadow-xl w-full text-center">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg active"
                                id="sub_tab1-tab"
                                data-tabs-target="#sub_tab1"
                                type="button"
                                role="tab"
                                aria-controls="sub_tab1"
                                aria-selected="true">ผลิตภัณฑ์อาหาร</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg"
                                id="sub_tab2-tab"
                                data-tabs-target="#sub_tab2"
                                type="button"
                                role="tab"
                                aria-controls="sub_tab2"
                                aria-selected="false">ผลิตภัณฑ์เวชสำอาง</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg"
                                id="sub_tab3-tab"
                                data-tabs-target="#sub_tab3"
                                type="button"
                                role="tab"
                                aria-controls="sub_tab3"
                                aria-selected="false">ผลิตภัณฑ์ทางการแพทย์</button>
                        </li>
                    </ul>

                </div>
                <div id="default-tab-content">
                    <div class="p-4 rounded-lg"
                        id="sub_tab1"
                        role="tabpanel"
                        aria-labelledby="sub_tab1-tab">
                        <!-- เนื้อหา tab 1 -->
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full flex flex-col">
                                <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-rose-300 px-4 py-2 rounded-full shadow-md">
                                    ผลิตภัณฑ์อาหาร
                                </h3>
                                <div class="flex justify-end mb-4">
                                    <a href="add_product_food"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-full shadow">
                                        เพิ่มผลิตภัณฑ์
                                    </a>
                                </div>
                                <div class="overflow-x-auto p-6">
                                    <table id="productTable1" class="min-w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                        <thead class="bg-rose-200 text-gray-800">
                                            <tr>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">รูปผลิตภัณฑ์</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">ชื่อผลิตภัณฑ์</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">สายพันธุ์ข้าว</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">แก้ไขข้อมูล</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">ดูรายละเอียด</th>
                                            </tr>

                                        </thead>
                                        <tbody class="bg-white">
                                            <?php foreach ($products_food as $product_food): ?>
                                                <tr class="hover:bg-yellow-50 transition">
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <img src="<?= htmlspecialchars($product_food['picture'] ?? '') ?: '../image/rice_product/A.jpg' ?>"
                                                                alt="<?= htmlspecialchars($product_food['product_name']) ?>"
                                                                class="w-24 h-16 object-cover rounded shadow" />
                                                        </div>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <?= htmlspecialchars($product_food['product_name']) ?>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <?= htmlspecialchars($product_food['rice_variety_th_name']) ?>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <a href="edit_product_food?id=<?= urlencode($product_food['food_product_id']) ?>"
                                                                class="inline-block bg-rose-300 hover:bg-rose-500 text-white text-xs font-medium py-2 px-4 rounded-full shadow transition">
                                                                แก้ไขข้อมูล
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <a href="product_detail?id=<?= urlencode($product_food['food_product_id']) ?>&type=food"
                                                                class="inline-block bg-rose-300 hover:bg-rose-500 text-white text-xs font-medium py-2 px-4 rounded-full shadow transition">
                                                                รายละเอียด
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>


                                <!-- Pagination (responsive) -->
                                <div class="pagination flex flex-wrap justify-center md:justify-end mt-6 space-x-2"></div>
                            </div>
                        </div>


                    </div>
                    <div class="hidden p-4 rounded-lg"
                        id="sub_tab2"
                        role="tabpanel"
                        aria-labelledby="sub_tab2-tab">
                        <!-- เนื้อหา tab 2 -->
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full flex flex-col">
                                <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-violet-300 px-4 py-2 rounded-full shadow-md">
                                    ผลิตภัณฑ์เวชสำอาง
                                </h3>
                                <div class="flex justify-end mb-4">
                                    <a href="add_product_cosmetic"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-full shadow">
                                        เพิ่มผลิตภัณฑ์
                                    </a>
                                </div>
                                <div class="overflow-x-auto p-6">
                                    <table id="productTable2" class="min-w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                        <thead class="bg-violet-200 text-gray-800">
                                            <tr>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">รูปผลิตภัณฑ์</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">ชื่อผลิตภัณฑ์</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">สายพันธุ์ข้าว</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">ดูรายละเอียด</th>
                                            </tr>

                                        </thead>
                                        <tbody class="bg-white">
                                            <?php foreach ($products_cosmetic as $product_cosmetic): ?>
                                                <tr class="hover:bg-yellow-50 transition">
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <img src="<?= htmlspecialchars($product_cosmetic['picture'] ?? '') ?: '../image/rice_product/A.jpg' ?>"
                                                                alt="<?= htmlspecialchars($product_cosmetic['product_name']) ?>"
                                                                class="w-24 h-16 object-cover rounded shadow" />
                                                        </div>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <?= htmlspecialchars($product_cosmetic['product_name']) ?>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <?= htmlspecialchars($product_cosmetic['rice_variety_th_name']) ?>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <a href="product_detail?id=<?= urlencode($product_cosmetic['cosmetic_product_id']) ?>&type=cosmetic"
                                                                class="inline-block bg-violet-300 hover:bg-violet-500 text-white text-xs font-medium py-2 px-4 rounded-full shadow transition">
                                                                รายละเอียด
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>


                                <!-- Pagination (responsive) -->
                                <div class="pagination flex flex-wrap justify-center md:justify-end mt-6 space-x-2"></div>
                            </div>
                        </div>


                    </div>



                    <div class="hidden p-4 rounded-lg"
                        id="sub_tab3"
                        role="tabpanel"
                        aria-labelledby="sub_tab3-tab">
                        <!-- เนื้อหา tab 3 -->
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full flex flex-col">
                                <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-sky-300 px-4 py-2 rounded-full shadow-md">
                                    ผลิตภัณฑ์ทางการแพทย์
                                </h3>
                                <div class="flex justify-end mb-4">
                                    <a href="add_product?type=medical"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-full shadow">
                                        เพิ่มผลิตภัณฑ์
                                    </a>
                                </div>
                                <div class="overflow-x-auto p-6">
                                    <table id="productTable3" class="min-w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                        <thead class="bg-sky-200 text-gray-800">
                                            <tr>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">รูปผลิตภัณฑ์</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">ชื่อผลิตภัณฑ์</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">สายพันธุ์ข้าว</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center align-middle">ดูรายละเอียด</th>
                                            </tr>

                                        </thead>
                                        <tbody class="bg-white">
                                            <?php foreach ($products_medical as $product_medical): ?>
                                                <tr class="hover:bg-yellow-50 transition">
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <img src="<?= htmlspecialchars($product_medical['picture'] ?? '') ?: '../image/rice_product/A.jpg' ?>"
                                                                alt="<?= htmlspecialchars($product_medical['product_name']) ?>"
                                                                class="w-24 h-16 object-cover rounded shadow" />
                                                        </div>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <?= htmlspecialchars($product_medical['product_name']) ?>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <?= htmlspecialchars($product_medical['rice_variety_th_name']) ?>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <div class="flex justify-center items-center">
                                                            <a href="product_detail?id=<?= urlencode($product_medical['medical_product_id']) ?>&type=medical"
                                                                class="inline-block bg-sky-300 hover:bg-sky-500 text-white text-xs font-medium py-2 px-4 rounded-full shadow transition">
                                                                รายละเอียด
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>


                                <!-- Pagination (responsive) -->
                                <div class="pagination flex flex-wrap justify-center md:justify-end mt-6 space-x-2"></div>
                            </div>
                        </div>

                    </div>
                </div>
















            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#productTable1').DataTable({
                    language: {
                        search: "ค้นหา:",
                        lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                        info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                        paginate: {
                            first: "หน้าแรก",
                            last: "หน้าสุดท้าย",
                            next: "ถัดไป",
                            previous: "ก่อนหน้า"
                        },
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    }
                });
            });

            $(document).ready(function() {
                $('#productTable2').DataTable({
                    language: {
                        search: "ค้นหา:",
                        lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                        info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                        paginate: {
                            first: "หน้าแรก",
                            last: "หน้าสุดท้าย",
                            next: "ถัดไป",
                            previous: "ก่อนหน้า"
                        },
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    }
                });
            });

            $(document).ready(function() {
                $('#productTable3').DataTable({
                    language: {
                        search: "ค้นหา:",
                        lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                        info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                        paginate: {
                            first: "หน้าแรก",
                            last: "หน้าสุดท้าย",
                            next: "ถัดไป",
                            previous: "ก่อนหน้า"
                        },
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    }
                });
            });
        </script>

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