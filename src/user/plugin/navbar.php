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
                        <div class="text-lg font-semibold">ฐานข้อมูลแปรรูปผลิตภัณฑ์ข้าว</div>
                        <div class="text-sm">Rice Product Processing Database</div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-4 items-center">
                    <a href="dashboard" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">หน้าหลัก</a>

                    <!-- Group Wrapper -->
                    <div class="relative" id="menu-wrapper">
                        <button id="menu-button" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100">
                            ผลิตภัณฑ์ทั้งหมด
                        </button>

                        <div id="dropdown-menu"
                            class="absolute left-0 mt-1 w-52 bg-white rounded-lg shadow-lg z-50 hidden flex-col">
                            <a href="product_food" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์อาหาร</a>
                            <a href="product_cosmetic" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์เวชสำอาง</a>
                            <a href="product_medical" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์การแพทย์</a>
                        </div>
                    </div>

                    <script>
                        const button = document.getElementById('menu-button');
                        const dropdown = document.getElementById('dropdown-menu');
                        const wrapper = document.getElementById('menu-wrapper');

                        let hideTimeout;

                        function showMenu() {
                            clearTimeout(hideTimeout);
                            dropdown.classList.remove('hidden');
                            dropdown.classList.add('flex');
                        }

                        function hideMenuWithDelay() {
                            hideTimeout = setTimeout(() => {
                                dropdown.classList.remove('flex');
                                dropdown.classList.add('hidden');
                            }, 500); // ซ่อนหลัง 0.5 วินาที
                        }

                        wrapper.addEventListener('mouseenter', showMenu);
                        wrapper.addEventListener('mouseleave', hideMenuWithDelay);
                    </script>

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

                <!-- Dropdown toggle -->
                <div>
                    <button id="mobile-submenu-toggle" class="w-full text-left bg-white text-gray-700 rounded-full px-4 py-2 flex justify-between items-center">
                        ผลิตภัณฑ์ทั้งหมด
                        <span id="submenu-arrow">▼</span>
                    </button>
                    <div id="mobile-submenu" class="hidden mt-2 ml-4 space-y-2">
                        <a href="product_food" class="block bg-white text-gray-700 rounded-full px-4 py-2">อาหาร</a>
                        <a href="product_cosmetic" class="block bg-white text-gray-700 rounded-full px-4 py-2">เวชสำอางค์</a>
                        <a href="product_medical" class="block bg-white text-gray-700 rounded-full px-4 py-2">การแพทย์</a>
                    </div>
                </div>

                <a href="profile" class="block bg-white text-gray-700 rounded-full px-4 py-2">บัญชีผู้ใช้งาน</a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Toggle submenu
    document.getElementById('mobile-submenu-toggle').addEventListener('click', function() {
        const submenu = document.getElementById('mobile-submenu');
        const arrow = document.getElementById('submenu-arrow');
        submenu.classList.toggle('hidden');

        // เปลี่ยนลูกศร ▼/▲
        if (submenu.classList.contains('hidden')) {
            arrow.textContent = '▼';
        } else {
            arrow.textContent = '▲';
        }
    });
</script>