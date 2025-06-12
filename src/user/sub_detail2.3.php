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


                  <canvas id="physicalChart" height="120"></canvas>
                  <script>
                      const ctx = document.getElementById('physicalChart').getContext('2d');

                      const labels = Object.keys(chartData); // ข้าวเปลือก, ข้าวสาร ฯลฯ

                      const getAvg = arr => arr.length ? arr.reduce((a, b) => a + b, 0) / arr.length : 0;

                      const seedWeight = labels.map(cat => getAvg(chartData[cat]['seedWeight']));
                      const length = labels.map(cat => getAvg(chartData[cat]['length']));
                      const width = labels.map(cat => getAvg(chartData[cat]['width']));

                      new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels: labels,
                              datasets: [{
                                      label: 'น้ำหนักเมล็ด (g/1000 เมล็ด)',
                                      data: seedWeight,
                                      backgroundColor: 'rgba(75, 192, 192, 0.7)'
                                  },
                                  {
                                      label: 'ความยาว (mm)',
                                      data: length,
                                      backgroundColor: 'rgba(255, 206, 86, 0.7)'
                                  },
                                  {
                                      label: 'ความกว้าง (mm)',
                                      data: width,
                                      backgroundColor: 'rgba(153, 102, 255, 0.7)'
                                  }
                              ]
                          },
                          options: {
                              responsive: true,
                              scales: {
                                  y: {
                                      beginAtZero: true
                                  }
                              },
                              plugins: {
                                  title: {
                                      display: true,
                                      text: 'ข้อมูลทางกายภาพ แยกตามประเภทข้าว'
                                  }
                              }
                          }
                      });
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