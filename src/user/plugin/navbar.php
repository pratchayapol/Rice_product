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
                            <a href="product_cosmetic" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์เวชสำอางค์</a>
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
                <!-- Group Wrapper -->
                <div class="relative" id="menu-wrapper">
                    <button id="menu-button" class="bg-white text-gray-700 rounded-full px-4 py-2 hover:bg-gray-100 flex items-center gap-1">
                        ผลิตภัณฑ์ทั้งหมด
                        <!-- ลูกศรลง -->
                        <svg id="menu-arrow" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdown-menu"
                        class="absolute left-0 mt-1 w-52 bg-white rounded-lg shadow-lg z-50 hidden flex-col">
                        <a href="product_food" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์อาหาร</a>
                        <a href="product_cosmetic" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์เวชสำอางค์</a>
                        <a href="product_medical" class="px-4 py-2 text-gray-700 hover:bg-gray-100">ผลิตภัณฑ์การแพทย์</a>
                    </div>
                </div>

                <a href="profile" class="block bg-white text-gray-700 rounded-full px-4 py-2">บัญชีผู้ใช้งาน</a>
            </div>
        </div>
    </div>
</nav>

<script>
    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const menuArrow = document.getElementById('menu-arrow');

    menuButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');

        // ตรวจสอบว่าหน้าจอเล็กกว่า 768px (mobile)
        if (window.innerWidth < 768) {
            menuArrow.classList.toggle('rotate-180');
        } else {
            // ถ้า desktop ให้ reset ลูกศรไม่หมุน
            menuArrow.classList.remove('rotate-180');
        }
    });

    // ถ้าต้องการรีเซ็ตลูกศรตอน resize หน้าจอ (optional)
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            menuArrow.classList.remove('rotate-180');
            dropdownMenu.classList.add('hidden'); // ซ่อนเมนู desktop ด้วยถ้าต้องการ
        }
    });
</script>