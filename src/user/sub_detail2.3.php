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
                  <div id="chartContainer">
                      <canvas id="physicalChart"></canvas>
                      <p id="noDataMsg" style="display:none; color: red; font-weight: bold;">ไม่พบข้อมูล</p>
                  </div>

                  <script>
                      // chartData ถูกส่งมาจาก PHP แล้ว

                      // ตรวจสอบว่ามีข้อมูลตัวเลขจริงๆ หรือไม่
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

                      const noDataMsg = document.getElementById('noDataMsg');
                      const ctx = document.getElementById('physicalChart').getContext('2d');

                      if (!hasValidData(chartData)) {
                          // ไม่มีข้อมูลแสดงข้อความแทนกราฟ
                          document.getElementById('physicalChart').style.display = 'none';
                          noDataMsg.style.display = 'block';
                      } else {
                          noDataMsg.style.display = 'none';

                          // เตรียมข้อมูลสำหรับกราฟ
                          // สมมติจะเอา field เป็นแกน Y, ค่าเฉลี่ยของแต่ละหมวดหมู่เป็นแกน X
                          // เพราะ physicalData[category][field] เป็น array ของค่าตัวเลข

                          // รวบรวมฟิลด์ทั้งหมดจาก category แรกที่มีข้อมูล
                          let allFields = new Set();
                          for (const cat in chartData) {
                              for (const field in chartData[cat]) {
                                  allFields.add(field);
                              }
                          }
                          allFields = Array.from(allFields);

                          // เตรียม datasets ตามหมวดหมู่แต่ละตัว
                          const categories = Object.keys(chartData);
                          const datasets = categories.map(cat => {
                              return {
                                  label: cat,
                                  data: allFields.map(field => {
                                      const values = chartData[cat][field] || [];
                                      if (values.length === 0) return 0;
                                      // ค่าเฉลี่ย
                                      const avg = values.reduce((a, b) => a + b, 0) / values.length;
                                      return avg;
                                  }),
                                  backgroundColor: getRandomColor(),
                              };
                          });

                          const physicalChart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: allFields,
                                  datasets: datasets,
                              },
                              options: {
                                  indexAxis: 'y', // ทำให้เป็นแผนภูมิแท่งแนวนอน
                                  responsive: true,
                                  scales: {
                                      x: {
                                          beginAtZero: true,
                                      }
                                  },
                                  plugins: {
                                      legend: {
                                          position: 'top',
                                      },
                                      title: {
                                          display: true,
                                          text: 'ข้อมูลทางกายภาพตามหมวดหมู่'
                                      }
                                  }
                              }
                          });

                          // ฟังก์ชันสุ่มสีแบบง่ายๆ
                          function getRandomColor() {
                              const r = Math.floor(Math.random() * 200);
                              const g = Math.floor(Math.random() * 200);
                              const b = Math.floor(Math.random() * 200);
                              return `rgba(${r},${g},${b},0.7)`;
                          }
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