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

$stmt = $pdo->prepare("SELECT * FROM food_product ORDER BY food_product_id");
$stmt->execute();
$products_food = $stmt->fetchAll();

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

    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="w-full px-6"> <!-- ขยายเต็มจอและมี padding ขอบ -->
            <div class="bg-white p-10 rounded-2xl shadow-xl w-full text-center">

                <form method="POST" action="update_product.php" enctype="multipart/form-data">
                    <input type="hidden" name="food_product_id" value="<?= htmlspecialchars($product['food_product_id']) ?>">

                    ชื่อผลิตภัณฑ์:<br>
                    <input type="text" name="product_name_th" value="<?= htmlspecialchars($product['product_name_th']) ?>" required><br>

                    ชื่อผลิตภัณฑ์อังกฤษแบบไทย:<br>
                    <input type="text" name="product_name_eng_thai" value="<?= htmlspecialchars($product['product_name_eng_thai']) ?>" required><br>

                    ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บข้างหลัง):<br>
                    <input type="text" name="product_name_eng" value="<?= htmlspecialchars($product['product_name_eng']) ?>" required><br>

                    ประเภท:<br>
                    <select name="category" required>
                        <option value="ผลิตภัณฑ์จากเมล็ดข้าว" <?= $product['category'] === 'ผลิตภัณฑ์จากเมล็ดข้าว' ? 'selected' : '' ?>>ผลิตภัณฑ์จากเมล็ดข้าว</option>
                        <option value="ผลิตภัณฑ์จากแป้งข้าว" <?= $product['category'] === 'ผลิตภัณฑ์จากแป้งข้าว' ? 'selected' : '' ?>>ผลิตภัณฑ์จากแป้งข้าว</option>
                        <option value="ผลิตภัณฑ์จากการหมัก" <?= $product['category'] === 'ผลิตภัณฑ์จากการหมัก' ? 'selected' : '' ?>>ผลิตภัณฑ์จากการหมัก</option>
                        <option value="ผลิตภัณฑ์จากส่วนอื่นๆ" <?= $product['category'] === 'ผลิตภัณฑ์จากส่วนอื่นๆ' ? 'selected' : '' ?>>ผลิตภัณฑ์จากส่วนอื่นๆ</option>
                    </select><br>

                    กลุ่มย่อย:<br>
                    <select name="subcategory" required>
                        <option value="อาหาร" <?= $product['subcategory'] === 'อาหาร' ? 'selected' : '' ?>>อาหาร</option>
                        <option value="ขนม" <?= $product['subcategory'] === 'ขนม' ? 'selected' : '' ?>>ขนม</option>
                        <option value="เครื่องดื่ม" <?= $product['subcategory'] === 'เครื่องดื่ม' ? 'selected' : '' ?>>เครื่องดื่ม</option>
                        <option value="เครื่องปรุงรส" <?= $product['subcategory'] === 'เครื่องปรุงรส' ? 'selected' : '' ?>>เครื่องปรุงรส</option>
                    </select><br>

                    กลุ่มพันธุ์ข้าวภาษาไทย:<br>
                    <input type="text" name="rice_group_th" value="<?= htmlspecialchars($product['rice_group_th'] ?? 'ข้าวอื่น ๆ') ?>" required><br>

                    กลุ่มพันธุ์ข้าวภาษาอังกฤษ:<br>
                    <input type="text" name="rice_group_eng" value="<?= htmlspecialchars($product['rice_group_eng'] ?? 'ข้าวอื่น ๆ') ?>" required><br>

                    ที่มา URL:<br>
                    <input type="url" name="source_url" value="<?= htmlspecialchars($product['source_url']) ?>"><br>

                    ที่มา:<br>
                    <input type="text" name="source" value="<?= htmlspecialchars($product['source']) ?>"><br>

                    วัตถุดิบและอุปกรณ์:<br>
                    <textarea id="ingredients_th" name="ingredients_th"><?= htmlspecialchars($product['ingredients_th']) ?></textarea><br>

                    วิธีทำ:<br>
                    <textarea id="method_th" name="method_th"><?= htmlspecialchars($product['method_th']) ?></textarea><br>

                    วัตถุดิบและอุปกรณ์ภาษาอังกฤษ:<br>
                    <textarea id="ingredients_en" name="ingredients_en"><?= htmlspecialchars($product['ingredients_en']) ?></textarea><br>

                    วิธีทำภาษาอังกฤษ:<br>
                    <textarea id="method_en" name="method_en"><?= htmlspecialchars($product['method_en']) ?></textarea><br>

                    ภาพผลิตภัณฑ์:<br>
                    <input type="file" name="product_image" accept="image/*"><br>

                    <button type="submit">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        ClassicEditor.create(document.querySelector('#ingredients_th'));
        ClassicEditor.create(document.querySelector('#method_th'));
        ClassicEditor.create(document.querySelector('#ingredients_en'));
        ClassicEditor.create(document.querySelector('#method_en'));
    </script>

</body>

</html>