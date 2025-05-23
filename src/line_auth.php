<?php
session_start();
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

// เชื่อมต่อฐานข้อมูล
include 'connect/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'] ?? '';
    $displayName = $_POST['displayName'] ?? '';
    $email = $_POST['email'] ?? '';
    $pictureUrl = $_POST['pictureUrl'] ?? '';

    // ตรวจสอบว่ามีบัญชีหรือยัง
    $sql = "SELECT * FROM accounts WHERE id = :id OR email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId, 'email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        $updateSql = "UPDATE accounts SET picture = :picture WHERE id = :id OR email = :email";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            'picture' => $pictureUrl,
            'id' => $userId,
            'email' => $email,
        ]);
        $role = $user['role'];
    } else {
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

    $_SESSION['user'] = [
        'id' => $userId,
        'name' => $displayName,
        'email' => $email,
        'role' => $role,
        'picture' => $pictureUrl,
    ];

    // ส่ง role กลับให้ JS redirect
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
                                email: idToken?.email || "ไม่ทราบอีเมล"
                            };

                            // ส่งข้อมูลไปยัง PHP ด้วย fetch แบบ POST
                            fetch(window.location.href, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams(userData)
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.role === 'Admin') {
                                    window.location.href = "/admin/dashboard";
                                } else {
                                    window.location.href = "/user/dashboard";
                                }
                            })
                            .catch(err => console.error('Fetch Error:', err));
                        })
                        .catch(err => console.error('Error getting profile:', err));
                }
            }).catch(err => console.error('LIFF Initialization failed:', err));
        });
    </script>
</body>
</html>
