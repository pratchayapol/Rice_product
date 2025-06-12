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
              <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-orange-200" id="sub_tab1" role="tabpanel" aria-labelledby="sub_tab1-tab">
                  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                      <!-- Card: ข้าวเปลือก -->
                      <div class="bg-blue-100 p-4 rounded shadow">
                          <h2 class="text-lg font-bold mb-2 text-center">ข้าวเปลือก</h2>
                          <p class="text-center text-gray-600">ไม่มีข้อมูล</p>
                      </div>

                      <!-- Card: ข้าวสาร -->
                      <div class="bg-blue-100 p-4 rounded shadow">
                          <h2 class="text-lg font-bold mb-2 text-center">ข้าวสาร</h2>
                          <ul class="text-sm text-gray-700 space-y-1">
                              <li>แคลเซียม: 19.62 mg/kg</li>
                              <li>ไอโซเควอซิติน: 54.06 mg/kg</li>
                              <li>เควอซิติน: 145.34 mg/kg</li>
                              <li>รูติน: 50.12 mg/kg</li>
                              <li>แคทีชิน: 36.64 mg/kg</li>
                              <li>กรดแทนนิก: 87.87 mg/kg</li>
                          </ul>
                      </div>

                      <!-- Card: ข้าวกล้อง -->
                      <div class="bg-blue-100 p-4 rounded shadow">
                          <h2 class="text-lg font-bold mb-2 text-center">ข้าวกล้อง</h2>
                          <p class="text-center text-gray-600">ไม่มีข้อมูล</p>
                      </div>

                      <!-- Card: ข้าวกล้องงอก -->
                      <div class="bg-blue-100 p-4 rounded shadow">
                          <h2 class="text-lg font-bold mb-2 text-center">ข้าวกล้องงอก</h2>
                          <p class="text-center text-gray-600">ไม่มีข้อมูล</p>
                      </div>
                  </div>

                  <!-- แผนภูมิแท่ง -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <!-- แคลเซียม -->
                      <div class="chart-container">
                          <canvas id="chartCalcium"></canvas>
                      </div>

                      <!-- ไอโซเควอซิติน -->
                      <div class="chart-container">
                          <canvas id="chartIsoquercetin"></canvas>
                      </div>

                      <!-- เควอซิติน -->
                      <div class="chart-container">
                          <canvas id="chartQuercetin"></canvas>
                      </div>

                  </div>


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

          <script>
              const riceTypes = ['ข้าวสาร', 'ข้าวเปลือก', 'ข้าวกล้อง', 'ข้าวกล้องงอก'];

              // แคลเซียม
              new Chart(document.getElementById('chartCalcium'), {
                  type: 'bar',
                  data: {
                      labels: riceTypes,
                      datasets: [{
                          label: 'แคลเซียม (mg/kg)',
                          data: [19.62, 0, 0, 0],
                          backgroundColor: 'rgba(54, 162, 235, 0.7)'
                      }]
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          title: {
                              display: true,
                              text: 'แคลเซียม'
                          }
                      },
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });

              // ไอโซเควอซิติน
              new Chart(document.getElementById('chartIsoquercetin'), {
                  type: 'bar',
                  data: {
                      labels: riceTypes,
                      datasets: [{
                          label: 'ไอโซเควอซิติน (mg/kg)',
                          data: [54.06, 0, 0, 0],
                          backgroundColor: 'rgba(255, 159, 64, 0.7)'
                      }]
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          title: {
                              display: true,
                              text: 'ไอโซเควอซิติน'
                          }
                      },
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });

              // เควอซิติน
              new Chart(document.getElementById('chartQuercetin'), {
                  type: 'bar',
                  data: {
                      labels: riceTypes,
                      datasets: [{
                          label: 'เควอซิติน (mg/kg)',
                          data: [145.34, 0, 0, 0],
                          backgroundColor: 'rgba(255, 99, 132, 0.7)'
                      }]
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          title: {
                              display: true,
                              text: 'เควอซิติน'
                          }
                      },
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });
          </script>
      </div>
  </div>