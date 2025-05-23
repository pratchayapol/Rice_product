<?php
session_start();

// เปิดแสดง error สำหรับดีบัก (ปิดใน production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// เชื่อมต่อฐานข้อมูล (แก้ไขค่าตามของคุณ)
try {
    include 'connect/dbcon.php';
} catch (Exception $e) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
        exit;
    } else {
        die('Database connection failed: ' . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    try {
        $userId = $_POST['userId'] ?? '';
        $displayName = $_POST['displayName'] ?? '';
        $email = $_POST['email'] ?? '';
        $pictureUrl = $_POST['pictureUrl'] ?? '';

        if (empty($userId) || empty($displayName)) {
            throw new Exception('ข้อมูล userId หรือ displayName ไม่ครบ');
        }

        // กำหนดตัวแปรสำหรับค้นหาใน DB
        // ถ้า email ว่าง ให้ใช้ userId แทนเช็ค line_user_id
        if (!empty($email)) {
            $searchEmail = $email;
            $searchUserId = null;
        } else {
            $searchEmail = null;
            $searchUserId = $userId;
        }

        // ตรวจสอบว่ามีบัญชีอยู่แล้วหรือไม่ โดยเช็คจาก email หรือ line_user_id
        if ($searchEmail) {
            $sql = "SELECT * FROM accounts WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $searchEmail]);
        } else {
            $sql = "SELECT * FROM accounts WHERE line_user_id = :line_user_id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['line_user_id' => $searchUserId]);
        }
        $user = $stmt->fetch();

        if ($user) {
            // อัปเดตภาพโปรไฟล์และ line_user_id (ถ้าต้องการ)
            if ($searchEmail) {
                $update = $pdo->prepare("UPDATE accounts SET picture = :picture, line_user_id = :line_user_id WHERE email = :email");
                $update->execute([
                    'picture' => $pictureUrl,
                    'line_user_id' => $userId,
                    'email' => $searchEmail
                ]);
            } else {
                $update = $pdo->prepare("UPDATE accounts SET picture = :picture, email = :email WHERE line_user_id = :line_user_id");
                $update->execute([
                    'picture' => $pictureUrl,
                    'email' => $email, // อัพเดต email ถ้ามี
                    'line_user_id' => $searchUserId
                ]);
            }
            $role = $user['role'];
        } else {
            // เพิ่มผู้ใช้ใหม่ (ไม่ระบุ id ให้ DB สร้างอัตโนมัติ)
            $insert = $pdo->prepare("INSERT INTO accounts (name, email, role, picture, line_user_id) 
                                     VALUES (:name, :email, 'User', :picture, :line_user_id)");
            $insert->execute([
                'name' => $displayName,
                'email' => $email,
                'picture' => $pictureUrl,
                'line_user_id' => $userId
            ]);
            $role = 'User';
        }

        // เซฟ session
        $_SESSION['user'] = [
            'name' => $displayName,
            'email' => $email,
            'role' => $role,
            'picture' => $pictureUrl,
        ];

        echo json_encode(['role' => $role]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <title>LINE-auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            liff.init({
                liffId: "2007460484-WlA3R3By", // เปลี่ยนเป็น LIFF ID ของคุณ
                withLoginOnExternalBrowser: true,
                loginConfig: {
                    redirectUri: window.location.href,
                    scopes: ["profile", "email"]
                }
            }).then(() => {
                if (!liff.isLoggedIn()) {
                    liff.login();
                } else {
                    Promise.all([liff.getProfile(), liff.getDecodedIDToken()]).then(([profile, idToken]) => {
                            // console.log("Decoded ID Token:", idToken); // ดูทั้งหมดเลย
                            // console.log("Email from idToken:", idToken?.email); // ดูว่า undefined ไหม
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
                                .then(res => res.text())
                                .then(text => {
                                    console.log("Response text:", text);
                                    try {
                                        const data = JSON.parse(text);
                                        if (data.error) {
                                            alert("Error: " + data.error);
                                            return;
                                        }
                                        if (data.role === 'Admin') {
                                            window.location.href = "/admin/dashboard";
                                        } else if (data.role === 'User') {
                                            window.location.href = "/user/dashboard";
                                        } else {
                                            alert("ไม่สามารถระบุสิทธิ์การใช้งานได้");
                                        }
                                    } catch (err) {
                                        console.error("JSON parse error:", err);
                                        alert("เกิดข้อผิดพลาด: ไม่สามารถแปลงข้อมูลจากเซิร์ฟเวอร์ได้");
                                    }
                                })
                                .catch(err => {
                                    console.error("Fetch error:", err);
                                    alert("เกิดข้อผิดพลาดในการติดต่อเซิร์ฟเวอร์");
                                });
                        })
                        .catch(err => {
                            console.error("Error getting profile:", err);
                            alert("เกิดข้อผิดพลาดในการดึงข้อมูลโปรไฟล์");
                        });
                }
            }).catch(err => {
                console.error("LIFF init error:", err);
                alert("เกิดข้อผิดพลาดในการเริ่มต้น LIFF");
            });
        });
    </script>
</body>

</html>