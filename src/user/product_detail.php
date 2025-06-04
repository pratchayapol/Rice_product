<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';
// รับค่า id จาก query string อย่างปลอดภัย
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // เตรียมคำสั่ง SQL
    $stmt = $pdo->prepare("SELECT * FROM rice_products WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // ดึงข้อมูล
    $product = $stmt->fetch();

    if ($product) {
        // การเข้าถึงข้อมูล
        $gs_no = $product['gs_no'];
        $thai_name = $product['rice_variety_th_name'];
        $english_name = $product['rice_variety_en_name'];
        $product_name = $product['product_name'];
        $group = $product['product_group'];
        $category = $product['categore'];
        $group_th = $product['rice_variety_group_th_name'];
        $group_en = $product['rice_variety_group_en_name'];
        $source_url = $product['source_url'];
        $source = $product['source'];
        $recipe = $product['recipe'];
        $type = $product['type'];
        $cooking_equipment = $product['cooking_equipment'];
        $picture = $product['picture'];

        // แยกสตริงด้วยเครื่องหมายคอมมา แล้วเอาแค่ตัวแรก
        $gs_no_array = explode(', ', $gs_no);
        $target_gs_no = trim($gs_no_array[0]); // ลบช่องว่างเผื่อมี

        // แปลงเป็น integer ถ้าจำเป็น
        $target_gs_no = (int)$target_gs_no;

        // คำสั่ง SQL พร้อม placeholder
        $sql = "SELECT * FROM general_information WHERE gs_no = :gs_no";

        // เตรียมคำสั่ง
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':gs_no', $target_gs_no, PDO::PARAM_INT);

        // ประมวลผล
        $stmt->execute();

        // ตรวจสอบผลลัพธ์
        if ($stmt->rowCount() > 0) {
            $general_info = $stmt->fetch(PDO::FETCH_ASSOC);

            // แยกเก็บข้อมูลในตัวแปร PHP
            $thai_breed_name                 = !empty($general_info['thai_breed_name']) ? $general_info['thai_breed_name'] : 'ไม่พบข้อมูล';
            $english_breed_name             = !empty($general_info['english_breed_name']) ? $general_info['english_breed_name'] : 'ไม่พบข้อมูล';
            $scientific_name                = !empty($general_info['scientific_name']) ? $general_info['scientific_name'] : 'ไม่พบข้อมูล';
            $other_names_or_numbers         = !empty($general_info['other_names_or_numbers']) ? $general_info['other_names_or_numbers'] : 'ไม่พบข้อมูล';
            $type_of_rice_race_type         = !empty($general_info['type_of_rice_race_type']) ? $general_info['type_of_rice_race_type'] : 'ไม่พบข้อมูล';
            $rice_ecosystem                 = !empty($general_info['rice_ecosystem']) ? $general_info['rice_ecosystem'] : 'ไม่พบข้อมูล';
            $breeder                        = !empty($general_info['breeder']) ? $general_info['breeder'] : 'ไม่พบข้อมูล';
            $date_of_approval_or_recommendation = !empty($general_info['date_of_approval_or_recommendation']) ? $general_info['date_of_approval_or_recommendation'] : 'ไม่พบข้อมูล';
            $breeding_organization          = !empty($general_info['breeding_organization']) ? $general_info['breeding_organization'] : 'ไม่พบข้อมูล';
            $general_status                 = !empty($general_info['general_status']) ? $general_info['general_status'] : 'ไม่พบข้อมูล';
            $legal_status                   = !empty($general_info['legal_status']) ? $general_info['legal_status'] : 'ไม่พบข้อมูล';
            $harvest_age_days               = !empty($general_info['harvest_age_days']) ? $general_info['harvest_age_days'] : 'ไม่พบข้อมูล';
            $harvest_days                   = !empty($general_info['harvest_days']) ? $general_info['harvest_days'] : 'ไม่พบข้อมูล';
            $photoperiod_sensitivity        = !empty($general_info['photoperiod_sensitivity']) ? $general_info['photoperiod_sensitivity'] : 'ไม่พบข้อมูล';


            $amylose_content_percent        = !empty($general_info['amylose_content_percent']) ? $general_info['amylose_content_percent'] : 'ไม่พบข้อมูล';
            $gelatinization_temp            = !empty($general_info['gelatinization_temp']) ? $general_info['gelatinization_temp'] : 'ไม่พบข้อมูล';
            $gelatinization_temp_additional = !empty($general_info['gelatinization_temp_additional']) ? $general_info['gelatinization_temp_additional'] : 'ไม่พบข้อมูล';
            $gelatinized_starch_stability   = !empty($general_info['gelatinized_starch_stability']) ? $general_info['	gelatinized_starch_stability'] : 'ไม่พบข้อมูล';
            $gelatinized_starch_stability_additional              = !empty($general_info['gelatinized_starch_stability_additional']) ? $general_info['gelatinized_starch_stability_additional'] : 'ไม่พบข้อมูล';
            $aroma                = !empty($general_info['aroma']) ? $general_info['aroma'] : 'ไม่พบข้อมูล';
            $cooked_rice_expansion_ratio                = !empty($general_info['cooked_rice_expansion_ratio']) ? $general_info['cooking_quality'] : 'ไม่พบข้อมูล';

            $picture_rice_1 = $general_info['picture_rice_1'] ?? null;
            $picture_rice_2 = $general_info['picture_rice_2'] ?? null;
        } else {
            echo "ไม่พบข้อมูลสำหรับ gs_no = $target_gs_no";
        }

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
        </head>

        <body class="bg t1">
            <?php include '../loadtab/h.php'; ?>

            <div class="flex items-center justify-center min-h-screen p-6">
                <div class="max-w-7xl w-full">
                    <div class="grid grid-cols-12 gap-6">

                        <!-- Sidebar -->
                        <div class="col-span-12 md:col-span-4 bg-pink-100 rounded-lg p-6 text-center text-gray-800 flex flex-col items-center">
                            <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-white px-4 py-2 rounded-full">ผลิตภัณฑ์ <?php echo $product_name ?></h3>

                            <?php if (!empty($picture)): ?>
                                <div class="bg-white h-40 w-full rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                                    <img src="<?= htmlspecialchars($picture) ?>" alt="Product Image" class="h-full object-contain" onclick="openImageModal(this.src)">
                                </div>
                            <?php else: ?>

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
                        <div class="col-span-12 md:col-span-8 bg-blue-100 rounded-lg p-6">
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
                                            <?php echo $cooking_equipment; ?>
                                        </div>

                                    </div>
                                    <div class="bg-white p-4 rounded-lg">
                                        <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">วิธีทำ</h4>
                                        <div style='border:0px solid #ccc; padding:10px;'>
                                            <?php echo $recipe; ?>
                                        </div>
                                    </div>
                                </div>

                                <div id="rice" class="tab-content hidden">
                                    <div class="bg-white p-4 rounded-lg">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                            <!-- ข้อมูลทั่วไป -->
                                            <div>
                                                <h4 class="text-sm font-semibold mb-2 bg-white text-center rounded-full w-fit px-4 py-1 mx-auto shadow">ข้อมูลทั่วไป</h4>
                                                <br>
                                                <ul class="text-sm text-gray-700 space-y-1">
                                                    <li><strong>หมายเลขประจำพันธุ์ (G.S. No.):</strong> <?php echo $gs_no; ?></li>
                                                    <li><strong>ชื่อพันธุ์ไทย:</strong> <?php echo htmlspecialchars($thai_breed_name); ?></li>
                                                    <li><strong>ชื่อพันธุ์อังกฤษ:</strong> <?php echo htmlspecialchars($english_breed_name) ?></li>
                                                    <li><strong>ชื่อวิทยาศาสตร์:</strong> <?php echo htmlspecialchars($scientific_name) ?></li>
                                                    <li><strong>นิเวศการปลูกข้าว:</strong> <?php echo htmlspecialchars($rice_ecosystem) ?></li>
                                                    <li><strong>วันเดือนปีที่รับรอง/แนะนำ:</strong> <?php echo htmlspecialchars($date_of_approval_or_recommendation) ?></li>
                                                    <li><strong>สภาพภาพทั่วไป:</strong> <?php echo htmlspecialchars($general_status) ?></li>
                                                    <li><strong>อายุเก็บเกี่ยว (วัน):</strong> <?php echo htmlspecialchars($harvest_age_days) ?></li>
                                                    <li><strong>ความไวต่อช่วงแสง:</strong> <?php echo htmlspecialchars($photoperiod_sensitivity) ?></li>
                                                </ul>
                                                <br>
                                                <?php if (!empty($picture_rice_1)): ?>
                                                    <div class="flex justify-center">
                                                        <img src="<?php echo htmlspecialchars($picture_rice_1) ?>"
                                                            alt="รูปต้นข้าว"
                                                            class="rounded border object-cover w-48 h-48 cursor-pointer"
                                                            onclick="openImageModal(this.src)" />
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- คุณภาพทางเคมีของเมล็ด -->
                                            <div>
                                                <h4 class="text-sm font-semibold mb-2 bg-white text-center rounded-full w-fit px-4 py-1 mx-auto shadow">คุณภาพทางเคมีของเมล็ด</h4>
                                                <br>
                                                <ul class="text-sm text-gray-700 space-y-1">
                                                    <li><strong>ปริมาณอมิโลส (%):</strong> <?php echo htmlspecialchars($amylose_content_percent) ?></li>
                                                    <li><strong>อุณหภูมิแป้งสุก:</strong> <?php echo htmlspecialchars($gelatinization_temp) ?></li>
                                                    <li><strong>อุณหภูมิแป้งสุก (เพิ่มเติม):</strong> <?php echo htmlspecialchars($gelatinization_temp_additional) ?></li>
                                                    <li><strong>ความคงตัวของแป้งสุก:</strong> <?php echo htmlspecialchars($gelatinized_starch_stability) ?></li>
                                                    <li><strong>ความคงตัวของแป้งสุก (เพิ่มเติม):</strong> <?php echo htmlspecialchars($gelatinized_starch_stability_additional) ?></li>
                                                    <li><strong>กลิ่นหอม:</strong> <?php echo htmlspecialchars($aroma) ?></li>
                                                    <li><strong>อัตราการยืดตัวของข้าวสุก:</strong> <?php echo htmlspecialchars($cooked_rice_expansion_ratio) ?></li>
                                                </ul>
                                                <br> <br>
                                                <?php if (!empty($picture_rice_2)): ?>
                                                    <div class="flex justify-center">
                                                        <img src="<?php echo htmlspecialchars($picture_rice_2) ?>"
                                                            alt="รูปเมล็ดข้าว"
                                                            class="mt-4 rounded border object-cover w-48 h-48" onclick="openImageModal(this.src)" />
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div id="nutrition" class="tab-content hidden">
                                    <div class="bg-orange-100 p-6 rounded-lg">
                                        <h4 class="inline-block font-bold mb-4 bg-white px-6 py-2 rounded-full text-sm mx-auto shadow"> ข้อมูลโภชนาการ </h4>
                                        <div class="overflow-x-auto">
                                            <canvas id="nutritionChart" class="w-full h-[900px]"></canvas>
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
                const labels = [
                    "โปรตีนในข้าวกล้อง (%)",
                    "โปรตีนในข้าวสาร (%)",
                    "ไขมัน (%)",
                    "ไขมันในข้าวสาร (%)",
                    "ใยอาหาร (กรัม/100 กรัม)",
                    "ใยอาหารในข้าวสาร",
                    "วิตามิน อี",
                    "วิตามิน อี ในข้าวสาร",
                    "วิตามิน บี1",
                    "วิตามิน บี1 ในข้าวสาร",
                    "วิตามิน บี2",
                    "วิตามิน บี2 ในข้าวสาร",
                    "ไนอาซีน",
                    "ไนอาซีน ในข้าวสาร",
                    "ลูทีน",
                    "ลูทีน ในข้าวสาร",
                    "เบต้าแคโรทีน",
                    "เบต้าแคโรทีนในข้าวสาร",
                    "แคลเซียม",
                    "แคลเซียมในข้าวสาร",
                    "เหล็ก",
                    "เหล็กในข้าวสาร",
                    "ไฟเตท",
                    "ไฟเตทในข้าวสาร",
                    "ทองแดง",
                    "ทองแดงในข้าวสาร",
                    "โฟเลต",
                    "โฟเลตในข้าวสาร"
                ];

                const dataValues = [
                    7.5, 6.3, 2.2, 1.4, 3.1, 1.7, 1.2, 0.6,
                    0.5, 0.2, 0.08, 0.04, 2.3, 1.0, 0.4, 0.2,
                    0.3, 0.1, 12, 8, 1.1, 0.6, 240, 110,
                    0.25, 0.14, 50, 20
                ];

                const data = {
                    labels: labels,
                    datasets: [{
                        label: "ปริมาณสารอาหาร",
                        data: dataValues,
                        backgroundColor: "rgba(251, 146, 60, 0.85)", // Tailwind orange-400
                        borderRadius: 10,
                        barThickness: 20
                    }]
                };

                const config = {
                    type: "bar",
                    data: data,
                    options: {
                        indexAxis: "y",
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) =>
                                        `${ctx.label}: ${ctx.raw} ${
                ctx.label.includes("%") ? "%" : "มก./100 กรัม"
              }`
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: "ปริมาณ (มก./กรัม หรือ %)"
                                }
                            },
                            y: {
                                ticks: {
                                    autoSkip: false
                                }
                            }
                        }
                    }
                };

                new Chart(document.getElementById("nutritionChart"), config);
            </script>

            <script>
                function openImageModal(src) {
                    const modal = document.getElementById('imageModal');
                    const modalImage = document.getElementById('modalImage');
                    modalImage.src = src;
                    modal.classList.remove('hidden');
                }

                function closeImageModal() {
                    const modal = document.getElementById('imageModal');
                    modal.classList.add('hidden');
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
        echo "ไม่พบข้อมูล";
    }
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
