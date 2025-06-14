   <?php

    $categories = ['ข้าวเปลือก', 'ข้าวสาร', 'ข้าวกล้อง', 'ข้าวกล้องงอก'];

    // 1.table physical (ข้อมูลทางกายภาพ)
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
        // echo "ไม่พบข้อมูล physical สำหรับ cropSampleID = $sampleinfo_cropSampleID";
    }


    // 2.table nutrition (ข้อมูลโภชนาการ)
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
        // echo "ไม่พบข้อมูล nutrition สำหรับ cropSampleID = $sampleinfo_cropSampleID";
    }

    // 3.table chemical (ข้อมูลคุณสมบัติทางเคมี)
    $sql = "SELECT * FROM chemical WHERE cropSampleID = :cropSampleID ORDER BY nutritionDBID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cropSampleID' => $sampleinfo_cropSampleID]);
    $rows3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows3) {
        $chemicalData = [];
        $fieldsToShow3 = [
            'amylose',
            'solubleAmyloseContent',
            'amylopectin',
            'alkaliSpreading',
            'water_moisture',
            'aromaBySensory',
            'content2AP',
            'RAG',
            'SAG',
            'TG',
            'ash'
        ];


        foreach ($categories as $cat) {
            $chemicalData[$cat] = [];
            // เตรียม key สำหรับแต่ละฟิลด์เป็น array ว่าง
            foreach ($fieldsToShow3 as $field) {
                $chemicalData[$cat][$field] = [];
            }
        }

        foreach ($rows3 as $row) {
            $cat = $row['riceCategories'];
            if (in_array($cat, $categories)) {
                foreach ($fieldsToShow3 as $field) {
                    if (isset($row[$field]) && is_numeric($row[$field])) {
                        $chemicalData[$cat][$field][] = floatval($row[$field]);
                    }
                }
            }
        }

        echo "<script>";
        echo "const chartData3 = " . json_encode($chemicalData, JSON_UNESCAPED_UNICODE) . ";";
        echo "</script>";
    } else {
        // echo "ไม่พบข้อมูล chemical สำหรับ cropSampleID = $sampleinfo_cropSampleID";
    }

    // 4. table bioactive ออกฤทธิ์ทางชีวภาพ
    $sql = "SELECT * FROM bioactive WHERE cropSampleID = :cropSampleID ORDER BY nutritionDBID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cropSampleID' => $sampleinfo_cropSampleID]);
    $rows4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows4) {
        $bioactiveData = [];
        $fieldsToShow4 = [
            'ferulicAcid',
            'totalTocopherol',
            'tocopherolAlpha',
            'tocopherolBeta',
            'tocopherolGamma',
            'tocopherolDelta',
            'tocotrienolAlpha',
            'tocotrienolBeta',
            'tocotrienolGamma',
            'tocotrienolDelta',
            'prolamine',
            'albumin',
            'globulin',
            'glutenin',
            'omega3',
            'omega6',
            'omega9',
            'tryptophan',
            'threonine',
            'isoleucine',
            'leucine',
            'lysine',
            'methionine',
            'custeine',
            'phenylalanine',
            'tyrosine',
            'valine',
            'arginine',
            'histidine',
            'alanine',
            'asparticAcid',
            'glutamicAcid',
            'glycine',
            'proline',
            'serine',
            'cerine',
            'caffeine',
            'theobromine',
            'betaCarotene',
            'alphaCarotene',
            'betaCryptoxanthin',
            'lycopene',
            'luteinZeaxanthin',
            'biotin',
            'gammaOryzanol',
            'phenolicCompounds',
            'totalAntioxidant',
            'gallicAcid',
            'eriodictyol',
            'anthocyanin',
            'apigenin',
            'isoquercetin',
            'hydroquinin',
            'quercetin',
            'Kaempferol',
            'rutin',
            'catechin',
            'tannicAcid',
            'totalFlavonoid',
            'GABA',
            'genistein',
            'daidzein',
            'genistin',
            'daidzin',
            'quercitin3BDglucoside',
            'peonidin3Oglucoside',
            'oenin',
            'anthocyanin3glucoside',
            'callistephin',
            'keracyanin',
            'kuromanin',
            'malvidin3galactoside'
        ];


        foreach ($categories as $cat) {
            $bioactiveData[$cat] = [];
            // เตรียม key สำหรับแต่ละฟิลด์เป็น array ว่าง
            foreach ($fieldsToShow4 as $field) {
                $bioactiveData[$cat][$field] = [];
            }
        }

        foreach ($rows4 as $row) {
            $cat = $row['riceCategories'];
            if (in_array($cat, $categories)) {
                foreach ($fieldsToShow4 as $field) {
                    if (isset($row[$field]) && is_numeric($row[$field])) {
                        $bioactiveData[$cat][$field][] = floatval($row[$field]);
                    }
                }
            }
        }

        echo "<script>";
        echo "const chartData4 = " . json_encode($bioactiveData, JSON_UNESCAPED_UNICODE) . ";";
        echo "</script>";
    } else {
        // echo "ไม่พบข้อมูล bioactive สำหรับ cropSampleID = $sampleinfo_cropSampleID";
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
                       <p id="noDataMsg1" class="text-red-600 font-bold col-span-full hidden">ไม่มีข้อมูลข้อมูลทางกายภาพสำหรับแสดง</p>
                   </div>




               </div>
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-lime-100" id="sub_tab2" role="tabpanel" aria-labelledby="sub_tab2-tab">
                   <div id="chartContainer2" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto">
                       <p id="noDataMsg2" class="text-red-600 font-bold col-span-full hidden">ไม่มีข้อมูลโภชนาการสำหรับแสดง</p>
                   </div>
               </div>
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-red-100" id="sub_tab3" role="tabpanel" aria-labelledby="sub_tab3-tab">
                   <div id="chartContainer3" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto">
                       <p id="noDataMsg3" class="text-red-600 font-bold col-span-full hidden">ไม่มีข้อมูลคุณสมบัติทางเคมีสำหรับแสดง</p>
                   </div>
               </div>
               <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-green-100" id="sub_tab4" role="tabpanel" aria-labelledby="sub_tab4-tab">
                   <div id="chartContainer4" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto">
                       <p id="noDataMsg4" class="text-red-600 font-bold col-span-full hidden">ไม่มีข้อมูลสารออกฤทธิ์ทางชีวภาพสำหรับแสดง</p>
                   </div>
               </div>
           </div>

       </div>
   </div>

   <script>
       // chartData1 ถูกส่งมาจาก PHP มาแล้ว

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

       const fieldNamesTH1 = {
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
       const fieldUnits1 = {
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
               canvas.id = `chart1_${field}`;
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
                           label: `${field}${fieldUnits1[field] ? ' (' + fieldUnits1[field] + ')' : ''}`,
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
                               text: `${fieldNamesTH1[field] || field}${fieldUnits1[field] ? ' (' + fieldUnits1[field] + ')' : ''}`,
                               font: {
                                   family: 'Noto Sans Thai'
                               },
                               color: '#000' // ✅ ทำหัวกราฟให้เป็นสีดำเข้ม
                           },
                           tooltip: {
                               callbacks: {
                                   label: function(context) {
                                       return `${context.parsed.y.toFixed(2)} ${fieldUnits1[field] || ''}`;
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



       // chartData2 ถูกส่งมาจาก PHP มาแล้ว
       const fieldsToShow2 = [
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

       const fieldNamesTH2 = {
           totalEnergy: "พลังงานรวม",
           carbohydrate: "คาร์โบไฮเดรต",
           starch: "แป้ง",
           dietaryFiber: "ใยอาหารทั้งหมด",
           crudeFiber: "ใยอาหารหยาบ",
           totalSugar: "น้ำตาลทั้งหมด",
           protein: "โปรตีน",
           totalFat: "ไขมันทั้งหมด",
           saturatedFat: "ไขมันอิ่มตัว",
           unsaturatedFat: "ไขมันไม่อิ่มตัว",
           saturatedFattyAcid: "กรดไขมันอิ่มตัว",
           monosaturatedFattyAcid: "กรดไขมันไม่อิ่มตัวตำแหน่งเดียว",
           polysaturatedFattyAcid: "กรดไขมันไม่อิ่มตัวหลายตำแหน่ง",
           cholesterol: "คอเลสเตอรอล",
           energyFromFat: "พลังงานจากไขมัน",
           calcium: "แคลเซียม",
           iron: "เหล็ก",
           magnesium: "แมกนีเซียม",
           phosphorus: "ฟอสฟอรัส",
           potassium: "โพแทสเซียม",
           sodium: "โซเดียม",
           zinc: "สังกะสี",
           iodine: "ไอโอดีน",
           copper: "ทองแดง",
           maganese: "แมงกานีส",
           selenium: "ซีลีเนียม",
           aluminium: "อะลูมิเนียม",
           vitaminA: "วิตามินเอ",
           betaCarotene: "เบต้าแคโรทีน",
           vitaminC: "วิตามินซี",
           thiamine: "ไทอามีน (วิตามินบี1)",
           pantothenicAcid: "กรดแพนโทเธนิก",
           vitaminB1: "วิตามินบี1",
           vitaminB2: "วิตามินบี2",
           riboflavin: "ไรโบฟลาวิน",
           vitaminB3: "วิตามินบี3",
           vitaminB4: "วิตามินบี4",
           vitaminB5: "วิตามินบี5",
           vitaminB6: "วิตามินบี6",
           allFolate: "โฟเลตทั้งหมด",
           folicAcid: "กรดโฟลิก",
           foodFolate: "โฟเลตจากอาหาร",
           DFEFolate: "โฟเลตเทียบเท่า DFE",
           vitaminB12: "วิตามินบี12",
           retinol: "เรตินอล",
           vitaminE: "วิตามินอี",
           vitaminK: "วิตามินเค"
       };

       const fieldUnits2 = {
           totalEnergy: "kcal",
           carbohydrate: "g",
           starch: "g",
           dietaryFiber: "g",
           crudeFiber: "g",
           totalSugar: "g",
           protein: "g",
           totalFat: "g",
           saturatedFat: "g",
           unsaturatedFat: "g",
           saturatedFattyAcid: "g",
           monosaturatedFattyAcid: "g",
           polysaturatedFattyAcid: "g",
           cholesterol: "mg",
           energyFromFat: "kcal",
           calcium: "mg",
           iron: "mg",
           magnesium: "mg",
           phosphorus: "mg",
           potassium: "mg",
           sodium: "mg",
           zinc: "mg",
           iodine: "µg",
           copper: "mg",
           maganese: "mg",
           selenium: "µg",
           aluminium: "mg",
           vitaminA: "µg RAE",
           betaCarotene: "µg",
           vitaminC: "mg",
           thiamine: "mg",
           pantothenicAcid: "mg",
           vitaminB1: "mg",
           vitaminB2: "mg",
           riboflavin: "mg",
           vitaminB3: "mg",
           vitaminB4: "mg",
           vitaminB5: "mg",
           vitaminB6: "mg",
           allFolate: "µg",
           folicAcid: "µg",
           foodFolate: "µg",
           DFEFolate: "µg DFE",
           vitaminB12: "µg",
           retinol: "µg",
           vitaminE: "mg α-TE",
           vitaminK: "µg"
       };


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
               canvas.id = `chart2_${field}`;
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
                           label: `${field}${fieldUnits2[field] ? ' (' + fieldUnits2[field] + ')' : ''}`,
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
                               text: `${fieldNamesTH2[field] || field}${fieldUnits2[field] ? ' (' + fieldUnits2[field] + ')' : ''}`,
                               font: {
                                   family: 'Noto Sans Thai'
                               },
                               color: '#000' // ✅ ทำหัวกราฟให้เป็นสีดำเข้ม
                           },
                           tooltip: {
                               callbacks: {
                                   label: function(context) {
                                       return `${context.parsed.y.toFixed(2)} ${fieldUnits2[field] || ''}`;
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


       // chartData3 ถูกส่งมาจาก PHP มาแล้ว
       const fieldsToShow3 = [
           'amylose',
           'solubleAmyloseContent',
           'amylopectin',
           'alkaliSpreading',
           'water_moisture',
           'aromaBySensory',
           'content2AP',
           'RAG',
           'SAG',
           'TG',
           'ash'
       ];

       const fieldNamesTH3 = {
           amylose: "อไมโลส",
           solubleAmyloseContent: "อไมโลสที่ละลายน้ำ",
           amylopectin: "อะไมโลเพกติน",
           alkaliSpreading: "การสลายแป้งในด่าง",
           water_moisture: "ปริมาณน้ำ/ความชื้น",
           aromaBySensory: "กลิ่นหอม (การประเมินทางประสาทสัมผัส)",
           content2AP: "ปริมาณ 2-AP",
           RAG: "RAG",
           SAG: "SAG",
           TG: "TG",
           ash: "เถ้า"
       };

       const fieldUnits3 = {
           amylose: "%",
           solubleAmyloseContent: "%",
           amylopectin: "", // หน่วยไม่ระบุชัด อาจเป็น % ถ้ามีข้อมูลเพิ่มเติมแจ้งได้
           alkaliSpreading: "", // ค่าคะแนน ไม่มีหน่วย
           water_moisture: "g/100g",
           aromaBySensory: "", // ค่าคะแนนประเมิน ไม่มีหน่วย
           content2AP: "µg/kg", // หน่วยมาตรฐานของ 2-AP
           RAG: "g/100g",
           SAG: "g/100g",
           TG: "g/100g",
           ash: "g/100g"
       };

       function hasValidData3(data) {
           for (const cat in data) {
               for (const field in data[cat]) {
                   if (data[cat][field].length > 0) {
                       return true;
                   }
               }
           }
           return false;
       }

       const chartContainer3 = document.getElementById('chartContainer3');
       const noDataMsg3 = document.getElementById('noDataMsg3');

       if (!hasValidData3(chartData3)) {
           noDataMsg3.style.display = 'block';
       } else {
           noDataMsg3.style.display = 'none';

           // หาฟิลด์ที่มีข้อมูลจริง
           let fieldsWithData3 = new Set();
           for (const cat in chartData3) {
               for (const field in chartData3[cat]) {
                   if (fieldsToShow3.includes(field) && chartData3[cat][field].length > 0) {
                       fieldsWithData3.add(field);
                   }
               }
           }
           fieldsWithData3 = Array.from(fieldsWithData3);


           // หมวดหมู่ที่มีข้อมูลอย่างน้อย 1 ฟิลด์ใน fieldsToShow3
           const categories = Object.keys(chartData3).filter(cat => {
               return fieldsToShow3.some(field => {
                   const values = chartData3[cat][field];
                   return values && values.length > 0;
               });
           });
           // สร้างกราฟแยก 1 ฟิลด์ 1 กราฟ
           fieldsWithData3.forEach(field => {
               // ✅ กรองเฉพาะหมวดที่ field นี้มีข้อมูล
               const filteredCategories3 = categories.filter(cat => {
                   const values = chartData3[cat][field] || [];
                   return values.length > 0;
               });

               // ✅ ข้าม field นี้ถ้าไม่มีหมวดไหนมีข้อมูลเลย
               if (filteredCategories3.length === 0) return;

               // ✅ คำนวณค่าเฉลี่ยเฉพาะหมวดที่มีข้อมูล
               const data = filteredCategories3.map(cat => {
                   const values = chartData3[cat][field];
                   return values.reduce((a, b) => a + b, 0) / values.length;
               });

               // ✅ ข้ามถ้าค่าเฉลี่ยทั้งหมดเป็น 0 (ไม่จำเป็นเสมอ แต่กันไว้)
               if (data.every(val => val === 0)) return;

               // ✅ สร้างกราฟ
               const cardWrapper3 = document.createElement('div');
               cardWrapper3.className = 'bg-white rounded-xl shadow p-4';

               const canvas = document.createElement('canvas');
               canvas.id = `chart3_${field}`;
               canvas.style.width = '100%'; // ให้กว้างเต็ม container
               canvas.style.height = '300px'; // กำหนดความสูงแบบตรงๆ ด้วย style

               cardWrapper3.appendChild(canvas);
               chartContainer3.appendChild(cardWrapper3);

               const ctx = canvas.getContext('2d');

               new Chart(ctx, {
                   type: 'bar',
                   data: {
                       labels: filteredCategories3,
                       datasets: [{
                           label: `${field}${fieldUnits3[field] ? ' (' + fieldUnits3[field] + ')' : ''}`,
                           data: data,
                           backgroundColor: filteredCategories3.map(cat => categoryColors[cat] || '#999'),

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
                               text: `${fieldNamesTH3[field] || field}${fieldUnits3[field] ? ' (' + fieldUnits3[field] + ')' : ''}`,
                               font: {
                                   family: 'Noto Sans Thai'
                               },
                               color: '#000' // ✅ ทำหัวกราฟให้เป็นสีดำเข้ม
                           },
                           tooltip: {
                               callbacks: {
                                   label: function(context) {
                                       return `${context.parsed.y.toFixed(2)} ${fieldUnits3[field] || ''}`;
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


       // chartData4 ถูกส่งมาจาก PHP มาแล้ว 
       const fieldsToShow4 = [
           'ferulicAcid',
           'totalTocopherol',
           'tocopherolAlpha',
           'tocopherolBeta',
           'tocopherolGamma',
           'tocopherolDelta',
           'tocotrienolAlpha',
           'tocotrienolBeta',
           'tocotrienolGamma',
           'tocotrienolDelta',
           'prolamine',
           'albumin',
           'globulin',
           'glutenin',
           'omega3',
           'omega6',
           'omega9',
           'tryptophan',
           'threonine',
           'isoleucine',
           'leucine',
           'lysine',
           'methionine',
           'custeine',
           'phenylalanine',
           'tyrosine',
           'valine',
           'arginine',
           'histidine',
           'alanine',
           'asparticAcid',
           'glutamicAcid',
           'glycine',
           'proline',
           'serine',
           'cerine',
           'caffeine',
           'theobromine',
           'betaCarotene',
           'alphaCarotene',
           'betaCryptoxanthin',
           'lycopene',
           'luteinZeaxanthin',
           'biotin',
           'gammaOryzanol',
           'phenolicCompounds',
           'totalAntioxidant',
           'gallicAcid',
           'eriodictyol',
           'anthocyanin',
           'apigenin',
           'isoquercetin',
           'hydroquinin',
           'quercetin',
           'Kaempferol',
           'rutin',
           'catechin',
           'tannicAcid',
           'totalFlavonoid',
           'GABA',
           'genistein',
           'daidzein',
           'genistin',
           'daidzin',
           'quercitin3BDglucoside',
           'peonidin3Oglucoside',
           'oenin',
           'anthocyanin3glucoside',
           'callistephin',
           'keracyanin',
           'kuromanin',
           'malvidin3galactoside'
       ];

       const fieldNamesTH4 = {
           ferulicAcid: "กรดเฟอรูลิก",
           totalTocopherol: "โทโคฟีรอลรวม",
           tocopherolAlpha: "โทโคฟีรอล, แอลฟา",
           tocopherolBeta: "โทโคฟีรอล, เบต้า",
           tocopherolGamma: "โทโคฟีรอล, แกรมม่า",
           tocopherolDelta: "โทโคฟีรอล, เดลต้า",
           tocotrienolAlpha: "โทโคไตรอีนอล, แอลฟา",
           tocotrienolBeta: "โทโคไตรอีนอล, เบต้า",
           tocotrienolGamma: "โทโคไตรอีนอล, แกมม่า",
           tocotrienolDelta: "โทโคไตรอีนอล, เดลต้า",
           prolamine: "โพรลามีน",
           albumin: "อัลบูมิน",
           globulin: "โกลบูลิน",
           glutenin: "กลูเตนิน",
           omega3: "โอเมก้า 3",
           omega6: "โอเมก้า 6",
           omega9: "โอเมก้า 9",
           tryptophan: "ทริปโทเฟน",
           threonine: "ทรีโอนีน",
           isoleucine: "ไอโซลิวซีน",
           leucine: "ลิวซีน",
           lysine: "ไลซีน",
           methionine: "เมไทโอนีน",
           custeine: "ซีสทีน",
           phenylalanine: "เฟนีลอะลานีน",
           tyrosine: "ไทโรซีน",
           valine: "วาลีน",
           arginine: "อาร์จินีน",
           histidine: "ฮีสทิดีน",
           alanine: "อะลานีน",
           asparticAcid: "กรดแอสพาร์ติก",
           glutamicAcid: "กรดกลูแทมิก",
           glycine: "ไกลซีน",
           proline: "โพรลีน",
           serine: "ซีรีน",
           cerine: "เซอลีน",
           caffeine: "คาเฟอีน",
           theobromine: "ธีโอโบรมีน",
           betaCarotene: "เบต้าแคโรทีน",
           alphaCarotene: "อัลฟาแคโรทีน",
           betaCryptoxanthin: "เบตาคริปโตแซนธิน",
           lycopene: "ไลโคปีน",
           luteinZeaxanthin: "ลูทีนและซีแซนทีน",
           biotin: "ไบโอติน",
           gammaOryzanol: "แกมมาโอโรซานอล",
           phenolicCompounds: "สารประกอบฟีนอลทั้งหมด",
           totalAntioxidant: "สารต้านอนุมูลอิสระทั้งหมด",
           gallicAcid: "แกลลิก",
           eriodictyol: "อีริโอดิคทิออล",
           anthocyanin: "แอนโทไซยานิน",
           apigenin: "อพิจินิน",
           isoquercetin: "ไอโซเควอซิทิน",
           hydroquinin: "ไฮโดรควิโนน",
           quercetin: "เควอซิทิน",
           Kaempferol: "แคมพ์เฟอรอล",
           rutin: "รูติน",
           catechin: "แคทีซิน",
           tannicAcid: "กรดแทนนิก",
           totalFlavonoid: "ฟลาโวนอยด์รวม",
           GABA: "กาบา",
           genistein: "เจนิสทีน",
           daidzein: "ไดด์เซอีน",
           genistin: "เจนิสติน",
           daidzin: "ไดด์ซิน",
           quercitin3BDglucoside: "เควอซิทิน-3-β-D-กลูโคไซด์",
           peonidin3Oglucoside: "พีโอนิดิน-3-O-กลูโคไซด์",
           oenin: "โอนิน",
           anthocyanin3glucoside: "แอนโทไซยานิน-3-กลูโคไซด์",
           callistephin: "แคลลิสเทฟิน",
           keracyanin: "เคราซัยยานิน",
           kuromanin: "คุโรมานิน",
           malvidin3galactoside: "มัลวิดิน-3-กาแลกโตไซด์"
       };

       const fieldUnits4 = {
           ferulicAcid: "mg/kg",
           totalTocopherol: "mg/100g",
           tocopherolAlpha: "mg/100g",
           tocopherolBeta: "mg/100g",
           tocopherolGamma: "mg/100g",
           tocopherolDelta: "mg/100g",
           tocotrienolAlpha: "mg/100g",
           tocotrienolBeta: "mg/100g",
           tocotrienolGamma: "mg/100g",
           tocotrienolDelta: "mg/100g",
           prolamine: "%",
           albumin: "%",
           globulin: "%",
           glutenin: "%",
           omega3: "mg/100g",
           omega6: "mg/100g",
           omega9: "mg/100g",
           tryptophan: "mg/100g",
           threonine: "mg/100g",
           isoleucine: "mg/100g",
           leucine: "mg/100g",
           lysine: "mg/100g",
           methionine: "mg/100g",
           custeine: "mg/100g",
           phenylalanine: "mg/100g",
           tyrosine: "mg/100g",
           valine: "mg/100g",
           arginine: "mg/100g",
           histidine: "mg/100g",
           alanine: "mg/100g",
           asparticAcid: "mg/100g",
           glutamicAcid: "mg/100g",
           glycine: "mg/100g",
           proline: "mg/100g",
           serine: "mg/100g",
           cerine: "mg/100g",
           caffeine: "mg/100g",
           theobromine: "mg/100g",
           betaCarotene: "µg",
           alphaCarotene: "µg",
           betaCryptoxanthin: "µg",
           lycopene: "µg",
           luteinZeaxanthin: "µg",
           biotin: "µg",
           gammaOryzanol: "mg/100g",
           phenolicCompounds: "mg GAE/g",
           totalAntioxidant: "µmol TE/g",
           gallicAcid: "mg/100g",
           eriodictyol: "mg/100g",
           anthocyanin: "mg/100g",
           apigenin: "mg/100g",
           isoquercetin: "mg/100g",
           hydroquinin: "mg/100g",
           quercetin: "mg/100g",
           Kaempferol: "mg/100g",
           rutin: "mg/100g",
           catechin: "mg/100g",
           tannicAcid: "mg/100g",
           totalFlavonoid: "mg QE/g",
           GABA: "mg/100g",
           genistein: "mg/100g",
           daidzein: "mg/100g",
           genistin: "mg/100g",
           daidzin: "mg/100g",
           quercitin3BDglucoside: "mg/100g",
           peonidin3Oglucoside: "mg/100g",
           oenin: "mg/100g",
           anthocyanin3glucoside: "mg/100g",
           callistephin: "mg/100g",
           keracyanin: "mg/100g",
           kuromanin: "mg/100g",
           malvidin3galactoside: "mg/100g"
       };

       function hasValidData4(data) {
           for (const cat in data) {
               for (const field in data[cat]) {
                   if (data[cat][field].length > 0) {
                       return true;
                   }
               }
           }
           return false;
       }


       const chartContainer4 = document.getElementById('chartContainer4');
       const noDataMsg4 = document.getElementById('noDataMsg4');

       if (!hasValidData4(chartData4)) {
           noDataMsg4.style.display = 'block';
       } else {
           noDataMsg4.style.display = 'none';

           // หาฟิลด์ที่มีข้อมูลจริง
           let fieldsWithData4 = new Set();
           for (const cat in chartData4) {
               for (const field in chartData4[cat]) {
                   if (fieldsToShow4.includes(field) && chartData4[cat][field].length > 0) {
                       fieldsWithData4.add(field);
                   }
               }
           }
           fieldsWithData4 = Array.from(fieldsWithData4);


           // หมวดหมู่ที่มีข้อมูลอย่างน้อย 1 ฟิลด์ใน fieldsToShow4
           const categories = Object.keys(chartData4).filter(cat => {
               return fieldsToShow4.some(field => {
                   const values = chartData4[cat][field];
                   return values && values.length > 0;
               });
           });
           // สร้างกราฟแยก 1 ฟิลด์ 1 กราฟ
           fieldsWithData4.forEach(field => {
               // ✅ กรองเฉพาะหมวดที่ field นี้มีข้อมูล
               const filteredCategories4 = categories.filter(cat => {
                   const values = chartData4[cat][field] || [];
                   return values.length > 0;
               });

               // ✅ ข้าม field นี้ถ้าไม่มีหมวดไหนมีข้อมูลเลย
               if (filteredCategories4.length === 0) return;

               // ✅ คำนวณค่าเฉลี่ยเฉพาะหมวดที่มีข้อมูล
               const data = filteredCategories4.map(cat => {
                   const values = chartData4[cat][field];
                   return values.reduce((a, b) => a + b, 0) / values.length;
               });

               // ✅ ข้ามถ้าค่าเฉลี่ยทั้งหมดเป็น 0 (ไม่จำเป็นเสมอ แต่กันไว้)
               if (data.every(val => val === 0)) return;

               // ✅ สร้างกราฟ
               const cardWrapper3 = document.createElement('div');
               cardWrapper3.className = 'bg-white rounded-xl shadow p-4';

               const canvas = document.createElement('canvas');
               canvas.id = `chart4_${field}`;
               canvas.style.width = '100%'; // ให้กว้างเต็ม container
               canvas.style.height = '300px'; // กำหนดความสูงแบบตรงๆ ด้วย style

               cardWrapper3.appendChild(canvas);
               chartContainer4.appendChild(cardWrapper3);

               const ctx = canvas.getContext('2d');

               new Chart(ctx, {
                   type: 'bar',
                   data: {
                       labels: filteredCategories4,
                       datasets: [{
                           label: `${field}${fieldUnits4[field] ? ' (' + fieldUnits4[field] + ')' : ''}`,
                           data: data,
                           backgroundColor: filteredCategories4.map(cat => categoryColors[cat] || '#999'),

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
                               text: `${fieldNamesTH4[field] || field}${fieldUnits4[field] ? ' (' + fieldUnits4[field] + ')' : ''}`,
                               font: {
                                   family: 'Noto Sans Thai'
                               },
                               color: '#000' // ✅ ทำหัวกราฟให้เป็นสีดำเข้ม
                           },
                           tooltip: {
                               callbacks: {
                                   label: function(context) {
                                       return `${context.parsed.y.toFixed(2)} ${fieldUnits4[field] || ''}`;
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