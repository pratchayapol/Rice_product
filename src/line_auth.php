<?php
session_start();
ob_start();

// เปิด error ระหว่างพัฒนา (ควรปิดใน production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log POST ชั่วคราว
file_put_contents('log.txt', print_r($_POST, true));

// เชื่อมต่อฐานข้อมูล
include 'connect/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId       = $_POST['userId'] ?? '';
    $displayName  = $_POST['displayName'] ?? '';
    $email        = $_POST['email'] ?? '';
    $pictureUrl   = $_POST['pictureUrl'] ?? '';

    if (!$userId || !$displayName || !$email) {
        echo json_encode(['error' => 'ข้อมูลไม่ครบ']);
        exit;
    }

    // ตรวจสอบว่ามีบัญชีหรือยัง
    $sql = "SELECT * FROM accounts WHERE id = :id OR email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId, 'email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // อัปเดตรูปภาพ
        $updateSql = "UPDATE accounts SET picture = :picture WHERE id = :id OR email = :email";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            'picture' => $pictureUrl,
            'id' => $userId,
            'email' => $email,
        ]);
        $role = $user['role'];
    } else {
        // สร้างบัญชีใหม่
        $insertSql = "INSERT INTO accounts (id, name, email, role, picture) VALUES (:id, :name, :email, 'User', :picture)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute([
            'id' => $userId,
            'name' => $displayName,
            'email' => $email,
            'picture' => $pictureUrl,
        ]);
        $role = 'User';
    }

    // เก็บ session
    $_SESSION['user'] = [
        'id' => $userId,
        'name' => $displayName,
        'email' => $email,
        'role' => $role,
        'picture' => $pictureUrl,
    ];

    // ส่งกลับ role
    echo json_encode(['role' => $role]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>LINE-auth</title>
    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            liff.init({
                liffId: "2007460484-WlA3R3By",
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
                                email: idToken?.email || "noemail@example.com"
                            };

                            // ส่งข้อมูลไป PHP
                            fetch(window.location.href, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams(userData)
                            })
                            .then(res => res.text())
                            .then(text => {
                                console.log('Raw response:', text);
                                let data;
                                try {
                                    data = JSON.parse(text);
                                } catch (err) {
                                    alert('ไม่สามารถแปลงข้อมูลจากเซิร์ฟเวอร์ได้');
                                    console.error(err);
                                    return;
                                }

                                if (data.role === 'Admin') {
                                    window.location.href = "/admin/dashboard";
                                } else {
                                    window.location.href = "/user/dashboard";
                                }
                            })
                            .catch(err => {
                                alert('เกิดข้อผิดพลาดระหว่างส่งข้อมูล');
                                console.error('Fetch Error:', err);
                            });
                        })
                        .catch(err => console.error('LIFF profile error:', err));
                }
            }).catch(err => console.error('LIFF Init Error:', err));
        });
    </script>
</body>
</html>
