<nav class="fixed top-0 left-0 w-full z-50 shadow-lg backdrop-blur-md">
    <!-- Background Image Layer -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('../image/nav.jpg'); z-index: -1;"></div>

    <!-- Overlay Layer -->
    <div class="bg-black bg-opacity-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4">
                    <img src="../image/logo.png" alt="Rice Department Logo" class="w-12 h-12 rounded-full border border-white" />
                    <div class="text-white">
                        <div class="text-lg font-semibold">ระบบบริการข้อมูลแปรรูปผลิตภัณฑ์ข้าวไทย</div>
                        <div class="text-sm">Smart Thai Rice Processing Information System</div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-4">
                    <a href="dashboard" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">หน้าหลัก</a>
                    <!-- Dropdown Container -->
                    <div class="relative group">
                        <button class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100 focus:outline-none">
                            ผลิตภัณฑ์ทั้งหมด
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10 hidden group-hover:block">
                            <a href="product_all?type=food" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">อาหาร</a>
                            <a href="product_all?type=cosmetic" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">เวชสำอางค์</a>
                            <a href="product_all?type=medical" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">การแพทย์</a>
                        </div>
                    </div>
                    <a href="profile" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">บัญชีผู้ใช้งาน</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="menu-toggle" class="text-white focus:outline-none">☰</button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 space-y-2 pb-4">
                <a href="dashboard" class="block bg-white text-gray-700 rounded-full px-4 py-2">หน้าหลัก</a>
                <!-- Dropdown Container -->
                <div class="relative group">
                    <button class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100 focus:outline-none">
                        ผลิตภัณฑ์ทั้งหมด
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10 hidden group-hover:block">
                        <a href="product_all?type=food" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">อาหาร</a>
                        <a href="product_all?type=cosmetic" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">เวชสำอางค์</a>
                        <a href="product_all?type=medical" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">การแพทย์</a>
                    </div>
                </div>
                <a href="profile" class="block bg-white text-gray-700 rounded-full px-4 py-2">บัญชีผู้ใช้งาน</a>
            </div>
        </div>
    </div>
</nav>