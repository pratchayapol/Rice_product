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
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-4 bg-amber-300 px-4 py-2 rounded-full shadow-md">
                            จัดการบัญชีผู้ใช้งาน
                        </h3>

                        <div class="overflow-x-auto p-6">
                            <table id="productTable1" class="min-w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                <thead class="bg-amber-200 text-gray-800">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle w-[150px]">ภาพโปรไฟล์</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle w-[325px]">ชื่อบัญชีผู้ใช้</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle w-[300px]">อีเมล</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center align-middle w-[300px]">หมายเลข id line</th>
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
                                                <div class="flex justify-center items-center">
                                                    <!-- ปุ่มเปิด Modal -->
                                                    <button
                                                        onclick="openModal('modal-<?= $account['id_account'] ?>')"
                                                        class="mt-2 inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-full shadow transition">
                                                        แก้ไข
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div
                                                    id="modal-<?= $account['id_account'] ?>"
                                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                                                    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl relative">

                                                        <!-- ปุ่มปิดมุมขวา -->
                                                        <button
                                                            onclick="closeModal('modal-<?= $account['id_account'] ?>')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-black text-xl font-bold">
                                                            &times;
                                                        </button>

                                                        <h2 class="text-xl font-semibold mb-4">แก้ไขสิทธิ์การใช้งาน</h2>

                                                        <form method="POST" action="">
                                                            <input type="hidden" name="id_account" value="<?= htmlspecialchars($account['id_account']) ?>">

                                                            <label for="role-<?= $account['id_account'] ?>" class="block text-sm font-medium text-gray-700 mb-1">
                                                                เลือกสิทธิ์
                                                            </label>
                                                            <select
                                                                name="role"
                                                                id="role-<?= $account['id_account'] ?>"
                                                                class="w-full border rounded-lg px-3 py-2 mb-4 text-sm"
                                                                required>
                                                                <option value="User" <?= $account['role'] === 'User' ? 'selected' : '' ?>>User</option>
                                                                <option value="Admin" <?= $account['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                            </select>

                                                            <div class="flex justify-end gap-2">
                                                                <button
                                                                    type="button"
                                                                    onclick="closeModal('modal-<?= $account['id_account'] ?>')"
                                                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium rounded-lg shadow">
                                                                    ยกเลิก
                                                                </button>
                                                                <button
                                                                    type="submit"
                                                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                                                                    บันทึก
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>

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

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_account = $_POST['id_account'] ?? null;
        $role = $_POST['role'] ?? null;

        if ($id_account && $role && in_array($role, ['User', 'Admin'])) {
            try {
                // 3. เตรียมคำสั่ง SQL ปลอดภัย
                $stmt = $pdo->prepare("UPDATE accounts SET role = :role WHERE id_account = :id_account");
                $stmt->execute([
                    ':role' => $role,
                    ':id_account' => $id_account
                ]);

    ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'อัปเดตสิทธิ์การใช้งานเรียบร้อยแล้ว',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'accounts'; // เปลี่ยนไปหน้า accounts
                            }
                        });
                    });
                </script>
    <?php
                exit;
            } catch (PDOException $e) {
                // 5. จัดการ error
                echo "เกิดข้อผิดพลาดในการอัปเดต: " . $e->getMessage();
            }
        } else {
            echo "ข้อมูลไม่ถูกต้อง";
        }
    } else {
        // echo "Method ไม่ถูกต้อง";
    }
    ?>

    <?php include '../loadtab/f.php'; ?>
</body>

</html>