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

$stmt = $pdo->prepare("SELECT * FROM medical_product WHERE medical_product_id = :id");
$stmt->execute(['id' => $id]);
$products_medical = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$products_medical) {
    exit('ไม่พบข้อมูลผลิตภัณฑ์ที่ต้องการแก้ไข');
}

if (!empty($products_medical['rice_id'])) {
    // ดึงข้อมูลชื่อพันธุ์ข้าว
    $stmt = $pdo->prepare("SELECT thai_breed_name, english_breed_name FROM rice WHERE rice_id = ?");
    $stmt->execute([$products_medical['rice_id']]);
    $rice = $stmt->fetch();

    if ($rice) {
        $riceNameLabel = $rice['thai_breed_name'];
        if (!empty($rice['english_breed_name'])) {
            $riceNameLabel .= ' (' . $rice['english_breed_name'] . ')';
        }
        $riceIdValue = $products_medical['rice_id'];
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผลิตภัณฑ์ทางการแพทย์</title>
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
            <h2 class="text-3xl font-semibold mb-8 text-center text-sky-600">แก้ไขข้อมูลผลิตภัณฑ์ทางการแพทย์</h2>

            <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">

                <input type="hidden" name="medical_product_id" value="<?= htmlspecialchars($products_medical['medical_product_id']) ?>">

                <!-- ชื่อผลิตภัณฑ์ -->
                <div>
                    <label for="product_name_th" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์</label>
                    <input type="text" id="product_name_th" name="product_name"
                        value="<?= htmlspecialchars($products_medical['product_name'] ?? '') !== '' ? htmlspecialchars($products_medical['product_name']) : 'รอเจ้าหน้าที่เพิ่มข้อมูล' ?>"
                        required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>

                <!-- ชื่อผลิตภัณฑ์อังกฤษแบบไทย -->
                <div>
                    <label for="product_name_eng_thai" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์อังกฤษแบบไทย</label>
                    <input type="text" id="product_name_eng_thai" name="product_name_th"
                        value="<?= htmlspecialchars($products_medical['product_name_th'] ?? '') !== '' ? htmlspecialchars($products_medical['product_name_th']) : 'รอเจ้าหน้าที่เพิ่มข้อมูล' ?>"
                        required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>

                <!-- ชื่อผลิตภัณฑ์ภาษาอังกฤษ -->
                <div>
                    <label for="product_name_eng" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บข้างหลัง)</label>
                    <input type="text" id="product_name_eng" name="product_name_en"
                        value="<?= htmlspecialchars($products_medical['product_name_en'] ?? '') !== '' ? htmlspecialchars($products_medical['product_name_en']) : 'รอเจ้าหน้าที่เพิ่มข้อมูล' ?>"
                        required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>


                <!-- ประเภท -->
                <div>
                    <label for="product_group" class="block text-sm font-medium text-gray-700 mb-1">ประเภท</label>
                    <select id="product_group" name="product_group" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-sky-400">
                        <option value="">-- เลือกประเภท --</option>
                        <option value="เวชภัณฑ์จากสารออกฤทธิ์ในข้าว" <?= $products_medical['product_group'] === 'เวชภัณฑ์จากสารออกฤทธิ์ในข้าว' ? 'selected' : '' ?>>เวชภัณฑ์จากสารออกฤทธิ์ในข้าว</option>
                        <option value="วัสดุทางการแพทย์จากข้าว" <?= $products_medical['product_group'] === 'วัสดุทางการแพทย์จากข้าว' ? 'selected' : '' ?>>วัสดุทางการแพทย์จากข้าว</option>
                        <option value="ผลิตภัณฑ์ดูแลผิวสำหรับผู้ป่วย" <?= $products_medical['product_group'] === 'ผลิตภัณฑ์ดูแลผิวสำหรับผู้ป่วย' ? 'selected' : '' ?>>ผลิตภัณฑ์ดูแลผิวสำหรับผู้ป่วย</option>
                        <option value="ผลิตภัณฑ์เฉพาะโรค" <?= $products_medical['product_group'] === 'ผลิตภัณฑ์เฉพาะโรค' ? 'selected' : '' ?>>ผลิตภัณฑ์เฉพาะโรค</option>
                    </select>
                </div>

                <!-- กลุ่มย่อย -->
                <div id="subcategory-div">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มย่อย</label>
                    <select id="category" name="category"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-sky-400">
                        <option value="">-- เลือกกลุ่มย่อย --</option>
                        <?php
                        $group = $products_medical['product_group'];
                        $category = $products_medical['category'];
                        $subcategories = [
                            // หากมีประเภทไหนที่ต้องมีกลุ่มย่อยในอนาคต สามารถใส่เพิ่มที่นี่
                        ];
                        if (isset($subcategories[$group])) {
                            foreach ($subcategories[$group] as $item) {
                                $selected = ($category === $item) ? 'selected' : '';
                                echo "<option value=\"$item\" $selected>$item</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <script>
                    const subcategories = {
                        // เพิ่มกลุ่มย่อยในอนาคตตรงนี้ได้ เช่น:
                        // "เวชภัณฑ์จากสารออกฤทธิ์ในข้าว": ["แผ่นแปะ", "แคปซูล"],
                    };

                    const productGroupSelect = document.getElementById("product_group");
                    const categorySelect = document.getElementById("category");

                    function populateSubcategories(selectedGroup, currentValue = '') {
                        const options = subcategories[selectedGroup] || [];
                        categorySelect.innerHTML = '<option value="">-- เลือกกลุ่มย่อย --</option>';

                        options.forEach(sub => {
                            const opt = document.createElement("option");
                            opt.value = sub;
                            opt.textContent = sub;
                            if (sub === currentValue) opt.selected = true;
                            categorySelect.appendChild(opt);
                        });
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        const selectedGroup = productGroupSelect.value;
                        const currentCategory = "<?= $products_medical['category'] ?>";
                        if (selectedGroup) populateSubcategories(selectedGroup, currentCategory);
                    });

                    productGroupSelect.addEventListener("change", function() {
                        populateSubcategories(this.value);
                    });
                </script>



                <!-- แปรรูปจากพันธุ์ข้าว -->
                <div>
                    <label for="rice_label" class="block text-sm font-medium text-gray-700 mb-1">แปรรูปจากพันธุ์ข้าว</label>

                    <!-- input แสดงชื่อพันธุ์ข้าว -->
                    <!-- input แสดงชื่อพันธุ์ข้าว -->
                    <input type="text" id="rice_label" name="rice_label"
                        list="riceSuggestions"
                        value="<?= htmlspecialchars($riceNameLabel ?? '') ?>"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400"
                        oninput="fetchRiceSuggestions(this.value)" autocomplete="off" />

                    <!-- datalist -->
                    <datalist id="riceSuggestions"></datalist>

                    <!-- hidden fields -->
                    <input type="hidden" id="rice_id" name="rice_id" value="<?= htmlspecialchars($riceIdValue ?? '') ?>" />
                    <input type="hidden" id="thai_name" name="thai_name" value="<?= htmlspecialchars($thaiNameValue ?? '') ?>" />
                    <input type="hidden" id="english_name" name="english_name" value="<?= htmlspecialchars($englishNameValue ?? '') ?>" />
                </div>

                <script>
                    function fetchRiceSuggestions(query) {
                        if (query.length < 2) return;

                        fetch("search_rice.php?q=" + encodeURIComponent(query))
                            .then(response => response.json())
                            .then(data => {
                                const datalist = document.getElementById("riceSuggestions");
                                datalist.innerHTML = "";

                                data.forEach(item => {
                                    const option = document.createElement("option");
                                    option.value = item.label;
                                    option.dataset.id = item.id;
                                    option.dataset.thai = item.thai;
                                    option.dataset.english = item.english;
                                    datalist.appendChild(option);
                                });
                            });
                    }

                    document.getElementById("rice_label").addEventListener("change", function() {
                        const inputVal = this.value;
                        const options = document.querySelectorAll("#riceSuggestions option");

                        const hiddenId = document.getElementById("rice_id");
                        const thaiName = document.getElementById("thai_name");
                        const englishName = document.getElementById("english_name");

                        let matched = false;

                        options.forEach(opt => {
                            if (opt.value === inputVal) {
                                hiddenId.value = opt.dataset.id;
                                thaiName.value = opt.dataset.thai || "";
                                englishName.value = opt.dataset.english || "";
                                matched = true;
                            }
                        });

                        if (!matched) {
                            hiddenId.value = "";
                            thaiName.value = "";
                            englishName.value = "";
                        }
                    });
                </script>

                <!-- กลุ่มพันธุ์ข้าวภาษาไทย -->
                <div>
                    <label for="rice_variety_group_th_name" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาไทย</label>
                    <input type="text" id="rice_variety_group_th_name" name="rice_variety_group_th_name" value="<?= htmlspecialchars($products_medical['rice_variety_group_th_name'] ?? 'ข้าวอื่น ๆ') ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>

                <!-- กลุ่มพันธุ์ข้าวภาษาอังกฤษ -->
                <div>
                    <label for="rice_variety_group_en_name" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาอังกฤษ</label>
                    <input type="text" id="rice_variety_group_en_name" name="rice_variety_group_en_name" value="<?= htmlspecialchars($products_medical['rice_variety_group_en_name'] ?? 'ข้าวอื่น ๆ') ?>" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>

                <!-- ที่มา URL -->
                <div>
                    <label for="source_url" class="block text-sm font-medium text-gray-700 mb-1">ที่มา URL <span class="text-gray-400 text-xs">(วางลิงค์ข้อมูล)</span></label>
                    <input type="url" id="source_url" name="source_url" value="<?= htmlspecialchars($products_medical['source_url']) ?>"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>

                <!-- ที่มา -->
                <div>
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-1">ที่มา <span class="text-gray-400 text-xs">(เช่น หน่วยงานที่รับรองผลิตภัณฑ์)</span></label>
                    <input type="text" id="source" name="source" value="<?= htmlspecialchars($products_medical['source']) ?>"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400" />
                </div>

                <!-- ที่มา Genbank url -->
                <div>
                    <label for="genbank_url" class="block text-sm font-medium text-gray-700 mb-1">ที่มา Genbank url <span class="text-gray-400 text-xs"></span></label>
                    <input type="text" id="genbank_url" name="genbank_url" value="<?= htmlspecialchars($products_medical['genbank_url'] ?? '') !== '' ? htmlspecialchars($products_medical['genbank_url']) : 'รอเจ้าหน้าที่เพิ่มข้อมูล' ?>"
                        placeholder="ลิงค์ข้อมูลข้าวจาก Genbank"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- วัตถุดิบและอุปกรณ์ -->
                <div>
                    <label for="ingredients_th" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์</label>
                    <textarea id="ingredients_th" name="ingredients_and_equipment" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400"><?= htmlspecialchars($products_medical['ingredients_and_equipment'] ?? 'รอเจ้าหน้าที่เพิ่มข้อมูล') ?></textarea>
                </div>

                <!-- วิธีทำ -->
                <div>
                    <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำ</label>
                    <textarea id="instructions" name="instructions" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400"><?= htmlspecialchars($products_medical['instructions'] ?? 'รอเจ้าหน้าที่เพิ่มข้อมูล') ?></textarea>
                </div>

                <!-- วัตถุดิบและอุปกรณ์ภาษาอังกฤษ -->
                <div>
                    <label for="ingredients_and_equipment_en" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์ภาษาอังกฤษ</label>
                    <textarea id="ingredients_and_equipment_en" name="ingredients_and_equipment_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400"><?= htmlspecialchars($products_medical['ingredients_and_equipment_en'] ?? 'รอเจ้าหน้าที่เพิ่มข้อมูล') ?></textarea>
                </div>

                <!-- วิธีทำภาษาอังกฤษ -->
                <div>
                    <label for="instructions_en" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำภาษาอังกฤษ</label>
                    <textarea id="instructions_en" name="instructions_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400"><?= htmlspecialchars($products_medical['instructions_en'] ?? 'รอเจ้าหน้าที่เพิ่มข้อมูล') ?></textarea>
                </div>

                <!-- ภาพผลิตภัณฑ์ -->
                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= !empty($products_medical['picture']) ? 'อัปเดตภาพผลิตภัณฑ์' : 'อัปโหลดภาพผลิตภัณฑ์' ?>
                    </label>

                    <!-- Input เลือกภาพ -->
                    <input type="file" id="picture" name="picture" accept="image/*"
                        class="w-full text-gray-600 file:border file:border-gray-300 file:rounded file:px-3 file:py-2 file:bg-gray-50 file:text-gray-700 hover:file:bg-sky-100 transition"
                        onchange="previewImage(event)">

                    <!-- แสดงภาพเดิมถ้ามี -->
                    <?php if (!empty($products_medical['picture'])): ?>
                        <div class="mt-3">
                            <p class="text-sm text-gray-500 mb-1">ภาพปัจจุบัน:</p>
                            <img src="<?= htmlspecialchars($products_medical['picture']) ?>" alt="Product Image" class="w-48 h-auto rounded shadow">
                        </div>
                    <?php endif; ?>

                    <!-- พื้นที่แสดงภาพ preview -->
                    <div id="image-preview" class="mt-3 hidden">
                        <p class="text-sm text-gray-500 mb-1">ภาพที่เลือก:</p>
                        <img id="preview-img" src="" alt="Preview Image" class="w-48 h-auto rounded shadow border">
                    </div>
                </div>

                <!-- JavaScript แสดง preview -->
                <script>
                    function previewImage(event) {
                        const file = event.target.files[0];
                        const preview = document.getElementById('image-preview');
                        const imgTag = document.getElementById('preview-img');

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                imgTag.src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            preview.classList.add('hidden');
                            imgTag.src = '';
                        }
                    }
                </script>


                <!-- ปุ่มบันทึก -->
                <div class="text-center">
                    <button type="submit"
                        class="inline-block bg-sky-500 hover:bg-sky-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition">
                        บันทึกข้อมูล
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#ingredients_th'));
        ClassicEditor.create(document.querySelector('#instructions'));
        ClassicEditor.create(document.querySelector('#ingredients_and_equipment_en'));
        ClassicEditor.create(document.querySelector('#instructions_en'));
    </script>

    <?php
    // เช็คว่ามีการส่งข้อมูลผ่าน POST หรือไม่
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // รับค่า ID ของผลิตภัณฑ์
        $medical_product_id = $_POST['medical_product_id']; // รหัสผลิตภัณฑ์

        // รับค่าชื่อผลิตภัณฑ์ภาษาไทย
        $product_name = $_POST['product_name']; // ชื่อผลิตภัณฑ์

        // รับค่าชื่อผลิตภัณฑ์อังกฤษแบบไทย
        $product_name_th = $_POST['product_name_th']; // ชื่อผลิตภัณฑ์อังกฤษแบบไทย (สะกดตามเสียงไทย)

        // รับค่าชื่อผลิตภัณฑ์ภาษาอังกฤษ
        $product_name_en = $_POST['product_name_en']; // ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บ)

        // รับค่าประเภทของผลิตภัณฑ์
        $product_group = $_POST['product_group']; // ประเภทหลักของผลิตภัณฑ์ เช่น เมล็ดข้าว, แป้งข้าว ฯลฯ

        // รับค่ากลุ่มย่อย (เช่น อาหาร, เครื่องดื่ม)
        $category = $_POST['category'] ?? ''; // กลุ่มย่อยของผลิตภัณฑ์

        // รับค่ารหัสพันธุ์ข้าว
        $rice_id = $_POST['rice_id']; // รหัสพันธุ์ข้าว (ใช้สำหรับเชื่อมโยงกับข้อมูลพันธุ์ข้าวในระบบ)

        // ชื่อพันธุ์ข้าวไทย
        $thaiName = $_POST['thai_name'];

        // ชื่อพันธุ์ข้าวอังกฤษ
        $englishName = $_POST['english_name'];

        // รับค่ากลุ่มพันธุ์ข้าว (ภาษาไทย)
        $rice_variety_group_th_name = $_POST['rice_variety_group_th_name']; // ชื่อกลุ่มพันธุ์ข้าว (ภาษาไทย)

        // รับค่ากลุ่มพันธุ์ข้าว (ภาษาอังกฤษ)
        $rice_variety_group_en_name = $_POST['rice_variety_group_en_name']; // ชื่อกลุ่มพันธุ์ข้าว (ภาษาอังกฤษ)

        // รับค่าที่มา URL
        $source_url = $_POST['source_url']; // URL แหล่งที่มา (ลิงก์ข้อมูลอ้างอิง)

        // รับค่าที่มา (ชื่อหน่วยงาน)
        $source = $_POST['source']; // หน่วยงานหรือที่มาของข้อมูล

        // รับค่า genbank_url
        $genbank_url = $_POST['genbank_url']; // genbank_url

        // รับค่าวัตถุดิบและอุปกรณ์ (ภาษาไทย)
        $ingredients_and_equipment = $_POST['ingredients_and_equipment']; // วัตถุดิบและอุปกรณ์ (ภาษาไทย)

        // รับค่าวิธีทำ (ภาษาไทย)
        $instructions = $_POST['instructions']; // วิธีทำ (ภาษาไทย)

        // รับค่าวัตถุดิบและอุปกรณ์ (ภาษาอังกฤษ)
        $ingredients_and_equipment_en = $_POST['ingredients_and_equipment_en']; // วัตถุดิบและอุปกรณ์ (ภาษาอังกฤษ)

        // รับค่าวิธีทำ (ภาษาอังกฤษ)
        $instructions_en = $_POST['instructions_en']; // วิธีทำ (ภาษาอังกฤษ)

        // จัดการกับไฟล์ภาพถ้ามีการอัปโหลด
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['picture']['tmp_name'];
            $fileName = $_FILES['picture']['name'];
            $fileSize = $_FILES['picture']['size'];
            $fileType = $_FILES['picture']['type'];

            // ดึงนามสกุลไฟล์
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // สร้างชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
            $newFileName = uniqid('img_', true) . '.' . $fileExtension;

            // กำหนดที่เก็บไฟล์
            $uploadFileDir = '../image/rice_product/';
            $dest_path = $uploadFileDir . $newFileName;

            // ย้ายไฟล์จาก temp ไปยังโฟลเดอร์ที่กำหนด
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $picture_path = $dest_path; // บันทึก path ภาพลงฐานข้อมูล
            } else {
                $picture_path = ''; // หรืออาจแจ้ง error
            }
        } else {
            $picture_path = ''; // ไม่มีการอัปโหลดภาพใหม่
        }

        // รวมคำสั่ง SQL สำหรับอัปเดต
        $fieldsToUpdate = [
            "product_name = :product_name",
            "product_name_th = :product_name_th",
            "product_name_en = :product_name_en",
            "product_group = :product_group",
            "category = :category",
            "rice_id = :rice_id",
            "rice_variety_group_th_name = :rice_variety_group_th_name",
            "rice_variety_group_en_name = :rice_variety_group_en_name",
            "source_url = :source_url",
            "source = :source",
            "genbank_url = :genbank_url",
            "ingredients_and_equipment = :ingredients_and_equipment",
            "instructions = :instructions",
            "ingredients_and_equipment_en = :ingredients_and_equipment_en",
            "instructions_en = :instructions_en"
        ];

        // เพิ่มเฉพาะค่าที่มีจริง
        $params = [
            ':product_name' => $product_name,
            ':product_name_th' => $product_name_th,
            ':product_name_en' => $product_name_en,
            ':product_group' => $product_group,
            ':category' => $category,
            ':rice_id' => $rice_id,
            ':rice_variety_group_th_name' => $rice_variety_group_th_name,
            ':rice_variety_group_en_name' => $rice_variety_group_en_name,
            ':source_url' => $source_url,
            ':source' => $source,
            ':genbank_url' => $genbank_url,
            ':ingredients_and_equipment' => $ingredients_and_equipment,
            ':instructions' => $instructions,
            ':ingredients_and_equipment_en' => $ingredients_and_equipment_en,
            ':instructions_en' => $instructions_en,
            ':medical_product_id' => $medical_product_id
        ];

        if (!empty($_POST['thai_name'])) {
            $fieldsToUpdate[] = "rice_name_th = :thai_name";
            $params[':thai_name'] = $_POST['thai_name'];
        }

        if (!empty($_POST['english_name'])) {
            $fieldsToUpdate[] = "rice_name_en = :english_name";
            $params[':english_name'] = $_POST['english_name'];
        }

        if (!empty($picture_path)) {
            $fieldsToUpdate[] = "picture = :picture";
            $params[':picture'] = $picture_path;
        }

        // รวม SQL UPDATE
        $sql = "UPDATE medical_product SET " . implode(", ", $fieldsToUpdate) . " WHERE medical_product_id = :medical_product_id";
        $stmt = $pdo->prepare($sql);


        // ดำเนินการอัปเดต
        if ($stmt->execute($params)) {
    ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'อัปเดตข้อมูลผลิตภัณฑ์เรียบร้อยแล้ว',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'edit_product_medical?id=<?php echo $medical_product_id; ?>'; // เปลี่ยนไปหน้า accounts
                        }
                    });
                });
            </script>
    <?php
        } else {
            echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
        }
    }
    ?>

    <?php include '../loadtab/f.php'; ?>
</body>

</html>