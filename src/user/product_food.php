<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';
try {
    $stmt = $pdo->query("SELECT * FROM food_product ORDER BY food_product_id");
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลิตภัณฑ์ด้านอาหาร</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
</head>

<body class="bg t1">
    <?php include '../loadtab/h.php'; ?>
    <!-- Navigation Bar -->
    <?php include './plugin/navbar.php'; ?>

    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="w-full px-6"> <!-- ขยายเต็มจอและมี padding ขอบ -->
            <div class="bg-white/95 p-10 rounded-2xl shadow-xl w-full text-center">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- เมนูด้านซ้าย -->
                    <div class="w-full md:w-1/4 space-y-4">
                        <!-- Search Box -->
                        <div class="relative">
                            <input type="text" placeholder="ค้นหาผลิตภัณฑ์ข้าว"
                                class="w-full px-5 py-3 rounded-full shadow border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <span class="absolute right-4 top-3.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                        </div>

                        <!-- เมนูประเภทสินค้า -->
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">ผลิตภัณฑ์จากเมล็ดข้าว</button>
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">อาหาร</button>
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">ขนม</button>
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">เครื่องดื่ม</button>
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">ผลิตภัณฑ์จากแป้งข้าว</button>
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">ผลิตภัณฑ์จากการหมัก</button>
                        <button class="w-full py-2 rounded-full border border-gray-400 hover:bg-gray-100">ผลิตภัณฑ์จากส่วนอื่นๆ</button>
                    </div>

                    <!-- เนื้อหาหลักฝั่งขวา -->
                    <div class="w-full md:w-3/4 p-6">
                        <table id="productTable" class="display w-full">
                            <thead>
                                <tr>
                                    <th>รูป</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>พันธุ์ข้าว</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr onclick="location.href='product_detail?id=<?= urlencode($product['food_product_id']) ?>&type=food';" style="cursor:pointer;">
                                        <td>
                                            <img src="<?= htmlspecialchars($product['picture']) ?: '../image/rice_product/null.jpg' ?>"
                                                alt="<?= htmlspecialchars($product['product_name']) ?>"
                                                style="width:100px; height:75px; object-fit:cover; border-radius:8px;" />
                                        </td>
                                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                                        <td><?= htmlspecialchars($product['rice_variety_th_name']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- โหลด jQuery และ DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                pageLength: 6,
                lengthChange: false,
                language: {
                    search: "ค้นหา:",
                    paginate: {
                        previous: "ก่อนหน้า",
                        next: "ถัดไป"
                    },
                    info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                    infoEmpty: "ไม่มีข้อมูล",
                    zeroRecords: "ไม่พบข้อมูลที่ค้นหา"
                }
            });
        });
    </script>
    <?php include '../loadtab/f.php'; ?>
</body>

</html>