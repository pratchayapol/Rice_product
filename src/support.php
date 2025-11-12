<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คณะทำงาน RGBA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-3">
                คณะทำงาน
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-green-500 mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4 text-lg">แอปพลิเคชันธนาคารเชื้อพันธุกรรมข้าว Rice Germplasm Bank Application</p>
        </div>

        <!-- Developer Cards -->
        <div class="grid md:grid-cols-2 gap-8">
            
            <?php
            // ข้อมูลผู้พัฒนา
            $developers = [
                [
                    'name' => 'นางสาวปิยรัตน์ พลยะเรศ',
                    'position' => 'นักวิชาการเกษตรชำนาญการ',
                    'email' => 'piyarat.p@rice.mail.go.th',
                    'image' => '/image/files-rice-1719538646197.png', // เปลี่ยนเป็น path รูปภาพจริง
                    'color' => 'from-blue-500 to-blue-600'
                ],
                [
                    'name' => 'นายปรัชญาพล จำปาลาด',
                    'position' => 'ผู้ช่วยวิจัย', // เติมตำแหน่งที่ต้องการ
                    'email' => 'pratchayapol2543@gmail.com', // เติมอีเมลถ้ามี
                    'image' => '/image/IMG_1629.PNG', // เปลี่ยนเป็น path รูปภาพจริง
                    'color' => 'from-green-500 to-green-600'
                ]
            ];

            foreach ($developers as $dev) {
                ?>
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                    <!-- Card Header with Gradient -->
                    <div class="h-32 bg-gradient-to-r <?php echo $dev['color']; ?>"></div>
                    
                    <!-- Profile Image -->
                    <div class="relative -mt-16 text-center px-6">
                        <div class="inline-block">
                            <img src="<?php echo $dev['image']; ?>" 
                                 alt="<?php echo $dev['name']; ?>" 
                                 class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover mx-auto"
                                 onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($dev['name']); ?>&size=128&background=random&color=fff&bold=true'">
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="px-6 pb-8 pt-4">
                        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">
                            <?php echo $dev['name']; ?>
                        </h2>
                        
                        <p class="text-center text-gray-600 mb-6 text-sm">
                            <?php echo $dev['position']; ?>
                        </p>

                        <!-- Contact Info -->
                        <?php if (!empty($dev['email'])) { ?>
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:<?php echo $dev['email']; ?>" 
                                   class="text-blue-600 hover:text-blue-700 text-sm transition-colors">
                                    <?php echo $dev['email']; ?>
                                </a>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Contact Button -->
                        <div class="text-center">
                            <a href="mailto:<?php echo $dev['email']; ?>" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r <?php echo $dev['color']; ?> text-white font-medium rounded-lg hover:opacity-90 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                ติดต่อ
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

        <!-- Footer Info -->
        <div class="mt-12 text-center">
            <div class="inline-block bg-white rounded-lg shadow-md px-6 py-4">
                <p class="text-gray-600 text-sm">
                    <span class="font-semibold">หมายเหตุ:</span> 
                    หากต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อผู้พัฒนาระบบผ่านอีเมลด้านบน
                </p>
            </div>
        </div>
    </div>
</body>
</html>