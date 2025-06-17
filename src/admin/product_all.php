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
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลิตภัณฑ์อาหาร</title>
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
            <div class="bg-white p-10 rounded-2xl shadow-xl w-full text-center">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- เมนูด้านซ้าย -->
                    

                    <!-- เนื้อหาหลักฝั่งขวา -->
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-rose-300 px-4 py-2 rounded-full shadow-md">
                            ผลิตภัณฑ์อาหาร
                        </h3>
                        <div class="overflow-x-auto p-6">
                            <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                <thead class="bg-rose-200 text-gray-800">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2">รูปสินค้า</th>
                                        <th class="border border-gray-300 px-4 py-2">ชื่อสินค้า</th>
                                        <th class="border border-gray-300 px-4 py-2">สายพันธุ์ข้าว</th>
                                        <th class="border border-gray-300 px-4 py-2">ดูรายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <?php foreach ($products as $product): ?>
                                        <tr class="hover:bg-yellow-50 transition">
                                            <td class="border border-gray-300 px-4 py-2">
                                                <img src="<?= htmlspecialchars($product['picture']) ?: '../image/rice_product/A.jpg' ?>"
                                                    alt="<?= htmlspecialchars($product['product_name']) ?>"
                                                    class="w-24 h-16 object-cover rounded shadow" />
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <?= htmlspecialchars($product['product_name']) ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <?= htmlspecialchars($product['rice_variety_th_name']) ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <a href="product_detail?id=<?= urlencode($product['food_product_id']) ?>&type=food"
                                                    class="text-blue-600 hover:underline">
                                                    รายละเอียด
                                                </a>
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
    <script>
        $(document).ready(function() {
            let currentSearch = '';
            let currentType = '';
            let currentPage = 1;

            function fetchProducts(search = '', type = '', page = 1) {
                $.get('fetch_products_food.php', {
                    search: search,
                    type: type,
                    page: page
                }, function(response) {
                    const {
                        products,
                        total,
                        perPage,
                        currentPage: returnedPage
                    } = response;
                    currentPage = returnedPage; // อัปเดต currentPage จาก response

                    let html = '';
                    if (products.length === 0) {
                        html = '<p class="text-gray-500 col-span-3">ไม่พบข้อมูล</p>';
                    } else {
                        products.forEach(product => {
                            html += `
                    <a href="product_detail?id=${product.food_product_id}&type=food"
                        class="bg-rose-100 rounded-2xl shadow p-4 flex flex-col items-center transform transition hover:scale-105 hover:shadow-lg">
                        <img src="${product.picture || '../image/rice_product/A.jpg'}"
                            alt="${product.product_name}" class="rounded-xl mb-4 w-full h-40 object-cover" />
                        <div class="flex flex-col gap-2 w-full">
                            <div class="w-full px-4 py-1 rounded-full text-sm text-gray-700 shadow bg-white text-center">
                                ${product.product_name}
                            </div>
                            <div class="w-full px-4 py-1 rounded-full text-sm text-gray-700 shadow bg-white text-center">
                                ${product.rice_variety_th_name}
                            </div>
                        </div>
                    </a>`;
                        });
                    }
                    $('.grid').html(html);

                    // 👉 สร้าง pagination พร้อม Prev / Next และย่อหน้าหลายๆ หน้า
                    const totalPages = Math.ceil(total / perPage);
                    let paginationHtml = '';

                    const createBtn = (i) => `
                    <button class="px-3 py-1 rounded ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300'}"
                        onclick="goToPage(${i})">${i}</button>`;

                    const addEllipsis = () => `<span class="px-3 py-1 text-gray-400">...</span>`;

                    // Prev button
                    if (currentPage > 1) {
                        paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300" onclick="goToPage(${currentPage - 1})">&laquo; Prev</button>`;
                    }

                    const maxVisible = 5;
                    let start = Math.max(2, currentPage - 1);
                    let end = Math.min(totalPages - 1, currentPage + 1);

                    if (currentPage <= 3) {
                        start = 2;
                        end = Math.min(totalPages - 1, 5);
                    } else if (currentPage >= totalPages - 2) {
                        start = Math.max(2, totalPages - 4);
                        end = totalPages - 1;
                    }

                    // Always show first page
                    paginationHtml += createBtn(1);

                    if (start > 2) {
                        paginationHtml += addEllipsis();
                    }

                    for (let i = start; i <= end; i++) {
                        paginationHtml += createBtn(i);
                    }

                    if (end < totalPages - 1) {
                        paginationHtml += addEllipsis();
                    }

                    if (totalPages > 1) {
                        paginationHtml += createBtn(totalPages);
                    }

                    // Next button
                    if (currentPage < totalPages) {
                        paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300" onclick="goToPage(${currentPage + 1})">Next &raquo;</button>`;
                    }

                    $('.pagination').html(paginationHtml);
                });
            }

            // ใช้ global function สำหรับปุ่ม
            window.goToPage = function(page) {
                currentPage = page;
                fetchProducts(currentSearch, currentType, currentPage);
            }

            $('#searchInput').on('input', function() {
                currentSearch = $(this).val();
                currentPage = 1;
                fetchProducts(currentSearch, currentType, currentPage);
            });

            $('.filter-btn').on('click', function() {
                currentType = $(this).data('type');
                currentPage = 1;
                fetchProducts(currentSearch, currentType, currentPage);
            });

            // โหลดครั้งแรก
            fetchProducts();
        });
    </script>


    <?php include '../loadtab/f.php'; ?>
</body>

</html>