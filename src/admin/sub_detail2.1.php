                            <div id="method" class="tab-content">
                                <div class="bg-white p-4 rounded-lg mb-4">
                                    <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">อุปกรณ์</h4>
                                    <div style='border:0px solid #ccc; padding:10px;'>
                                        <?php
                                        if (is_null($ingredients_and_equipment) || $ingredients_and_equipment === '') {
                                            echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                                        } else {
                                            echo '<div class="ck-content">';
                                            echo $ingredients_and_equipment;
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="bg-white p-4 rounded-lg">
                                    <h4 class="inline-block font-bold mb-2 bg-white px-4 py-2 rounded-full text-sm w-fit px-4 py-1 mx-auto shadow">วิธีทำ</h4>
                                    <div style='border:0px solid #ccc; padding:10px;'>
                                        <?php
                                        if (is_null($instructions) || trim($instructions) === '') {
                                            echo "<div class='bg-yellow-100 text-yellow-800 p-3 rounded-md text-center'>เจ้าหน้าที่กำลังนำเข้าข้อมูลค่ะ</div>";
                                        } else {
                                            echo '<div class="ck-content">';
                                            echo $instructions;
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>