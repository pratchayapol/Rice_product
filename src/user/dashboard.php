<?php
session_start();

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
    <link rel="stylesheet" href="../css/bg.css">
    <!-- animation -->
    <link rel="stylesheet" href="../css/animation.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
      <?php include '../loadtab/h.php'; ?>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว</h1>
                <h2 class="text-xl text-gray-600">Rice Products Database</h2>
            </div>
            
            <!-- Search Bar -->
            <div class="mt-4 md:mt-0 relative w-full md:w-64">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                    <input 
                        type="text" 
                        placeholder="ค้นหา..." 
                        class="py-2 px-4 w-full focus:outline-none text-gray-700"
                    >
                    <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
                <div class="absolute right-0 mt-1 text-xs text-gray-500">Q</div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center py-12 text-gray-500">
                <p>เนื้อหาของฐานข้อมูลจะแสดงที่นี่</p>
                <p class="text-sm mt-2">Database content will appear here</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>© 2023 ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว | Rice Products Database</p>
        </div>
    </div>
        <?php include '../loadtab/f.php'; ?>
</body>

</html>