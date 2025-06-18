<?php

session_start();
// รับ id จาก query string
$id = $_GET['id'] ?? null;
if (!$id) {
    // รีไดเรคหรือแสดง error
    exit('ไม่พบสินค้า');
}



require_once __DIR__ . '/../vendor/autoload.php'; // โหลด Composer autoload

use JasonGrimes\Paginator;

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';

$stmt = $pdo->prepare("SELECT * FROM food_product WHERE food_product_id = :id");
$stmt->execute(['id' => $id]);
$products_food = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$products_food) {
    exit('ไม่พบข้อมูลผลิตภัณฑ์ที่ต้องการแก้ไข');
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผลิตภัณฑ์</title>
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

    <div class="pt-24 flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-3xl bg-white p-10 rounded-2xl shadow-xl">
            <h2 class="text-3xl font-semibold mb-8 text-center text-rose-600">แก้ไขข้อมูลผลิตภัณฑ์</h2>

            <form method="POST" action="update_product.php" enctype="multipart/form-data" class="space-y-6">

                <input type="hidden" name="food_product_id" value="<?= htmlspecialchars($products_food['food_product_id']) ?>">

                <!-- ชื่อผลิตภัณฑ์ -->
                <div>
                    <label for="product_name_th" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์</label>
                    <input type="text" id="product_name_th" name="product_name_th" value="<?= htmlspecialchars($products_food['product_name']) ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ชื่อผลิตภัณฑ์อังกฤษแบบไทย -->
                <div>
                    <label for="product_name_eng_thai" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์อังกฤษแบบไทย</label>
                    <input type="text" id="product_name_eng_thai" name="product_name_eng_thai" value="<?= htmlspecialchars($products_food['product_name_th']) ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ชื่อผลิตภัณฑ์ภาษาอังกฤษ -->
                <div>
                    <label for="product_name_eng" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บข้างหลัง)</label>
                    <input type="text" id="product_name_eng" name="product_name_eng" value="<?= htmlspecialchars($products_food['product_name_en']) ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ประเภท -->
                <div>
                    <label for="product_group" class="block text-sm font-medium text-gray-700 mb-1">ประเภท</label>
                    <select id="product_group" name="product_group" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400">
                        <option value="">-- กรุณาเลือกประเภท --</option>
                        <option value="ผลิตภัณฑ์จากเมล็ดข้าว" <?= $products_food['product_group'] === 'ผลิตภัณฑ์จากเมล็ดข้าว' ? 'selected' : '' ?>>ผลิตภัณฑ์จากเมล็ดข้าว</option>
                        <option value="ผลิตภัณฑ์จากแป้งข้าว" <?= $products_food['product_group'] === 'ผลิตภัณฑ์จากแป้งข้าว' ? 'selected' : '' ?>>ผลิตภัณฑ์จากแป้งข้าว</option>
                        <option value="ผลิตภัณฑ์จากการหมัก" <?= $products_food['product_group'] === 'ผลิตภัณฑ์จากการหมัก' ? 'selected' : '' ?>>ผลิตภัณฑ์จากการหมัก</option>
                        <option value="ผลิตภัณฑ์จากส่วนอื่นๆ" <?= $products_food['product_group'] === 'ผลิตภัณฑ์จากส่วนอื่นๆ' ? 'selected' : '' ?>>ผลิตภัณฑ์จากส่วนอื่นๆ</option>
                    </select>
                </div>

                <!-- กลุ่มย่อย -->
                <div>
                    <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มย่อย</label>
                    <select id="subcategory" name="subcategory" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400">
                        <option value="">-- กรุณาเลือกกลุ่มย่อย --</option>
                        <option value="อาหาร" <?= $products_food['category'] === 'อาหาร' ? 'selected' : '' ?>>อาหาร</option>
                        <option value="อาหารว่าง" <?= $products_food['category'] === 'อาหารว่าง' ? 'selected' : '' ?>>ขนม</option>
                        <option value="เครื่องดื่ม" <?= $products_food['category'] === 'เครื่องดื่ม' ? 'selected' : '' ?>>เครื่องดื่ม</option>
                        <option value="เครื่องปรุงรส" <?= $products_food['category'] === 'เครื่องปรุงรส' ? 'selected' : '' ?>>เครื่องปรุงรส</option>
                    </select>
                </div>

                <!-- กลุ่มพันธุ์ข้าวภาษาไทย -->
                <div>
                    <label for="rice_group_th" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาไทย</label>
                    <input type="text" id="rice_group_th" name="rice_group_th" value="<?= htmlspecialchars($products_food['rice_variety_group_th_name'] ?? 'ข้าวอื่น ๆ') ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- กลุ่มพันธุ์ข้าวภาษาอังกฤษ -->
                <div>
                    <label for="rice_group_eng" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาอังกฤษ</label>
                    <input type="text" id="rice_group_eng" name="rice_group_eng" value="<?= htmlspecialchars($products_food['rice_variety_group_en_name'] ?? 'ข้าวอื่น ๆ') ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ที่มา URL -->
                <div>
                    <label for="source_url" class="block text-sm font-medium text-gray-700 mb-1">ที่มา URL <span class="text-gray-400 text-xs">(วางลิงค์ข้อมูล)</span></label>
                    <input type="url" id="source_url" name="source_url" value="<?= htmlspecialchars($products_food['source_url']) ?>"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ที่มา -->
                <div>
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-1">ที่มา <span class="text-gray-400 text-xs">(เช่น หน่วยงานที่รับรองผลิตภัณฑ์)</span></label>
                    <input type="text" id="source" name="source" value="<?= htmlspecialchars($products_food['source']) ?>"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- วัตถุดิบและอุปกรณ์ -->
                <div>
                    <label for="ingredients_th" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์</label>
                    <textarea id="ingredients_th" name="ingredients_th" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($products_food['ingredients_and_equipment']) ?></textarea>
                </div>

                <!-- วิธีทำ -->
                <div>
                    <label for="method_th" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำ</label>
                    <textarea id="method_th" name="method_th" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($products_food['instructions']) ?></textarea>
                </div>

                <!-- วัตถุดิบและอุปกรณ์ภาษาอังกฤษ -->
                <div>
                    <label for="ingredients_en" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์ภาษาอังกฤษ</label>
                    <textarea id="ingredients_en" name="ingredients_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($products_food['ingredients_and_equipment_en']) ?></textarea>
                </div>

                <!-- วิธีทำภาษาอังกฤษ -->
                <div>
                    <label for="method_en" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำภาษาอังกฤษ</label>
                    <textarea id="method_en" name="method_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($products_food['instructions_en']) ?></textarea>
                </div>

                <!-- ภาพผลิตภัณฑ์ -->
                <div>
                    <label for="product_image" class="block text-sm font-medium text-gray-700 mb-1">ภาพผลิตภัณฑ์</label>
                    <input type="file" id="product_image" name="product_image" accept="image/*"
                        class="w-full text-gray-600 file:border file:border-gray-300 file:rounded file:px-3 file:py-2 file:bg-gray-50 file:text-gray-700 hover:file:bg-rose-100 transition" />
                </div>

                <!-- ปุ่มบันทึก -->
                <div class="text-center">
                    <button type="submit"
                        class="inline-block bg-rose-500 hover:bg-rose-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition">
                        บันทึกข้อมูล
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#ingredients_th'));
        ClassicEditor.create(document.querySelector('#method_th'));
        ClassicEditor.create(document.querySelector('#ingredients_en'));
        ClassicEditor.create(document.querySelector('#method_en'));
    </script>

</body>

</html>