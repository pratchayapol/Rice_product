<?php
// รับ id จาก query string
$id = $_GET['id'] ?? null;
if (!$id) {
    // รีไดเรคหรือแสดง error
    exit('ไม่พบสินค้า');
}

// เชื่อมฐานข้อมูลและดึงข้อมูลสินค้า
// $product = ... query db where food_product_id = $id

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>แก้ไขข้อมูลผลิตภัณฑ์</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
<body>

<h2>แก้ไขข้อมูลผลิตภัณฑ์</h2>

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

<script>
ClassicEditor.create(document.querySelector('#ingredients_th'));
ClassicEditor.create(document.querySelector('#method_th'));
ClassicEditor.create(document.querySelector('#ingredients_en'));
ClassicEditor.create(document.querySelector('#method_en'));
</script>

</body>
</html>
