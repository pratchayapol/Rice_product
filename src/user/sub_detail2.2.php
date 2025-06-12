<div id="rice" class="tab-content hidden">
    <div class="bg-white p-4 rounded-lg mx-auto w-full">
        <div class="flex justify-center">
            <!-- กล่องเนื้อหา -->
            <div class="w-full max-w-2xl">
                <!-- ข้อมูลทั่วไป -->
                <div>
                    <h4 class="text-sm font-semibold mb-2 bg-white text-center rounded-full w-fit px-4 py-1 mx-auto shadow">
                        ข้อมูลทั่วไป
                    </h4>
                    <br>
                    <?php if (!empty($picture_rice)): ?>
                        <div class="flex justify-center">
                            <img src="<?php echo htmlspecialchars($picture_rice) ?>"
                                alt="รูปต้นข้าว"
                                class="rounded border object-cover w-48 h-48 cursor-pointer"
                                onclick="openImageModal(this.src)" />
                        </div>
                    <?php endif; ?>
                    <br>

                    <!-- ตารางข้อมูล -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-gray-700 table-auto">
                            <tbody>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold whitespace-nowrap">หมายเลขประจำพันธุ์ (G.S. No.):</td>
                                    <td class="text-left px-2 py-1"><?php echo $gs_no; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">ชื่อพันธุ์ไทย:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($display_thai_name); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">ชื่อพันธุ์อังกฤษ:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($display_english_name); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">ชื่อวิทยาศาสตร์:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($scientific_name); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">นิเวศการปลูกข้าว:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($rice_ecosystem); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">วันเดือนปีที่รับรอง/แนะนำ:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($date_of_approval_or_recommendation); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">สภาพภาพทั่วไป:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($general_status); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">อายุเก็บเกี่ยว (วัน):</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($harvest_age_days); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left px-2 py-1 font-semibold">ความไวต่อช่วงแสง:</td>
                                    <td class="text-left px-2 py-1"><?php echo htmlspecialchars($photoperiod_sensitivity); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- overflow-x-auto -->
                    <?php if (!empty($link_url)): ?>
                        <div class="mt-4 text-center">
                            <a href="<?php echo htmlspecialchars($link_url); ?>"
                                target="_blank"
                                class="inline-block bg-[#454b0b] hover:bg-[#5c6113] text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                                ดูข้อมูลพันธุ์ข้าวเพิ่มเติม
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>