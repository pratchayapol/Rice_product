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
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-rose-100" id="sub_tab1" role="tabpanel" aria-labelledby="sub_tab1-tab">
                <div id="chartContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto">
                    <p id="noDataMsg" class="text-red-600 font-bold col-span-full hidden">ไม่พบข้อมูล</p>
                </div>

                <script>
                    // สมมติ chartData ถูกส่งมาจาก PHP มาแล้ว

                    const fieldsToShow = [
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

                    function hasValidData(data) {
                        for (const cat in data) {
                            for (const field in data[cat]) {
                                if (data[cat][field].length > 0) {
                                    return true;
                                }
                            }
                        }
                        return false;
                    }

                    const chartContainer = document.getElementById('chartContainer');
                    const noDataMsg = document.getElementById('noDataMsg');

                    if (!hasValidData(chartData)) {
                        noDataMsg.style.display = 'block';
                    } else {
                        noDataMsg.style.display = 'none';

                        // หาฟิลด์ที่มีข้อมูลจริง
                        let fieldsWithData = new Set();
                        for (const cat in chartData) {
                            for (const field in chartData[cat]) {
                                if (fieldsToShow.includes(field) && chartData[cat][field].length > 0) {
                                    fieldsWithData.add(field);
                                }
                            }
                        }
                        fieldsWithData = Array.from(fieldsWithData);


                        // หมวดหมู่ที่มีข้อมูลอย่างน้อย 1 ฟิลด์ใน fieldsToShow
                        const categories = Object.keys(chartData).filter(cat => {
                            return fieldsToShow.some(field => {
                                const values = chartData[cat][field];
                                return values && values.length > 0;
                            });
                        });
                        // สร้างกราฟแยก 1 ฟิลด์ 1 กราฟ
                        fieldsWithData.forEach(field => {
                            // ✅ กรองเฉพาะหมวดที่ field นี้มีข้อมูล
                            const filteredCategories = categories.filter(cat => {
                                const values = chartData[cat][field] || [];
                                return values.length > 0;
                            });

                            // ✅ ข้าม field นี้ถ้าไม่มีหมวดไหนมีข้อมูลเลย
                            if (filteredCategories.length === 0) return;

                            // ✅ คำนวณค่าเฉลี่ยเฉพาะหมวดที่มีข้อมูล
                            const data = filteredCategories.map(cat => {
                                const values = chartData[cat][field];
                                return values.reduce((a, b) => a + b, 0) / values.length;
                            });

                            // ✅ ข้ามถ้าค่าเฉลี่ยทั้งหมดเป็น 0 (ไม่จำเป็นเสมอ แต่กันไว้)
                            if (data.every(val => val === 0)) return;

                            // ✅ สร้างกราฟ
                            const cardWrapper = document.createElement('div');
                            cardWrapper.className = 'bg-white rounded-xl shadow p-4';

                            const canvas = document.createElement('canvas');
                            canvas.id = `chart_${field}`;
                            canvas.style.width = '100%'; // ให้กว้างเต็ม container
                            canvas.style.height = '300px'; // กำหนดความสูงแบบตรงๆ ด้วย style

                            cardWrapper.appendChild(canvas);
                            chartContainer.appendChild(cardWrapper);

                            const ctx = canvas.getContext('2d');

                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: filteredCategories,
                                    datasets: [{
                                        label: `${field}${fieldUnits[field] ? ' (' + fieldUnits[field] + ')' : ''}`,
                                        data: data,
                                        backgroundColor: filteredCategories.map(() => getRandomColor()),
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
                                                }
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
                                                }
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
                                            }
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

                    function getRandomColor() {
                        const r = Math.floor(Math.random() * 200);
                        const g = Math.floor(Math.random() * 200);
                        const b = Math.floor(Math.random() * 200);
                        return `rgba(${r},${g},${b},0.7)`;
                    }
                </script>


            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="sub_tab2" role="tabpanel" aria-labelledby="sub_tab2-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">sub_tab2 tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="sub_tab3" role="tabpanel" aria-labelledby="sub_tab3-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">sub_tab3 tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="sub_tab4" role="tabpanel" aria-labelledby="sub_tab4-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">sub_tab4 tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
        </div>

    </div>
</div>