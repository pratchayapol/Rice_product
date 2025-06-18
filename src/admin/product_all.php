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
                                    <a href="add_product?type=food"
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
                                                            <button
                                                                onclick="openModal('modal-<?= $product_food['food_product_id'] ?>')"
                                                                class="inline-block bg-rose-300 hover:bg-rose-500 text-white text-xs font-medium py-2 px-4 rounded-full shadow transition">
                                                                แก้ไขข้อมูล
                                                            </button>
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

                                <!-- Modal -->
                                <div id="modal-<?= $product_food['food_product_id'] ?>" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
                                        <button
                                            onclick="closeModal('modal-<?= $product_food['food_product_id'] ?>')"
                                            class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>

                                        <h2 class="text-xl font-semibold mb-4">แก้ไขข้อมูลผลิตภัณฑ์</h2>

                                        <form method="POST" action="update_product.php" enctype="multipart/form-data" class="space-y-4">

                                            <!-- ชื่อผลิตภัณฑ์ -->
                                            <div>
                                                <label for="product_name_th" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์</label>
                                                <input type="text" id="product_name_th" name="product_name_th" class="w-full border rounded px-3 py-2" required>
                                            </div>

                                            <!-- ชื่อผลิตภัณฑ์อังกฤษแบบไทย -->
                                            <div>
                                                <label for="product_name_eng_thai" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์อังกฤษแบบไทย</label>
                                                <input type="text" id="product_name_eng_thai" name="product_name_eng_thai" class="w-full border rounded px-3 py-2" required>
                                            </div>

                                            <!-- ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บข้างหลัง) -->
                                            <div>
                                                <label for="product_name_eng" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บข้างหลัง)</label>
                                                <input type="text" id="product_name_eng" name="product_name_eng" class="w-full border rounded px-3 py-2" required>
                                            </div>

                                            <!-- ประเภท -->
                                            <div>
                                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">ประเภท</label>
                                                <select id="category" name="category" class="w-full border rounded px-3 py-2" required>
                                                    <option value="">-- กรุณาเลือกประเภท --</option>
                                                    <option value="ผลิตภัณฑ์จากเมล็ดข้าว">ผลิตภัณฑ์จากเมล็ดข้าว</option>
                                                    <option value="ผลิตภัณฑ์จากแป้งข้าว">ผลิตภัณฑ์จากแป้งข้าว</option>
                                                    <option value="ผลิตภัณฑ์จากการหมัก">ผลิตภัณฑ์จากการหมัก</option>
                                                    <option value="ผลิตภัณฑ์จากส่วนอื่นๆ">ผลิตภัณฑ์จากส่วนอื่นๆ</option>
                                                </select>
                                            </div>

                                            <!-- กลุ่มย่อย -->
                                            <div>
                                                <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มย่อย</label>
                                                <select id="subcategory" name="subcategory" class="w-full border rounded px-3 py-2" required>
                                                    <option value="">-- กรุณาเลือกกลุ่มย่อย --</option>
                                                    <option value="อาหาร">อาหาร</option>
                                                    <option value="ขนม">ขนม</option>
                                                    <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                                    <option value="เครื่องปรุงรส">เครื่องปรุงรส</option>
                                                </select>
                                            </div>

                                            <!-- กลุ่มพันธุ์ข้าวภาษาไทย -->
                                            <div>
                                                <label for="rice_group_th" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาไทย</label>
                                                <input type="text" id="rice_group_th" name="rice_group_th" class="w-full border rounded px-3 py-2" value="ข้าวอื่น ๆ" required>
                                            </div>

                                            <!-- กลุ่มพันธุ์ข้าวภาษาอังกฤษ -->
                                            <div>
                                                <label for="rice_group_eng" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาอังกฤษ</label>
                                                <input type="text" id="rice_group_eng" name="rice_group_eng" class="w-full border rounded px-3 py-2" value="ข้าวอื่น ๆ" required>
                                            </div>

                                            <!-- ที่มา URL -->
                                            <div>
                                                <label for="source_url" class="block text-sm font-medium text-gray-700 mb-1">ที่มา URL <span class="text-gray-500">(วางลิงค์ข้อมูล)</span></label>
                                                <input type="url" id="source_url" name="source_url" placeholder="https://example.com" class="w-full border rounded px-3 py-2">
                                            </div>

                                            <!-- ที่มา -->
                                            <div>
                                                <label for="source" class="block text-sm font-medium text-gray-700 mb-1">ที่มา <span class="text-gray-500">(เช่น หน่วยงานที่รับรองผลิตภัณฑ์)</span></label>
                                                <input type="text" id="source" name="source" class="w-full border rounded px-3 py-2">
                                            </div>

                                            <!-- วัตถุดิบและอุปกรณ์ (ckeditor) -->
                                            <div>
                                                <label for="ingredients_th" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์</label>
                                                <textarea id="ingredients_th" name="ingredients_th" class="w-full border rounded px-3 py-2" rows="5"></textarea>
                                            </div>

                                            <!-- วิธีทำ (ckeditor) -->
                                            <div>
                                                <label for="method_th" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำ</label>
                                                <textarea id="method_th" name="method_th" class="w-full border rounded px-3 py-2" rows="5"></textarea>
                                            </div>

                                            <!-- วัตถุดิบและอุปกรณ์ภาษาอังกฤษ (ckeditor) -->
                                            <div>
                                                <label for="ingredients_en" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์ภาษาอังกฤษ</label>
                                                <textarea id="ingredients_en" name="ingredients_en" class="w-full border rounded px-3 py-2" rows="5"></textarea>
                                            </div>

                                            <!-- วิธีทำภาษาอังกฤษ (ckeditor) -->
                                            <div>
                                                <label for="method_en" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำภาษาอังกฤษ</label>
                                                <textarea id="method_en" name="method_en" class="w-full border rounded px-3 py-2" rows="5"></textarea>
                                            </div>

                                            <!-- ภาพผลิตภัณฑ์ (ไฟล์) -->
                                            <div>
                                                <label for="product_image" class="block text-sm font-medium text-gray-700 mb-1">ภาพผลิตภัณฑ์ (ไฟล์ภาพ 1 รูป)</label>
                                                <input type="file" id="product_image" name="product_image" accept="image/*" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-rose-50 file:text-rose-700
      hover:file:bg-rose-100
    ">
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2 px-6 rounded-lg shadow">
                                                    บันทึก
                                                </button>
                                            </div>

                                        </form>

                                        <!-- CKEditor 5 CDN -->
                                        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
                                        <script>
                                            ClassicEditor
                                                .create(document.querySelector('#ingredients_th'))
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                            ClassicEditor
                                                .create(document.querySelector('#method_th'))
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                            ClassicEditor
                                                .create(document.querySelector('#ingredients_en'))
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                            ClassicEditor
                                                .create(document.querySelector('#method_en'))
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                        </script>
                                    </div>
                                </div>

                                <script>
                                    function openModal(id) {
                                        document.getElementById(id).classList.remove('hidden');
                                    }

                                    function closeModal(id) {
                                        document.getElementById(id).classList.add('hidden');
                                    }
                                </script>
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
                                    <a href="add_product?type=cosmetic"
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