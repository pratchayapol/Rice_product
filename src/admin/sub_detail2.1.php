<!-- ปุ่มสลับภาษา -->
<div class="flex justify-end mb-4">
    <button onclick="toggleLanguage()" class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-full shadow">
        🌐 <span id="language-label">English</span>
    </button>
</div>

<div id="method" class="tab-content">
    <!-- ภาษาไทย -->
    <div id="thai-section">
        <div class="bg-white p-4 rounded-lg mb-4">
            <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">อุปกรณ์</h4>
            <div style='border:0px solid #ccc; padding:10px;'>
                <?php
                if (is_null($ingredients_and_equipment) || $ingredients_and_equipment === '') {
                    echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                } else {
                ?>
                    <textarea id="ingredients_th" name="ingredients_and_equipment" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($ingredients_and_equipment ?? 'รอเจ้าหน้าที่เพิ่มข้อมูล') ?></textarea>
                <?php } ?>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg">
            <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">วิธีทำ</h4>
            <div style='border:0px solid #ccc; padding:10px;'>
                <?php
                if (is_null($instructions) || trim($instructions) === '') {
                    echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                } else {
                ?>
                    <textarea id="instructions" name="instructions" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($instructions ?? 'รอเจ้าหน้าที่เพิ่มข้อมูล') ?></textarea>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- ภาษาอังกฤษ -->
    <div id="english-section" style="display: none;">
        <div class="bg-white p-4 rounded-lg">
            <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">Ingredients and Equipment</h4>
            <div style='border:0px solid #ccc; padding:10px;'>
                <?php
                if (is_null($ingredients_and_equipment_en) || trim($ingredients_and_equipment_en) === '') {
                    echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                } else {
                ?>
                    <textarea id="ingredients_and_equipment_en" name="ingredients_and_equipment_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($ingredients_and_equipment_en ?? 'Waiting for data') ?></textarea>
                <?php } ?>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg">
            <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">Instructions</h4>
            <div style='border:0px solid #ccc; padding:10px;'>
                <?php
                if (is_null($instructions_en) || trim($instructions_en) === '') {
                    echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                } else {
                ?>
                    <textarea id="instructions_en" name="instructions_en" rows="5"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400"><?= htmlspecialchars($instructions_en ?? 'Waiting for data') ?></textarea>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript สำหรับสลับภาษา -->
<script>
    let isThai = true;

    function toggleLanguage() {
        isThai = !isThai;
        document.getElementById("thai-section").style.display = isThai ? "block" : "none";
        document.getElementById("english-section").style.display = isThai ? "none" : "block";
        document.getElementById("language-label").innerText = isThai ? "English" : "ภาษาไทย";
    }
</script>
