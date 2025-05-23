<?php
session_start();

// แสดง error (เปิดเฉพาะตอนพัฒนา)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// เชื่อมต่อฐานข้อมูล
include 'connect/dbcon.php';

// ถ้าเป็น POST ให้ประมวลผลข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $userId = $_POST['userId'] ?? '';
    $displayName = $_POST['displayName'] ?? '';
    $email = $_POST['email'] ?? '';
    $pictureUrl = $_POST['pictureUrl'] ?? '';

    if (empty($userId) || empty($displayName)) {
        echo json_encode(['error' => 'ข้อมูลไม่ครบ']);
        exit;
    }

    // ตรวจสอบว่ามีบัญชีอยู่แล้วหรือไม่
    $sql = "SELECT * FROM accounts WHERE id = :id OR email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId, 'email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // อัปเดตภาพโปรไฟล์
        $update = $pdo->prepare("UPDATE accounts SET picture = :picture WHERE id = :id OR email = :email");
        $update->execute([
            'picture' => $pictureUrl,
            'id' => $userId,
            'email' => $email
        ]);
        $role = $user['role'];
    } else {
        // เพิ่มผู้ใช้ใหม่
        $insert = $pdo->prepare("INSERT INTO accounts (id, name, email, role, picture) 
                                 VALUES (:id, :name, :email, 'User', :picture)");
        $insert->execute([
            'id' => $userId,
            'name' => $displayName,
            'email' => $email,
            'picture' => $pictureUrl
        ]);
        $role = 'User';
    }

    $_SESSION['user'] = [
        'id' => $userId,
        'name' => $displayName,
        'email' => $email,
        'role' => $role,
        'picture' => $pictureUrl,
    ];

    echo json_encode(['role' => $role]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>LINE-auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            liff.init({
                liffId: "2007460484-WlA3R3By", // <-- เปลี่ยนเป็น LIFF ID ของคุณ
                withLoginOnExternalBrowser: true,
                loginConfig: {
                    redirectUri: window.location.href,
                    scopes: ["profile", "email"]
                }
            }).then(() => {
                if (!liff.isLoggedIn()) {
                    liff.login();
                } else {
                    Promise.all([liff.getProfile(), liff.getDecodedIDToken()])
                        .then(([profile, idToken]) => {
                            const userData = {
                                userId: profile.userId,
                                displayName: profile.displayName,
                                pictureUrl: profile.pictureUrl,
                                email: idToken?.email || ""
                            };

                            fetch(window.location.href, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams(userData)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.role === 'Admin') {
                                    window.location.href = "/admin/dashboard";
                                } else if (data.role === 'User') {
                                    window.location.href = "/user/dashboard";
                                } else {
                                    alert("ไม่สามารถระบุสิทธิ์การใช้งานได้");
                                }
                            })
                            .catch(err => {
                                console.error("Fetch error:", err);
                                alert("เกิดข้อผิดพลาดในการติดต่อเซิร์ฟเวอร์");
                            });
                        })
                        .catch(err => {
                            console.error("Error getting profile:", err);
                        });
                }
            }).catch(err => console.error("LIFF init error:", err));
        });
    </script>
</body>
</html>
