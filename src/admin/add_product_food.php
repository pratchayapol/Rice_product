<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // โหลด Composer autoload

use JasonGrimes\Paginator;

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';

// ดึงข้อมูลชื่อพันธุ์ข้าว
$stmt = $pdo->prepare("SELECT thai_breed_name, english_breed_name FROM rice WHERE rice_id = ?");
$stmt->execute([$products_food['rice_id']]);
$rice = $stmt->fetch();

if ($rice) {
    $riceNameLabel = $rice['thai_breed_name'];
    if (!empty($rice['english_breed_name'])) {
        $riceNameLabel .= ' (' . $rice['english_breed_name'] . ')';
    }
    $riceIdValue = $products_food['rice_id'];
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลผลิตภัณฑ์อาหาร</title>
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
            <h2 class="text-3xl font-semibold mb-8 text-center text-rose-600">เพิ่มข้อมูลผลิตภัณฑ์อาหาร</h2>

            <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">

                <!-- ชื่อผลิตภัณฑ์ -->
                <div>
                    <label for="product_name_th" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์</label>
                    <input type="text" id="product_name_th" name="product_name" required
                        placeholder="ระบุชื่อผลิตภัณฑ์"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ชื่อผลิตภัณฑ์อังกฤษแบบไทย -->
                <div>
                    <label for="product_name_eng_thai" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์อังกฤษแบบไทย</label>
                    <input type="text" id="product_name_eng_thai" name="product_name_th"
                        placeholder="ระบุชื่อผลิตภัณฑ์อังกฤษแบบไทย"

                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ชื่อผลิตภัณฑ์ภาษาอังกฤษ -->
                <div>
                    <label for="product_name_eng" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลิตภัณฑ์ภาษาอังกฤษ (วงเล็บข้างหลัง)</label>
                    <input type="text" id="product_name_eng" name="product_name_en"
                        placeholder="ระบุชื่อผลิตภัณฑ์อังกฤษแบบไทย"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>


                <!-- ประเภท -->
                <div>
                    <label for="product_group" class="block text-sm font-medium text-gray-700 mb-1">ประเภท</label>
                    <select id="product_group" name="product_group" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400">
                        <option value="">-- เลือกประเภท --</option>
                        <option value="ผลิตภัณฑ์จากเมล็ดข้าว">ผลิตภัณฑ์จากเมล็ดข้าว</option>
                        <option value="ผลิตภัณฑ์จากแป้งข้าว">ผลิตภัณฑ์จากแป้งข้าว</option>
                        <option value="ผลิตภัณฑ์จากการหมัก">ผลิตภัณฑ์จากการหมัก</option>
                        <option value="ผลิตภัณฑ์จากส่วนอื่นๆ">ผลิตภัณฑ์จากส่วนอื่นๆ</option>
                    </select>
                </div>

                <!-- กลุ่มย่อย -->
                <div id="subcategory-div">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มย่อย</label>
                    <select id="category" name="category"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400">
                        <option value="">-- เลือกกลุ่มย่อย --</option>
                        <option value="อาหาร">อาหาร</option>
                        <option value="อาหารว่าง">ขนม</option>
                        <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                        <option value="เครื่องปรุงรส">เครื่องปรุงรส</option>
                    </select>
                </div>



                <!-- แปรรูปจากพันธุ์ข้าว -->
                <div>
                    <label for="rice_label" class="block text-sm font-medium text-gray-700 mb-1">แปรรูปจากพันธุ์ข้าว</label>
                    <!-- input แสดงชื่อพันธุ์ข้าว -->
                    <input type="text" id="rice_label" name="rice_label" required
                        list="riceSuggestions"
                        placeholder="ระบุชื่อพันธุ์ข้าว"
                        value="<?= htmlspecialchars($riceNameLabel ?? '') ?>"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"
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
                    <input type="text" id="rice_variety_group_th_name" name="rice_variety_group_th_name"
                        placeholder="ระบุกลุ่มพันธุ์ข้าวภาษาไทย"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- กลุ่มพันธุ์ข้าวภาษาอังกฤษ -->
                <div>
                    <label for="rice_variety_group_en_name" class="block text-sm font-medium text-gray-700 mb-1">กลุ่มพันธุ์ข้าวภาษาอังกฤษ</label>
                    <input type="text" id="rice_variety_group_en_name" name="rice_variety_group_en_name"
                        placeholder="ระบุกลุ่มพันธุ์ข้าวภาษาอังกฤษ"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ที่มา URL -->
                <div>
                    <label for="source_url" class="block text-sm font-medium text-gray-700 mb-1">ที่มา URL <span class="text-gray-400 text-xs">(วางลิงค์ข้อมูล)</span></label>
                    <input type="url" id="source_url" name="source_url"
                        placeholder="ระบุ ที่มา URL"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- ที่มา -->
                <div>
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-1">ที่มา <span class="text-gray-400 text-xs">(เช่น หน่วยงานที่รับรองผลิตภัณฑ์)</span></label>
                    <input type="text" id="source" name="source"
                        placeholder="ระบุ ที่มา เช่น หน่วยงานที่รับรองผลิตภัณฑ์"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400" />
                </div>

                <!-- วัตถุดิบและอุปกรณ์ -->
                <div>
                    <label for="ingredients_th" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์</label>
                    <textarea id="ingredients_th" name="ingredients_and_equipment" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">รอเจ้าหน้าที่เพิ่มข้อมูล</textarea>
                </div>

                <!-- วิธีทำ -->
                <div>
                    <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำ</label>
                    <textarea id="instructions" name="instructions" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">รอเจ้าหน้าที่เพิ่มข้อมูล</textarea>
                </div>

                <!-- วัตถุดิบและอุปกรณ์ภาษาอังกฤษ -->
                <div>
                    <label for="ingredients_and_equipment_en" class="block text-sm font-medium text-gray-700 mb-1">วัตถุดิบและอุปกรณ์ภาษาอังกฤษ</label>
                    <textarea id="ingredients_and_equipment_en" name="ingredients_and_equipment_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">รอเจ้าหน้าที่เพิ่มข้อมูล</textarea>
                </div>

                <!-- วิธีทำภาษาอังกฤษ -->
                <div>
                    <label for="instructions_en" class="block text-sm font-medium text-gray-700 mb-1">วิธีทำภาษาอังกฤษ</label>
                    <textarea id="instructions_en" name="instructions_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">รอเจ้าหน้าที่เพิ่มข้อมูล</textarea>
                </div>

                <!-- ภาพผลิตภัณฑ์ -->
                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= !empty($products_food['picture']) ? 'อัปเดตภาพผลิตภัณฑ์' : 'อัปโหลดภาพผลิตภัณฑ์' ?>
                    </label>

                    <!-- Input เลือกภาพ -->
                    <input type="file" id="picture" name="picture" accept="image/*"
                        class="w-full text-gray-600 file:border file:border-gray-300 file:rounded file:px-3 file:py-2 file:bg-gray-50 file:text-gray-700 hover:file:bg-rose-100 transition"
                        onchange="previewImage(event)">

                    <!-- แสดงภาพเดิมถ้ามี -->
                    <?php if (!empty($products_food['picture'])): ?>
                        <div class="mt-3">
                            <p class="text-sm text-gray-500 mb-1">ภาพปัจจุบัน:</p>
                            <img src="<?= htmlspecialchars($products_food['picture']) ?>" alt="Product Image" class="w-48 h-auto rounded shadow">
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
        ClassicEditor.create(document.querySelector('#instructions'));
        ClassicEditor.create(document.querySelector('#ingredients_and_equipment_en'));
        ClassicEditor.create(document.querySelector('#instructions_en'));
    </script>

    <?php
    // เช็คว่ามีการส่งข้อมูลผ่าน POST หรือไม่
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

        // รับค่าวัตถุดิบและอุปกรณ์ (ภาษาไทย)
        $ingredients_and_equipment = $_POST['ingredients_and_equipment']; // วัตถุดิบและอุปกรณ์ (ภาษาไทย)

        // รับค่าวิธีทำ (ภาษาไทย)
        $instructions = $_POST['instructions']; // วิธีทำ (ภาษาไทย)

        // รับค่าวัตถุดิบและอุปกรณ์ (ภาษาอังกฤษ)
        $ingredients_and_equipment_en = $_POST['ingredients_and_equipment_en']; // วัตถุดิบและอุปกรณ์ (ภาษาอังกฤษ)

        // รับค่าวิธีทำ (ภาษาอังกฤษ)
        $instructions_en = $_POST['instructions_en']; // วิธีทำ (ภาษาอังกฤษ)

        // จัดการกับไฟล์ภาพ
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['picture']['tmp_name'];
            $fileName = $_FILES['picture']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = uniqid('img_', true) . '.' . $fileExtension;
            $uploadFileDir = '../image/rice_product/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $picture_path = $dest_path;
            } else {
                $picture_path = '';
            }
        } else {
            $picture_path = '';
        }

        // เตรียมข้อมูลสำหรับ INSERT
        $columns = [];
        $placeholders = [];
        $params = [];

        function addField(&$columns, &$placeholders, &$params, $columnName, $placeholder, $value)
        {
            if (!empty($value)) {
                $columns[] = $columnName;
                $placeholders[] = $placeholder;
                $params[$placeholder] = $value;
            }
        }

        addField($columns, $placeholders, $params, 'product_name', ':product_name', $_POST['product_name']);
        addField($columns, $placeholders, $params, 'product_name_th', ':product_name_th', $_POST['product_name_th']);
        addField($columns, $placeholders, $params, 'product_name_en', ':product_name_en', $_POST['product_name_en']);
        addField($columns, $placeholders, $params, 'product_group', ':product_group', $_POST['product_group']);
        addField($columns, $placeholders, $params, 'category', ':category', $_POST['category'] ?? '');
        addField($columns, $placeholders, $params, 'rice_id', ':rice_id', $_POST['rice_id']);
        addField($columns, $placeholders, $params, 'rice_variety_th_name', ':thai_name', $_POST['thai_name']);
        addField($columns, $placeholders, $params, 'rice_variety_en_name', ':english_name', $_POST['english_name']);
        addField($columns, $placeholders, $params, 'rice_variety_group_th_name', ':rice_variety_group_th_name', $_POST['rice_variety_group_th_name']);
        addField($columns, $placeholders, $params, 'rice_variety_group_en_name', ':rice_variety_group_en_name', $_POST['rice_variety_group_en_name']);
        addField($columns, $placeholders, $params, 'source_url', ':source_url', $_POST['source_url']);
        addField($columns, $placeholders, $params, 'source', ':source', $_POST['source']);
        addField($columns, $placeholders, $params, 'ingredients_and_equipment', ':ingredients_and_equipment', $_POST['ingredients_and_equipment']);
        addField($columns, $placeholders, $params, 'instructions', ':instructions', $_POST['instructions']);
        addField($columns, $placeholders, $params, 'ingredients_and_equipment_en', ':ingredients_and_equipment_en', $_POST['ingredients_and_equipment_en']);
        addField($columns, $placeholders, $params, 'instructions_en', ':instructions_en', $_POST['instructions_en']);
        if (!empty($picture_path)) {
            addField($columns, $placeholders, $params, 'picture', ':picture', $picture_path);
        }

        // สร้างคำสั่ง SQL INSERT
        $sql = "INSERT INTO food_product (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $placeholders) . ")";
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
                        text: 'เพิ่มข้อมูลผลิตภัณฑ์เรียบร้อยแล้ว',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'product_all'; // เปลี่ยนไปหน้า product_all
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