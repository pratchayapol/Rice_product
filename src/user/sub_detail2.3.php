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
                <div id="chartContainer2" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto mt-10">
                    <p id="noDataMsg2" class="text-red-600 font-bold col-span-full hidden">ไม่พบข้อมูล</p>
                </div>

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
    const fieldNamesTH2 = {
        totalEnergy: "พลังงานทั้งหมด",
        carbohydrate: "คาร์โบไฮเดรต",
        starch: "ปริมาณแป้ง",
        dietaryFiber: "ใยอาหาร",
        crudeFiber: "กากใยอาหาร",
        totalSugar: "น้ำตาล",
        protein: "โปรตีน",
        totalFat: "ไขมันทั้งหมด",
        saturatedFat: "ไขมันอิ่มตัว",
        unsaturatedFat: "ไขมันไม่อิ่มตัว",
        saturatedFattyAcid: "กรดไขมันอิ่มตัว",
        monosaturatedFattyAcid: "กรดไขมันอิ่มตัวเชิงเดี่ยว",
        polysaturatedFattyAcid: "กรดไขมันอิ่มตัวหลายระดับ",
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
        thiamine: "ไทอามีน",
        pantothenicAcid: "กรดแพนโททีนิก",
        vitaminB1: "วิตามินบี1",
        vitaminB2: "วิตามินบี2",
        riboflavin: "ไรโบฟลาวิน",
        vitaminB3: "วิตามินบี3",
        vitaminB4: "วิตามินบี4",
        vitaminB5: "วิตามินบี5",
        vitaminB6: "วิตามินบี6",
        allFolate: "โฟเลตทั้งหมด",
        folicAcid: "กรดโฟลิก",
        foodFolate: "อาหารโฟเลต",
        DFEFolate: "ดีเอฟอีโฟเลต",
        vitaminB12: "วิตามินบี12",
        retinol: "เรตินอล",
        vitaminE: "วิตามินอี",
        vitaminK: "วิตามินเค"
    };

    const fieldUnits2 = {
        totalEnergy: "kcal/100g",
        carbohydrate: "g/100g",
        starch: "g/100g",
        dietaryFiber: "g/100g",
        crudeFiber: "g/100g",
        totalSugar: "g/100g",
        protein: "g/100g",
        totalFat: "g/100g",
        saturatedFat: "g/100g",
        unsaturatedFat: "g/100g",
        saturatedFattyAcid: "g",
        monosaturatedFattyAcid: "g",
        polysaturatedFattyAcid: "g",
        cholesterol: "mg",
        energyFromFat: "kcal/100g",
        calcium: "mg/kg",
        iron: "mg/kg",
        magnesium: "mg/kg",
        phosphorus: "mg/kg",
        potassium: "mg/kg",
        sodium: "mg/kg",
        zinc: "mg/kg",
        iodine: "mg/kg",
        copper: "mg/kg",
        maganese: "mg/kg",
        selenium: "mg/kg",
        aluminium: "mg/kg",
        vitaminA: "µg",
        betaCarotene: "mg/kg",
        vitaminC: "mg",
        thiamine: "mg",
        pantothenicAcid: "mg",
        vitaminB1: "mg/kg",
        vitaminB2: "mg/kg",
        riboflavin: "mg",
        vitaminB3: "mg",
        vitaminB4: "mg",
        vitaminB5: "mg",
        vitaminB6: "mg",
        allFolate: "µg",
        folicAcid: "µg",
        foodFolate: "µg",
        DFEFolate: "µg",
        vitaminB12: "µg",
        retinol: "µg",
        vitaminE: "mg/kg",
        vitaminK: "µg"
    };

    const chartContainer2 = document.getElementById('chartContainer2');
    const noDataMsg2 = document.getElementById('noDataMsg2');

    if (!hasValidData(chartData)) {
        noDataMsg2.style.display = 'block';
    } else {
        noDataMsg2.style.display = 'none';

        let fieldsWithData2 = new Set();
        for (const cat in chartData) {
            for (const field in chartData[cat]) {
                if (fieldsToShow2.includes(field) && chartData[cat][field].length > 0) {
                    fieldsWithData2.add(field);
                }
            }
        }
        fieldsWithData2 = Array.from(fieldsWithData2);

        const categories2 = Object.keys(chartData).filter(cat => {
            return fieldsToShow2.some(field => {
                const values = chartData[cat][field];
                return values && values.length > 0;
            });
        });

        fieldsWithData2.forEach(field => {
            const filteredCategories2 = categories2.filter(cat => {
                const values = chartData[cat][field] || [];
                return values.length > 0;
            });

            if (filteredCategories2.length === 0) return;

            const data = filteredCategories2.map(cat => {
                const values = chartData[cat][field];
                return values.reduce((a, b) => a + b, 0) / values.length;
            });

            if (data.every(val => val === 0)) return;

            const cardWrapper = document.createElement('div');
            cardWrapper.className = 'bg-white rounded-xl shadow p-4';

            const canvas = document.createElement('canvas');
            canvas.id = `chart2_${field}`;
            canvas.style.width = '100%';
            canvas.style.height = '300px';

            cardWrapper.appendChild(canvas);
            chartContainer2.appendChild(cardWrapper);

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
                                display: true
                            },
                            ticks: {
                                font: {
                                    family: 'Noto Sans Thai'
                                },
                                color: '#000'
                            },
                            grid: {
                                display: false
                            }
                        },
                        x: {
                            title: {
                                display: true
                            },
                            ticks: {
                                font: {
                                    family: 'Noto Sans Thai'
                                },
                                color: '#000'
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: `${fieldNamesTH2[field] || field}${fieldUnits2[field] ? ' (' + fieldUnits2[field] + ')' : ''}`,
                            font: {
                                family: 'Noto Sans Thai'
                            },
                            color: '#000'
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
</script>