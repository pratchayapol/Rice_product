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


                  <div id="chartsContainer"></div>

                  <script>
                      window.addEventListener("DOMContentLoaded", () => {
                          const fieldLabels = {
                              seedWeight: "น้ำหนักเมล็ด (g)",
                              length: "ความยาว (mm)",
                              width: "ความกว้าง (mm)",
                              thickness: "ความหนา (mm)",
                              chalkiness: "ข้าวท้องไข่ (%)",
                              gloss: "ความมัน",
                              whiteness: "ความขาว",
                              transparency: "ความโปร่งใส",
                              moisture: "ความชื้น (%)",
                              elongationRatio: "การยืดตัว",
                              swelling: "การพองตัว",
                              texture: "เนื้อสัมผัส",
                              peakViscosity: "ความหนืดสูงสุด",
                              trough: "ความหนืดต่ำสุด",
                              breakdown: "การสลายตัว",
                              finalViscosity: "ความหนืดสุดท้าย",
                              setback: "การคืนตัว",
                              pastingTemp: "อุณหภูมิแป้งสุก",
                              riceFlourViscosity: "ความหนืดแป้งข้าว",
                              precipitation: "การตกตะกอน",
                              retrogradation: "การคืนตัวของแป้ง",
                              gelConsistency: "ความคงตัวของแป้ง",
                              swellingPower: "กำลังพองตัว (%)",
                              hardness: "ความแข็ง",
                              adhesiveness: "ความเหนียวติด",
                              stickiness: "ความเหนียว"
                          };

                          for (const field in fieldLabels) {
                              const datasets = [];
                              const labels = [];
                              let allEmpty = true;

                              for (const category in chartData) {
                                  const valuesRaw = chartData[category][field];
                                  const values = Array.isArray(valuesRaw) ? valuesRaw : [];
                                  const validValues = values.filter(v => v != null && v !== '' && !isNaN(v) && v !== 0);

                                  if (validValues.length > 0) {
                                      allEmpty = false;
                                      const avg = validValues.reduce((a, b) => a + b, 0) / validValues.length;
                                      datasets.push({
                                          label: category,
                                          data: [avg],
                                          backgroundColor: getColor(category)
                                      });
                                      labels.push(category);
                                  }
                              }

                              const canvasId = `chart_${field}`;
                              if (allEmpty) {
                                  document.getElementById("chartsContainer").innerHTML += `
                <div style="margin-bottom: 40px;">
                    <h3>${fieldLabels[field]}</h3>
                    <p style="color: red;">ไม่พบข้อมูล</p>
                </div>
            `;
                              } else {
                                  document.getElementById("chartsContainer").innerHTML += `
                <div style="margin-bottom: 40px;">
                    <h3>${fieldLabels[field]}</h3>
                    <canvas id="${canvasId}" height="200"></canvas>
                </div>
            `;
                                  new Chart(document.getElementById(canvasId), {
                                      type: 'bar',
                                      data: {
                                          labels: labels,
                                          datasets: [{
                                              label: fieldLabels[field],
                                              data: datasets.map(d => d.data[0]),
                                              backgroundColor: datasets.map(d => d.backgroundColor)
                                          }]
                                      },
                                      options: {
                                          responsive: true,
                                          plugins: {
                                              legend: {
                                                  display: false
                                              },
                                              title: {
                                                  display: false
                                              }
                                          },
                                          scales: {
                                              y: {
                                                  beginAtZero: true
                                              }
                                          }
                                      }
                                  });
                              }
                          }

                          function getColor(category) {
                              const colors = {
                                  "ข้าวเปลือก": "rgba(255, 99, 132, 0.7)",
                                  "ข้าวสาร": "rgba(54, 162, 235, 0.7)",
                                  "ข้าวกล้อง": "rgba(255, 206, 86, 0.7)",
                                  "ข้าวกล้องงอก": "rgba(75, 192, 192, 0.7)"
                              };
                              return colors[category] || "rgba(201, 203, 207, 0.7)";
                          }

                          console.log("✅ chartData:", chartData);
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