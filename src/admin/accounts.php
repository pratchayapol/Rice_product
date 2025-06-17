<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // โหลด Composer autoload

use JasonGrimes\Paginator;

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../session_timeout');
    exit;
}

include '../connect/dbcon.php';

$stmt = $pdo->prepare("SELECT * FROM accounts");
$stmt->execute();
$accounts = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการบัญชีผู้ใช้งาน</title>
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

    <div class="pt-24 flex items-center justify-center min-h-screen">
        <div class="w-full px-6"> <!-- ขยายเต็มจอและมี padding ขอบ -->
            <div class="bg-white p-10 rounded-2xl shadow-xl w-full text-center">


                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-rose-300 px-4 py-2 rounded-full shadow-md">
                           จัดการบัญชีผู้ใช้งาน
                        </h3>
                        
                        <div class="overflow-x-auto p-6">
                            <table id="productTable1" class="min-w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                <thead class="bg-rose-200 text-gray-800">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle">ภาพโปรไฟล์</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle">ชื่อบัญชีผู้ใช้</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle">อีเมล</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle">หมายเลข id line</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle">สิทธิ์การใช้งาน</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle">แก้ไขสิทธิ์การใช้งาน</th>
                                    </tr>

                                </thead>
                                <tbody class="bg-white">
                                    <?php foreach ($accounts as $account): ?>
                                        <tr class="hover:bg-yellow-50 transition">
                                            <td class="border border-gray-300 px-4 py-2">
                                                <div class="flex justify-center items-center">
                                                    <img src="<?= htmlspecialchars($account['picture'] ?? '') ?: '../image/rice_product/A.jpg' ?>"
                                                        alt="<?= htmlspecialchars($account['name']) ?>"
                                                        class="w-24 h-24 object-cover rounded-full shadow" />

                                                </div>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <?= htmlspecialchars($account['name']) ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?= !empty($account['email']) ? htmlspecialchars($account['email']) : '-' ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?= !empty($account['line_user_id']) ? htmlspecialchars($account['line_user_id']) : '-' ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?= !empty($account['role']) ? htmlspecialchars($account['role']) : '-' ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                

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
        <script>
            $(document).ready(function() {
                $('#productTable1').DataTable({
                    language: {
                        search: "ค้นหา:",
                        lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                        info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                        paginate: {
                            first: "หน้าแรก",
                            last: "หน้าสุดท้าย",
                            next: "ถัดไป",
                            previous: "ก่อนหน้า"
                        },
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    }
                });
            });

            $(document).ready(function() {
                $('#productTable2').DataTable({
                    language: {
                        search: "ค้นหา:",
                        lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                        info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                        paginate: {
                            first: "หน้าแรก",
                            last: "หน้าสุดท้าย",
                            next: "ถัดไป",
                            previous: "ก่อนหน้า"
                        },
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    }
                });
            });

            $(document).ready(function() {
                $('#productTable3').DataTable({
                    language: {
                        search: "ค้นหา:",
                        lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                        info: "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                        paginate: {
                            first: "หน้าแรก",
                            last: "หน้าสุดท้าย",
                            next: "ถัดไป",
                            previous: "ก่อนหน้า"
                        },
                        zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                    }
                });
            });
        </script>

    </div>


    <!-- Modal เต็มจอ (ใช้ร่วมกัน) -->
    <div id="imageModal"
        class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center hidden"
        onclick="closeImageModal()">
        <img id="modalImage" src="" alt="รูปเต็ม" class="max-w-full max-h-full rounded shadow-lg">
    </div>




    <script>
        function openImageModal(src) {
            const modal = document.getElementById("imageModal");
            const img = document.getElementById("modalImage");
            img.src = src;
            modal.classList.remove("hidden");
        }

        function closeImageModal() {
            const modal = document.getElementById("imageModal");
            modal.classList.add("hidden");
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