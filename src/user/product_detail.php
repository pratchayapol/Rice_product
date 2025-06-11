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

    if ($type === "food") {
        // เตรียมคำสั่ง SQL
        $stmt = $pdo->prepare("SELECT * FROM food_product WHERE food_product_id = :id");
        $stmt->execute(['id' => $id]);

        // ดึงข้อมูล
        $product = $stmt->fetch();

        if ($product) {
            // การเข้าถึงข้อมูล
            $rice_id = $product['rice_id'];
            $thai_name = $product['rice_variety_th_name'];
            $english_name = $product['rice_variety_en_name'];
            $product_name = $product['product_name'];
            $group = $product['product_group'];
            $category = $product['category'];
            $group_th = $product['rice_variety_group_th_name'];
            $group_en = $product['rice_variety_group_en_name'];
            $source_url = $product['source_url'];
            $source = $product['source'];
            $ingredients_and_equipment = $product['ingredients_and_equipment'];
            $instructions = $product['instructions'];
            $picture = $product['picture'];

            // แยกสตริงด้วยเครื่องหมายคอมมา แล้วเอาแค่ตัวแรก
            $rice_id_array = explode(', ', $rice_id);
            $target_rice_id = trim($rice_id_array[0]); // ลบช่องว่างเผื่อมี

            // แปลงเป็น integer ถ้าจำเป็น
            $target_rice_id = (int)$target_rice_id;

            // คำสั่ง SQL พร้อม placeholder
            $sql = "SELECT * FROM rice WHERE rice_id = :rice_id";

            // เตรียมคำสั่ง
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':rice_id', $target_rice_id, PDO::PARAM_INT);

            // ประมวลผล
            $stmt->execute();

            // ตรวจสอบผลลัพธ์
            if ($stmt->rowCount() > 0) {
                $general_info = $stmt->fetch(PDO::FETCH_ASSOC);

                // แยกเก็บข้อมูลในตัวแปร PHP
                $gs_no                 = !empty($general_info['gs_no']) ? $general_info['gs_no'] : 'ไม่พบข้อมูล';
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

                $picture_rice_1 = $general_info['picture_rice_1'] ?? null;
            } else {
                echo "ไม่พบข้อมูลสำหรับ rice_id = $target_rice_id";
            }
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
                                            <?php echo $ingredients_and_equipment; ?>
                                        </div>

                                    </div>
                                    <div class="bg-white p-4 rounded-lg">
                                        <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">วิธีทำ</h4>
                                        <div style='border:0px solid #ccc; padding:10px;'>
                                            <?php echo $instructions; ?>
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
                                                    <?php if (!empty($picture_rice_1)): ?>
                                                        <div class="flex justify-center">
                                                            <img src="<?php echo htmlspecialchars($picture_rice_1) ?>"
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
                                                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($thai_breed_name); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left px-2 py-1 font-semibold">ชื่อพันธุ์อังกฤษ:</td>
                                                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($english_breed_name); ?></td>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="nutrition" class="tab-content hidden">
                                    <div class="bg-white p-4 rounded-lg">
                                        <h4 class="inline-block font-bold mb-4 bg-white px-6 py-2 rounded-full text-sm mx-auto shadow"> ข้อมูลโภชนาการ </h4>
                                        <div class="overflow-x-auto">
                                            <canvas id="nutritionChart" class="w-full" style="min-height: 1200px;"></canvas>
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
                const labels = ["โปรตีนในข้าวกล้อง (%)", "โปรตีนในข้าวสาร (%)", "ไขมัน (%)", "ไขมันในข้าวสาร (%)", "ใยอาหาร (กรัม/100 กรัม)", "ใยอาหารในข้าวสาร", "วิตามิน อี", "วิตามิน อี ในข้าวสาร", "วิตามิน บี1", "วิตามิน บี1 ในข้าวสาร", "วิตามิน บี2", "วิตามิน บี2 ในข้าวสาร", "ไนอาซีน", "ไนอาซีน ในข้าวสาร", "ลูทีน", "ลูทีน ในข้าวสาร", "เบต้าแคโรทีน", "เบต้าแคโรทีนในข้าวสาร", "แคลเซียม", "แคลเซียมในข้าวสาร", "เหล็ก", "เหล็กในข้าวสาร", "ไฟเตท", "ไฟเตทในข้าวสาร", "ทองแดง", "ทองแดงในข้าวสาร", "โฟเลต", "โฟเลตในข้าวสาร"];
                const dataValues = [7.5, 6.3, 2.2, 1.4, 3.1, 1.7, 1.2, 0.6, 0.5, 0.2, 0.08, 0.04, 2.3, 1.0, 0.4, 0.2, 0.3, 0.1, 12, 8, 1.1, 0.6, 240, 110, 0.25, 0.14, 50, 20];
                const data = {
                    labels: labels,
                    datasets: [{
                        label: "ปริมาณสารอาหาร",
                        data: dataValues,
                        backgroundColor: "rgba(45, 64, 93, 0.85)",
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
                        maintainAspectRatio: false,
                        animation: false, // ❌ ปิดเอฟเฟกต์แอนิเมชัน
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                bodyFont: {
                                    family: 'Noto Sans Thai'
                                },
                                titleFont: {
                                    family: 'Noto Sans Thai'
                                },
                                callbacks: {
                                    label: (ctx) =>
                                        `${ctx.label}: ${ctx.raw} ${ctx.label.includes("%") ? "%" : "มก./100 กรัม"}`
                                }
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'right',
                                color: '#2D405D',
                                font: {
                                    family: 'Noto Sans Thai',
                                    weight: 'bold',
                                    size: 12
                                },
                                formatter: (value) => `${value}`
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    color: "#333",
                                    font: {
                                        family: 'Noto Sans Thai'
                                    }
                                },
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: "ปริมาณ (มก./กรัม หรือ %)",
                                    color: "#333",
                                    font: {
                                        family: 'Noto Sans Thai'
                                    }
                                }
                            },
                            y: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    autoSkip: false,
                                    color: "#333",
                                    font: {
                                        family: 'Noto Sans Thai'
                                    }
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                };


                new Chart(document.getElementById("nutritionChart"), config);
            </script>

            <script>
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
