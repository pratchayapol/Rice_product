<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';

if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    header('Content-Type: application/json');

    try {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';

        if ($query !== '') {
            $stmt = $pdo->prepare("
    SELECT food_product_id AS id, rice_variety_th_name, rice_variety_en_name, product_name, 'food' AS type 
    FROM food_product
    WHERE rice_variety_th_name LIKE :query 
       OR rice_variety_en_name LIKE :query 
       OR product_name LIKE :query 
    UNION
    SELECT cosmetic_product_id AS id, rice_variety_th_name, rice_variety_en_name, product_name, 'cosmetic' AS type 
    FROM cosmetic_product
    WHERE rice_variety_th_name LIKE :query 
       OR rice_variety_en_name LIKE :query 
       OR product_name LIKE :query 
    UNION
    SELECT medical_product_id AS id, rice_variety_th_name, rice_variety_en_name, product_name, 'medical' AS type 
    FROM medical_product
    WHERE rice_variety_th_name LIKE :query 
       OR rice_variety_en_name LIKE :query 
       OR product_name LIKE :query 
");


            $searchTerm = "%" . $query . "%";
            $stmt->execute(['query' => $searchTerm]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results);
        } else {
            echo json_encode([]);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('search-input');
            const suggestionBox = document.getElementById('suggestions');

            input.addEventListener('input', () => {
                const query = input.value;

                if (query.length < 2) {
                    suggestionBox.innerHTML = '';
                    suggestionBox.classList.add('hidden');
                    return;
                }

                fetch(`?ajax=1&q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        console.log(data); // ดูว่าได้ key อะไรกลับมา
                        suggestionBox.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const li = document.createElement('li');
                                li.textContent = `${item.rice_variety_th_name} (${item.rice_variety_en_name}) - ${item.product_name}`;
                                li.className = 'px-4 py-2 hover:bg-green-100 cursor-pointer';
                                li.onclick = () => {
                                    window.location.href = `product_detail.php?id=${item.id}&type=${item.type}`;
                                };
                                suggestionBox.appendChild(li);
                            });
                            suggestionBox.classList.remove('hidden');
                        } else {
                            suggestionBox.classList.add('hidden');
                        }
                    });
            });
        });
    </script>

</head>

<body class="bg t1">
    <?php include '../loadtab/h.php'; ?>
    <!-- Navigation Bar -->
    <?php include './plugin/navbar.php' ?>
    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="text-center bg-white/70 p-10 rounded-2xl shadow-xl max-w-xl w-full hover:scale-105 transform transition duration-300">
            <h1 class="text-3xl md:text-4xl font-bold text-black mb-2">ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว</h1>
            <p class="text-xl text-gray-800 mb-6">Rice Product Processing Database</p>

            <div class="flex justify-center mb-8">
                <div class="relative w-full max-w-md">
                    <input id="search-input" type="text" placeholder="ค้นหา" class="w-full px-5 py-3 rounded-full shadow border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <span class="absolute right-4 top-3.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <ul id="suggestions" class="absolute z-10 w-full bg-white border border-gray-300 rounded-b-lg mt-1 max-h-60 overflow-y-auto hidden"></ul>
                </div>
            </div>

            <div class="flex justify-center space-x-6">
                <img src="../image/dash1.png" alt="Brown Rice" class="w-20 h-20 rounded-full object-cover shadow-lg">
                <img src="../image/dash2.png" alt="White Rice" class="w-20 h-20 rounded-full object-cover shadow-lg">
                <img src="../image/dash3.png" alt="Black Rice" class="w-20 h-20 rounded-full object-cover shadow-lg">
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1 bg-yellow-500 text-white rounded-xl shadow p-4">
                        <p class="text-md">ผลิตภัณฑ์ทั้งหมด</p>
                        <p class="text-3xl font-bold">447</p>
                    </div>

                    <div class="col-span-1 bg-white border rounded-xl shadow p-4">
                        <p class="text-md">ผลิตภัณฑ์อาหาร</p>
                        <p class="text-3xl font-bold">380</p>
                    </div>

                    <div class="col-span-1 bg-white border rounded-xl shadow p-4">
                        <p class="text-md">ผลิตภัณฑ์เวชสำอาง</p>
                        <p class="text-3xl font-bold">73</p>
                    </div>

                    <div class="col-span-1 bg-white border rounded-xl shadow p-4">
                        <p class="text-md">ผลิตภัณฑ์ทางการแพทย์</p>
                        <p class="text-3xl font-bold">4</p>
                    </div>
                </div>

                <div class="mt-10 bg-white rounded-xl shadow p-6">
                    <canvas id="productChart"></canvas>
                </div>
            </div>

            <script>
                const ctx = document.getElementById('productChart').getContext('2d');
                const productChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['ผลิตภัณฑ์อาหาร', 'ผลิตภัณฑ์เวชสำอาง', 'ผลิตภัณฑ์ทางการแพทย์'],
                        datasets: [{
                            label: 'จำนวนผลิตภัณฑ์',
                            data: [380, 73, 4],
                            backgroundColor: [
                                '#a17600', // อาหาร
                                '#caa63c', // เวชสำอาง
                                '#e0bb3c' // การแพทย์
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.parsed} รายการ`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

        </div>


        <?php include '../loadtab/f.php'; ?>
</body>

</html>