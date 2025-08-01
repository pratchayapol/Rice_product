<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';



if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    // 👉 โหมด AJAX: การค้นหา
    try {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';

        if ($query !== '') {
            // การค้นหาข้อมูลจากทั้ง 3 ตาราง
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
            // ดึงจำนวนข้อมูลรวมถ้าไม่ได้ค้นหา
            $foodCount = $pdo->query("SELECT COUNT(*) FROM food_product")->fetchColumn();
            $cosmeticCount = $pdo->query("SELECT COUNT(*) FROM cosmetic_product")->fetchColumn();
            $medicalCount = $pdo->query("SELECT COUNT(*) FROM medical_product")->fetchColumn();
            $total = $foodCount + $cosmeticCount + $medicalCount;

            echo json_encode([
                'food' => (int)$foodCount,
                'cosmetic' => (int)$cosmeticCount,
                'medical' => (int)$medicalCount,
                'total' => (int)$total
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

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
                                    window.location.href = `product_detail?id=${item.id}&type=${item.type}`;
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
        <div class="w-full max-w-7xl px-4 md:px-8">
            <div class="text-center bg-white/75 py-24 px-10 rounded-2xl shadow-xl w-full mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-black mb-2 t1">ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว</h1>
                <p class="text-xl text-gray-800 mb-6 t1">Rice Product Processing Database</p>

                <div class="flex justify-center mb-8">
                    <div class="relative w-full max-w-md">
                        <input id="search-input" type="text" placeholder="ค้นหาผลิตภัณฑ์ข้าว" class="w-full px-5 py-3 rounded-full shadow border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <span class="absolute right-4 top-3.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <ul
                            id="suggestions"
                            class="absolute z-10 w-full bg-white border border-gray-300 rounded-b-lg mt-1 max-h-60 overflow-y-auto hidden text-left"></ul>
                    </div>
                </div>

                <!-- Section แสดงจำนวน + Chart -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- แสดงจำนวน -->
                    <div class="flex-1 grid grid-cols-2 lg:grid-cols-2 gap-4">
                        <div class="border rounded-xl shadow p-2 flex flex-col items-center justify-center text-center" style="background-color: #e8b927;">
                            <p class="text-xl">ผลิตภัณฑ์ทั้งหมด</p>
                            <p id="totalCount" class="text-3xl font-bold">0</p>
                        </div>

                        <!-- กล่องผลิตภัณฑ์อาหาร -->
                        <a href="#" class="block border rounded-xl shadow p-4 flex flex-col items-center justify-center text-center bg-[#ffd8c3] transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                            <p class="text-xl">ผลิตภัณฑ์อาหาร</p>
                            <p id="foodCount" class="text-3xl font-bold">0</p>
                        </a>

                        <!-- กล่องเวชสำอาง -->
                        <a href="#" class="block border rounded-xl shadow p-4 flex flex-col items-center justify-center text-center bg-[#fff2fc] transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                            <p class="text-xl">ผลิตภัณฑ์เวชสำอาง</p>
                            <p id="cosmeticCount" class="text-3xl font-bold">0</p>
                        </a>

                        <!-- กล่องผลิตภัณฑ์ทางการแพทย์ -->
                        <a href="#" class="block border rounded-xl shadow p-4 flex flex-col items-center justify-center text-center bg-[#e6f5ff] transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                            <p class="text-xl">ผลิตภัณฑ์ทางการแพทย์</p>
                            <p id="medicalCount" class="text-3xl font-bold">0</p>
                        </a>

                    </div>

                    <!-- Pie Chart -->
                    <div class="flex-1 bg-white rounded-xl shadow p-2 h-96">
                        <canvas id="productChart" class="w-full h-full"></canvas>
                    </div>






                </div>



            </div>


        </div>
    </div>

    <!-- Chart Script -->
    <script>
        Chart.defaults.font.family = 'Noto Sans Thai';

        function animateCounter(element, start, end, duration = 500) {
            if (start === end) {
                element.textContent = end;
                return;
            }
            const range = end - start;
            const increment = range / (duration / 16); // ประมาณ 60fps
            let current = start;
            const step = () => {
                current += increment;
                if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                    element.textContent = end;
                } else {
                    element.textContent = Math.floor(current);
                    requestAnimationFrame(step);
                }
            };
            step();
        }
        async function fetchProductCounts() {
            try {
                const response = await fetch('?ajax=1');
                const data = await response.json();

                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }

                animateCounter(document.getElementById('totalCount'),
                    parseInt(document.getElementById('totalCount').textContent || 0), data.total);

                animateCounter(document.getElementById('foodCount'),
                    parseInt(document.getElementById('foodCount').textContent || 0), data.food);

                animateCounter(document.getElementById('cosmeticCount'),
                    parseInt(document.getElementById('cosmeticCount').textContent || 0), data.cosmetic);

                animateCounter(document.getElementById('medicalCount'),
                    parseInt(document.getElementById('medicalCount').textContent || 0), data.medical);

                productChart.data.datasets[0].data = [data.food, data.cosmetic, data.medical];
                productChart.update();
            } catch (error) {
                console.error('Fetch failed:', error);
            }
        }


        const ctx = document.getElementById('productChart').getContext('2d');
        const productChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['ผลิตภัณฑ์อาหาร', 'ผลิตภัณฑ์เวชสำอาง', 'ผลิตภัณฑ์ทางการแพทย์'],
                datasets: [{
                    label: 'จำนวนผลิตภัณฑ์',
                    data: [0, 0, 0],
                    backgroundColor: ['#74ae71', '#cd9fde', '#4cc0f5'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 35 // 👈 ลดขนาดวงกลมโดยเพิ่ม padding รอบขอบ
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true, // 👈 เปิดการใช้ pointStyle แทนรูปทรงเริ่มต้น
                            pointStyle: 'circle', // 👈 ใช้วงกลมแทนสี่เหลี่ยม
                            padding: 25, // 👈 ระยะห่างระหว่างแผนภูมิกับ label ด้านล่าง
                            font: {
                                family: 'Noto Sans Thai'
                            }
                        }
                    },
                    tooltip: {
                        bodyFont: {
                            family: 'Noto Sans Thai'
                        },
                        titleFont: {
                            family: 'Noto Sans Thai'
                        },
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed} รายการ`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#000',
                        font: {
                            weight: 'bold',
                            family: 'Noto Sans Thai'
                        },
                        formatter: function(value, context) {
                            return value > 0 ? value : '';
                        },
                        anchor: 'end',
                        align: 'end',
                        offset: 2.5
                    }
                },
            },
            plugins: [ChartDataLabels]
        });

        fetchProductCounts(); // เรียกครั้งแรกทันที
        setInterval(fetchProductCounts, 1000); // เรียกซ้ำทุก 1 วินาที
    </script>


    <!-- Chat Icon ลอยมุมขวาล่าง -->
    <div
        id="chat-icon"
        class="fixed bottom-5 right-5 w-16 h-16 cursor-pointer z-50 group"
        title="สอบถามข้อมูลแปรรูปผลิตภัณฑ์ข้าว">
        <img src="/image/chat.png" alt="Chat Icon" class="w-full h-full" />
        <!-- Tooltip -->
        <div
            class="absolute bottom-full mb-2 right-0 hidden group-hover:block bg-gray-800 text-white text-sm rounded px-3 py-1 whitespace-nowrap">
            สอบถามข้อมูลแปรรูปผลิตภัณฑ์ข้าว
        </div>
    </div>

    <!-- Modal Overlay -->
    <div
        id="chat-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div
            id="chat-modal-content"
            class="bg-white rounded-lg w-96 max-w-full flex flex-col p-5 relative">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">ถามตอบข้อมูลแปรรูปผลิตภัณฑ์ข้าว</h2>
                <button
                    id="chat-modal-close"
                    class="text-2xl font-bold text-gray-700 hover:text-gray-900"
                    aria-label="Close">
                    &times;
                </button>
            </div>
            <div
                id="chat-messages"
                class="flex-grow border border-gray-300 rounded-md p-3 overflow-y-auto max-h-80 mb-4 space-y-3 text-sm"></div>
            <div class="flex space-x-2">
                <input
                    type="text"
                    id="chat-input"
                    placeholder="พิมพ์ข้อความที่นี่..."
                    class="flex-grow border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <button
                    id="chat-send-btn"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 disabled:opacity-50">
                    ส่ง
                </button>
            </div>
        </div>
    </div>

    <script>
        const chatIcon = document.getElementById('chat-icon');
        const chatModal = document.getElementById('chat-modal');
        const chatClose = document.getElementById('chat-modal-close');
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        const chatSendBtn = document.getElementById('chat-send-btn');

        // เปิด modal
        chatIcon.addEventListener('click', () => {
            chatModal.classList.remove('hidden');
            chatInput.focus();
        });

        // ปิด modal
        chatClose.addEventListener('click', () => {
            chatModal.classList.add('hidden');
            chatMessages.innerHTML = ''; // เคลียร์ข้อความเก่า
            chatInput.value = '';
        });

        // ปิด modal เมื่อคลิกนอกกล่อง chat modal (optional)
        chatModal.addEventListener('click', (e) => {
            if (e.target === chatModal) {
                chatModal.classList.add('hidden');
                chatMessages.innerHTML = '';
                chatInput.value = '';
            }
        });

        // ฟังก์ชันเพิ่มข้อความใน chat
        function addMessage(text, sender) {
            const div = document.createElement('div');
            div.classList.add('message', 'whitespace-pre-wrap', 'break-words');
            if (sender === 'user') {
                div.classList.add('text-right', 'text-blue-600');
            } else {
                div.classList.add('text-left', 'text-green-600');
            }
            div.textContent = text;
            chatMessages.appendChild(div);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // ส่งข้อความไป API
        async function sendMessage(message) {
            if (!message) return; // ป้องกันส่งข้อความว่าง

            addMessage(message, 'user');
            chatInput.value = '';
            chatSendBtn.disabled = true;

            try {
                const response = await fetch('https://rice_product_chat.pcnone.com/api/chat', {
                    method: 'POST',
                    headers: {
                        accept: 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message
                    }),
                });

                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();

                addMessage(data.gpt_response, 'bot');
            } catch (error) {
                addMessage('เกิดข้อผิดพลาดในการเชื่อมต่อ API', 'bot');
            } finally {
                chatSendBtn.disabled = false;
                chatInput.focus();
            }
        }

        // Event ส่งข้อความเมื่อคลิกปุ่มส่ง
        chatSendBtn.addEventListener('click', () => {
            const msg = chatInput.value.trim();
            if (msg) sendMessage(msg);
        });

        // กด Enter เพื่อส่งข้อความ
        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatSendBtn.click();
            }
        });
    </script>

    <?php include '../loadtab/f.php'; ?>
</body>

</html>