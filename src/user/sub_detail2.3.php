   <?php

    $categories = ['ข้าวเปลือก', 'ข้าวสาร', 'ข้าวกล้อง', 'ข้าวกล้องงอก'];

    // table physical (ข้อมูลทางกายภาพ)
    $sql = "SELECT * FROM physical WHERE cropSampleID = :cropSampleID ORDER BY nutritionDBID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cropSampleID' => $sampleinfo_cropSampleID]);
    $rows1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows1) {
        $physicalData = [];
        $fieldsToShow1 = [
            'seedWeight',
            'length',
            'width',
            'thickness',
            'seedShapeRatio',
            'chalkiness',
            'moisture',
            'elongationRatio',
            'peakViscosity',
            'trough',
            'breakdown',
            'finalViscosity',
            'setback',
            'pastingTemp',
            'gelConsistency',
            'swellingPower',
        ];
        foreach ($categories as $cat) {
            $physicalData[$cat] = [];
            // เตรียม key สำหรับแต่ละฟิลด์เป็น array ว่าง
            foreach ($fieldsToShow1 as $field) {
                $physicalData[$cat][$field] = [];
            }
        }

        foreach ($rows1 as $row) {
            $cat = $row['riceCategories'];
            if (in_array($cat, $categories)) {
                foreach ($fieldsToShow1 as $field) {
                    if (isset($row[$field]) && is_numeric($row[$field])) {
                        $physicalData[$cat][$field][] = floatval($row[$field]);
                    }
                }
            }
        }
        echo ' <script>
    const chartData1 = <?= json_encode($physicalData ?? []); ?>;
</script>
';
    } else {
        echo "ไม่พบข้อมูล physical สำหรับ cropSampleID = $sampleinfo_cropSampleID";
    }

    // table physical (ข้อมูลทางกายภาพ)
    $sql = "SELECT * FROM physical WHERE cropSampleID = :cropSampleID ORDER BY nutritionDBID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cropSampleID' => $sampleinfo_cropSampleID]);
    $rows1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows1) {
        $physicalData = [];
        $fieldsToShow1 = [
            'seedWeight',
            'length',
            'width',
            'thickness',
            'seedShapeRatio',
            'chalkiness',
            'moisture',
            'elongationRatio',
            'peakViscosity',
            'trough',
            'breakdown',
            'finalViscosity',
            'setback',
            'pastingTemp',
            'gelConsistency',
            'swellingPower',
        ];
        foreach ($categories as $cat) {
            $physicalData[$cat] = [];
            // เตรียม key สำหรับแต่ละฟิลด์เป็น array ว่าง
            foreach ($fieldsToShow1 as $field) {
                $physicalData[$cat][$field] = [];
            }
        }

        foreach ($rows1 as $row) {
            $cat = $row['riceCategories'];
            if (in_array($cat, $categories)) {
                foreach ($fieldsToShow1 as $field) {
                    if (isset($row[$field]) && is_numeric($row[$field])) {
                        $physicalData[$cat][$field][] = floatval($row[$field]);
                    }
                }
            }
        }

        echo "<script>";
        echo "const chartData1 = " . json_encode($physicalData, JSON_UNESCAPED_UNICODE) . ";";
        echo "</script>";
    } else {
        echo "ไม่พบข้อมูล physical สำหรับ cropSampleID = $sampleinfo_cropSampleID";
    }


    //table nutrition ข้อมูลโภชนาการ
    $sql = "SELECT * FROM nutrition WHERE cropSampleID = :cropSampleID ORDER BY nutritionDBID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cropSampleID' => $sampleinfo_cropSampleID]);
    $rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows2) {
        $nutritionData = [];
        $fieldsToShow2 = [
            'totalEnergy',
            'carbohydrate',
            'starch',
            'dietaryFiber',
            'crudeFiber',
            'totalSugar',
            'protein',
            'totalFat',
            'saturatedFat',
            'unsaturatedFat',
            'saturatedFattyAcid',
            'monosaturatedFattyAcid',
            'polysaturatedFattyAcid',
            'cholesterol',
            'energyFromFat',
            'calcium',
            'iron',
            'magnesium',
            'phosphorus',
            'potassium',
            'sodium',
            'zinc',
            'iodine',
            'copper',
            'maganese',
            'selenium',
            'aluminium',
            'vitaminA',
            'betaCarotene',
            'vitaminC',
            'thiamine',
            'pantothenicAcid',
            'vitaminB1',
            'vitaminB2',
            'riboflavin',
            'vitaminB3',
            'vitaminB4',
            'vitaminB5',
            'vitaminB6',
            'allFolate',
            'folicAcid',
            'foodFolate',
            'DFEFolate',
            'vitaminB12',
            'retinol',
            'vitaminE',
            'vitaminK'
        ];

        foreach ($categories as $cat) {
            $nutritionData[$cat] = [];
            // เตรียม key สำหรับแต่ละฟิลด์เป็น array ว่าง
            foreach ($fieldsToShow2 as $field) {
                $nutritionData[$cat][$field] = [];
            }
        }

        foreach ($rows2 as $row) {
            $cat = $row['riceCategories'];
            if (in_array($cat, $categories)) {
                foreach ($fieldsToShow2 as $field) {
                    if (isset($row[$field]) && is_numeric($row[$field])) {
                        $nutritionData[$cat][$field][] = floatval($row[$field]);
                    }
                }
            }
        }

        echo "<script>";
        echo "const chartData2 = " . json_encode($nutritionData, JSON_UNESCAPED_UNICODE) . ";";
        echo "</script>";
    } else {
        echo "ไม่พบข้อมูล nutrition สำหรับ cropSampleID = $sampleinfo_cropSampleID";
    }




    ?>

   <div id="nutrition" class="tab-content hidden">
       <div class="bg-white p-4 rounded-lg">


           <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
               <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                   <li class="me-2" role="presentation">
                       <button class="inline-block p-4 border-b-2 rounded-t-lg" id="sub_tab1-tab" data-tabs-target="#sub_tab1" type="button" role="tab" aria-controls="sub_tab1" aria-selected="false">ข้อมูลทางกายภาพ</button>
                   </li>
                   <li class="me-2" role="presentation">
                       <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="sub_tab2-tab" data-tabs-target="#sub_tab2" type="button" role="tab" aria-controls="sub_tab2" aria-selected="false">ข้อมูลทางโภชนาการ</button>
                   </li>
                   <li class="me-2" role="presentation">
                       <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="sub_tab3-tab" data-tabs-target="#sub_tab3" type="button" role="tab" aria-controls="sub_tab3" aria-selected="false">คุณสมบัติทางเคมี</button>
                   </li>
                   <li role="presentation">
                       <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="sub_tab4-tab" data-tabs-target="#sub_tab4" type="button" role="tab" aria-controls="sub_tab4" aria-selected="false">ข้อมูลสารออกฤทธิ์ทางชีวภาพ</button>
                   </li>
               </ul>
           </div>
           <div id="default-tab-content">
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-violet-100" id="sub_tab1" role="tabpanel" aria-labelledby="sub_tab1-tab">
                   <div id="chartContainer1" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto">
                       <p id="noDataMsg1" class="text-red-600 font-bold col-span-full hidden">ไม่พบข้อมูล</p>
                   </div>




               </div>
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-lime-100" id="sub_tab2" role="tabpanel" aria-labelledby="sub_tab2-tab">
                   <div id="noDataMsg2" style="display:none;" class="text-red-600 mb-4">ไม่มีข้อมูลโภชนาการสำหรับแสดง</div>
                   <div id="chartContainer2" class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3"></div>
               </div>
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-red-100" id="sub_tab3" role="tabpanel" aria-labelledby="sub_tab3-tab">
                   <p class="text-sm text-gray-500 dark:text-gray-400">รอดำเนินการ 13 มิถุนายน 2568</p>
               </div>
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-green-100" id="sub_tab4" role="tabpanel" aria-labelledby="sub_tab4-tab">
                   <p class="text-sm text-gray-500 dark:text-gray-400">รอดำเนินการ 13 มิถุนายน 2568</p>
               </div>
           </div>

       </div>
   </div>

   <script>
       // สมมติ chartData1 ถูกส่งมาจาก PHP มาแล้ว

       const fieldsToShow1 = [
           "seedWeight",
           "length",
           "width",
           "thickness",
           "seedShapeRatio",
           "chalkiness",
           "moisture",
           "elongationRatio",
           "peakViscosity",
           "trough",
           "breakdown",
           "finalViscosity",
           "setback",
           "pastingTemp",
           "gelConsistency",
           "swellingPower",
       ];

       const fieldNamesTH = {
           seedWeight: "น้ำหนักเมล็ด",
           length: "ความยาว",
           width: "ความกว้าง",
           thickness: "ความหนา",
           seedShapeRatio: "รูปร่างเมล็ด",
           chalkiness: "ข้าวท้องไข่",
           moisture: "ปริมาณความชื้น",
           elongationRatio: "การยืดตัวของข้าวสุก",
           peakViscosity: "ความหนืดสูงสุด",
           trough: "ความหนืดต่ำสุด",
           breakdown: "ความหนืดเปลี่ยนแปลงไปสู่ขั้นสลายตัว",
           finalViscosity: "ความหนืดสุดท้าย",
           setback: "การคืนตัวของแป้ง",
           pastingTemp: "อุณหภูมิที่เริ่มมีการเปลี่ยนแปลงความหนืด",
           gelConsistency: "ความคงตัวแป้งสุกปานกลาง",
           swellingPower: "ค่าการวิเคราะห์กำลังการพองตัว",
       };
       const fieldUnits = {
           seedWeight: "g/1,000 seeds",
           length: "mm",
           width: "mm",
           thickness: "mm",
           seedShapeRatio: "ยาว/กว้าง",
           chalkiness: "%",
           moisture: "%",
           elongationRatio: "",
           peakViscosity: "",
           trough: "",
           breakdown: "",
           finalViscosity: "",
           setback: "",
           pastingTemp: "°C",
           gelConsistency: "mm",
           swellingPower: "%",
       };
       const categoryColors = {
           "ข้าวกล้อง": "#4c78a8",
           "ข้าวกล้องงอก": "#f58518",
           "ข้าวสาร": "#e45756",
           "ข้าวเปลือก": "#8B4513"
       };

       function hasValidData1(data) {
           for (const cat in data) {
               for (const field in data[cat]) {
                   if (data[cat][field].length > 0) {
                       return true;
                   }
               }
           }
           return false;
       }

       const chartContainer1 = document.getElementById('chartContainer1');
       const noDataMsg1 = document.getElementById('noDataMsg1');

       if (!hasValidData1(chartData1)) {
           noDataMsg1.style.display = 'block';
       } else {
           noDataMsg1.style.display = 'none';

           // หาฟิลด์ที่มีข้อมูลจริง
           let fieldsWithData1 = new Set();
           for (const cat in chartData1) {
               for (const field in chartData1[cat]) {
                   if (fieldsToShow1.includes(field) && chartData1[cat][field].length > 0) {
                       fieldsWithData1.add(field);
                   }
               }
           }
           fieldsWithData1 = Array.from(fieldsWithData1);


           // หมวดหมู่ที่มีข้อมูลอย่างน้อย 1 ฟิลด์ใน fieldsToShow1
           const categories = Object.keys(chartData1).filter(cat => {
               return fieldsToShow1.some(field => {
                   const values = chartData1[cat][field];
                   return values && values.length > 0;
               });
           });
           // สร้างกราฟแยก 1 ฟิลด์ 1 กราฟ
           fieldsWithData1.forEach(field => {
               // ✅ กรองเฉพาะหมวดที่ field นี้มีข้อมูล
               const filteredCategories1 = categories.filter(cat => {
                   const values = chartData1[cat][field] || [];
                   return values.length > 0;
               });

               // ✅ ข้าม field นี้ถ้าไม่มีหมวดไหนมีข้อมูลเลย
               if (filteredCategories1.length === 0) return;

               // ✅ คำนวณค่าเฉลี่ยเฉพาะหมวดที่มีข้อมูล
               const data = filteredCategories1.map(cat => {
                   const values = chartData1[cat][field];
                   return values.reduce((a, b) => a + b, 0) / values.length;
               });

               // ✅ ข้ามถ้าค่าเฉลี่ยทั้งหมดเป็น 0 (ไม่จำเป็นเสมอ แต่กันไว้)
               if (data.every(val => val === 0)) return;

               // ✅ สร้างกราฟ
               const cardWrapper1 = document.createElement('div');
               cardWrapper1.className = 'bg-white rounded-xl shadow p-4';

               const canvas = document.createElement('canvas');
               canvas.id = `chart_${field}`;
               canvas.style.width = '100%'; // ให้กว้างเต็ม container
               canvas.style.height = '300px'; // กำหนดความสูงแบบตรงๆ ด้วย style

               cardWrapper1.appendChild(canvas);
               chartContainer1.appendChild(cardWrapper1);

               const ctx = canvas.getContext('2d');

               new Chart(ctx, {
                   type: 'bar',
                   data: {
                       labels: filteredCategories1,
                       datasets: [{
                           label: `${field}${fieldUnits[field] ? ' (' + fieldUnits[field] + ')' : ''}`,
                           data: data,
                           backgroundColor: filteredCategories1.map(cat => categoryColors[cat] || '#999'),

                       }]
                   },
                   options: {
                       responsive: true,
                       indexAxis: 'x',
                       scales: {
                           y: {
                               beginAtZero: true,
                               title: {
                                   display: true,
                                   font: {
                                       family: 'Noto Sans Thai'
                                   }
                               },
                               ticks: {
                                   font: {
                                       family: 'Noto Sans Thai'
                                   },
                                   color: '#000'
                               },
                               grid: {
                                   display: false // ❌ ลบเส้นแนวนอน
                               }
                           },
                           x: {
                               title: {
                                   display: true,
                                   font: {
                                       family: 'Noto Sans Thai'
                                   }
                               },
                               ticks: {
                                   font: {
                                       family: 'Noto Sans Thai'
                                   },
                                   color: '#000'
                               },
                               grid: {
                                   display: false // ❌ ลบเส้นแนวนอน
                               }
                           }
                       },
                       plugins: {
                           legend: {
                               display: false,
                               labels: {
                                   font: {
                                       family: 'Noto Sans Thai'
                                   }
                               }
                           },
                           title: {
                               display: true,
                               text: `${fieldNamesTH[field] || field}${fieldUnits[field] ? ' (' + fieldUnits[field] + ')' : ''}`,
                               font: {
                                   family: 'Noto Sans Thai'
                               },
                               color: '#000' // ✅ ทำหัวกราฟให้เป็นสีดำเข้ม
                           },
                           tooltip: {
                               callbacks: {
                                   label: function(context) {
                                       return `${context.parsed.y.toFixed(2)} ${fieldUnits[field] || ''}`;
                                   }
                               },
                               titleFont: {
                                   family: 'Noto Sans Thai'
                               },
                               bodyFont: {
                                   family: 'Noto Sans Thai'
                               }
                           }
                       }
                   }
               });
           });
       }



       // chartData2 โภชนาการ

       $fieldsToShow2 = [
           'totalEnergy',
           'carbohydrate',
           'starch',
           'dietaryFiber',
           'crudeFiber',
           'totalSugar',
           'protein',
           'totalFat',
           'saturatedFat',
           'unsaturatedFat',
           'saturatedFattyAcid',
           'monosaturatedFattyAcid',
           'polysaturatedFattyAcid',
           'cholesterol',
           'energyFromFat',
           'calcium',
           'iron',
           'magnesium',
           'phosphorus',
           'potassium',
           'sodium',
           'zinc',
           'iodine',
           'copper',
           'maganese',
           'selenium',
           'aluminium',
           'vitaminA',
           'betaCarotene',
           'vitaminC',
           'thiamine',
           'pantothenicAcid',
           'vitaminB1',
           'vitaminB2',
           'riboflavin',
           'vitaminB3',
           'vitaminB4',
           'vitaminB5',
           'vitaminB6',
           'allFolate',
           'folicAcid',
           'foodFolate',
           'DFEFolate',
           'vitaminB12',
           'retinol',
           'vitaminE',
           'vitaminK'
       ];

       function hasValidData2(data) {
           for (const cat in data) {
               for (const field in data[cat]) {
                   if (data[cat][field].length > 0) {
                       return true;
                   }
               }
           }
           return false;
       }

       const chartContainer2 = document.getElementById('chartContainer2');
       const noDataMsg2 = document.getElementById('noDataMsg2');

       if (!hasValidData2(chartData2)) {
           noDataMsg2.style.display = 'block';
       } else {
           noDataMsg2.style.display = 'none';

           // หาฟิลด์ที่มีข้อมูลจริง
           let fieldsWithData2 = new Set();
           for (const cat in chartData2) {
               for (const field in chartData2[cat]) {
                   if (fieldsToShow2.includes(field) && chartData2[cat][field].length > 0) {
                       fieldsWithData2.add(field);
                   }
               }
           }
           fieldsWithData2 = Array.from(fieldsWithData2);


           // หมวดหมู่ที่มีข้อมูลอย่างน้อย 1 ฟิลด์ใน fieldsToShow2
           const categories = Object.keys(chartData2).filter(cat => {
               return fieldsToShow2.some(field => {
                   const values = chartData2[cat][field];
                   return values && values.length > 0;
               });
           });
           // สร้างกราฟแยก 1 ฟิลด์ 1 กราฟ
           fieldsWithData2.forEach(field => {
               // ✅ กรองเฉพาะหมวดที่ field นี้มีข้อมูล
               const filteredCategories2 = categories.filter(cat => {
                   const values = chartData2[cat][field] || [];
                   return values.length > 0;
               });

               // ✅ ข้าม field นี้ถ้าไม่มีหมวดไหนมีข้อมูลเลย
               if (filteredCategories2.length === 0) return;

               // ✅ คำนวณค่าเฉลี่ยเฉพาะหมวดที่มีข้อมูล
               const data = filteredCategories2.map(cat => {
                   const values = chartData2[cat][field];
                   return values.reduce((a, b) => a + b, 0) / values.length;
               });

               // ✅ ข้ามถ้าค่าเฉลี่ยทั้งหมดเป็น 0 (ไม่จำเป็นเสมอ แต่กันไว้)
               if (data.every(val => val === 0)) return;

               // ✅ สร้างกราฟ
               const cardWrapper2 = document.createElement('div');
               cardWrapper2.className = 'bg-white rounded-xl shadow p-4';

               const canvas = document.createElement('canvas');
               canvas.id = `chart_${field}`;
               canvas.style.width = '100%'; // ให้กว้างเต็ม container
               canvas.style.height = '300px'; // กำหนดความสูงแบบตรงๆ ด้วย style

               cardWrapper2.appendChild(canvas);
               chartContainer2.appendChild(cardWrapper2);

               const ctx = canvas.getContext('2d');

               new Chart(ctx, {
                   type: 'bar',
                   data: {
                       labels: filteredCategories2,
                       datasets: [{
                           label: `${field}${fieldUnits[field] ? ' (' + fieldUnits[field] + ')' : ''}`,
                           data: data,
                           backgroundColor: filteredCategories2.map(cat => categoryColors[cat] || '#999'),

                       }]
                   },
                   options: {
                       responsive: true,
                       indexAxis: 'x',
                       scales: {
                           y: {
                               beginAtZero: true,
                               title: {
                                   display: true,
                                   font: {
                                       family: 'Noto Sans Thai'
                                   }
                               },
                               ticks: {
                                   font: {
                                       family: 'Noto Sans Thai'
                                   },
                                   color: '#000'
                               },
                               grid: {
                                   display: false // ❌ ลบเส้นแนวนอน
                               }
                           },
                           x: {
                               title: {
                                   display: true,
                                   font: {
                                       family: 'Noto Sans Thai'
                                   }
                               },
                               ticks: {
                                   font: {
                                       family: 'Noto Sans Thai'
                                   },
                                   color: '#000'
                               },
                               grid: {
                                   display: false // ❌ ลบเส้นแนวนอน
                               }
                           }
                       },
                       plugins: {
                           legend: {
                               display: false,
                               labels: {
                                   font: {
                                       family: 'Noto Sans Thai'
                                   }
                               }
                           },
                           title: {
                               display: true,
                               text: `${fieldNamesTH[field] || field}${fieldUnits[field] ? ' (' + fieldUnits[field] + ')' : ''}`,
                               font: {
                                   family: 'Noto Sans Thai'
                               },
                               color: '#000' // ✅ ทำหัวกราฟให้เป็นสีดำเข้ม
                           },
                           tooltip: {
                               callbacks: {
                                   label: function(context) {
                                       return `${context.parsed.y.toFixed(2)} ${fieldUnits[field] || ''}`;
                                   }
                               },
                               titleFont: {
                                   family: 'Noto Sans Thai'
                               },
                               bodyFont: {
                                   family: 'Noto Sans Thai'
                               }
                           }
                       }
                   }
               });
           });
       }
   </script>