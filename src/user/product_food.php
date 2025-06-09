<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';
// แสดง 6 card ต่อ 1 หน้า
$cardsPerPage = 6;

// รับค่าหน้าปัจจุบันจาก URL ถ้าไม่มีให้เป็น 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// คำนวณ offset
$offset = ($page - 1) * $cardsPerPage;

try {
    // ดึงข้อมูลรวมทั้งหมดเพื่อนับจำนวนหน้า
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM food_product");
    $totalCards = $totalStmt->fetchColumn();

    // ดึงข้อมูลเฉพาะหน้าปัจจุบัน
    $stmt = $pdo->prepare("SELECT * FROM food_product ORDER BY food_product_id LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $cardsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();

    $totalPages = ceil($totalCards / $cardsPerPage);
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
                    <div class="w-full md:w-3/4">
                        <!-- ตรงนี้วาง Card หรือ Content หลักได้ -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
                            <?php foreach ($products as $product): ?>
                                <a href="product_detail?id=<?= urlencode($product['food_product_id']) ?>&type=food"
                                    class="bg-sky-100 rounded-2xl shadow p-4 flex flex-col items-center transform transition hover:scale-105 hover:shadow-lg">

                                    <img src="<?= htmlspecialchars($product['picture']) ?: '../image/rice_product/null.jpg' ?>"
                                        alt="<?= htmlspecialchars($product['product_name']) ?>"
                                        class="rounded-xl mb-4 w-full h-40 object-cover" />

                                    <div class="flex flex-col gap-2 w-full">
                                        <div class="w-full px-4 py-1 rounded-full text-sm text-gray-700 shadow hover:shadow-md hover:bg-gray-100 transition text-center">
                                            <?= htmlspecialchars($product['product_name']) ?>
                                        </div>
                                        <div class="w-full px-4 py-1 rounded-full text-sm text-gray-700 shadow hover:shadow-md hover:bg-gray-100 transition text-center">
                                            <?= htmlspecialchars($product['rice_variety_th_name']) ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-center gap-3 mt-6">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?= $i ?>"
                                    class="px-4 py-2 rounded <?= $i === $page ? 'bg-sky-600 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

    <?php include '../loadtab/f.php'; ?>
</body>

</html>