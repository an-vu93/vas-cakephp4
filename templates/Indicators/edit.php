<?php
$this->extend('/element/container');

$this->assign('title', '指標編集');
$this->assign('buttonText', '← 戻る');
$this->assign('buttonClass', 'bg-red-600 hover:bg-red-700 focus:ring-red-300');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'Indicators',
    'action' => 'index',
]));
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    <?= $this->Form->create($indicator, ['class' => 'mx-auto max-w-screen-xl lg:max-w-5xl md:max-w-3xl']) ?>
      
        <?= $this->Form->control('name', [
            'label' => [
                'text' => '指標名',
                'class' => 'mb-2 text-lg font-medium text-gray-900'
            ],
            'type' => 'text',
            'required' => true,
            'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
        ]) ?>

        <?= $this->Form->control('query', [
            'label' => [
                'text' => '定義句',
                'class' => 'mb-2 text-lg font-medium text-gray-900'
            ],
            'type' => 'textarea',
            'required' => true,
            'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-10/12 p-2.5 ml-12',
        ]) ?>

        <div class="flex mb-5 items-center">
            <div class="mr-4 text-lg font-medium text-gray-900">有効設定</div>
            <div class="flex items-center space-x-4">
                <?= $this->Form->radio('active', [
                    ['value' => 1, 'text' => '有効', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                    ['value' => 0, 'text' => '無効', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                ], [
                    'class' => 'flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700',
                    'default' => '1',           
                ]) ?>
            </div>
        </div>

        <div class="w-full max-w-4xl p-4 bg-white rounded-lg shadow-md">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold mb-4">指標を構成するメトリクスの分布図</h2>
                <div>
                    <a id="back-btn" style="display:none;">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5"/>
                        </svg>
                    </a>
                    <a id="reset-btn" style="display:none;">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="relative">
                <canvas id="distribution-graph" 
                    data-url="<?= $this->Url->build([
                        'controller' => 'Indicators',
                        'action' => 'get-related-metrics',
                        $indicator->id
                    ]) ?>"
                >
                </canvas>
            </div>
        </div>

        <table id="dynamicTable" class="table-auto w-full border border-white mt-10 mb-5">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2 border border-white">
                        境界１
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        境界２
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        境界３
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        境界４
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody class="bg-primary-50">
                
                <tr>
                    <td scope="row" class="px-4 py-2 border border-white">
                        <?= $this->Form->control('percentile_20', [
                            'class' => 'w-full p-2 border border-primary-300 bg-white rounded',
                            'label' => false
                        ]) ?>
                    </td>

                    <td scope="row" class="px-4 py-2 border border-white">
                        <?= $this->Form->control('percentile_40', [
                            'class' => 'w-full p-2 border border-primary-300 bg-white rounded',
                            'label' => false
                        ]) ?>
                    </td>

                    <td scope="row" class="px-4 py-2 border border-white">
                        <?= $this->Form->control('percentile_60', [
                            'class' => 'w-full p-2 border border-primary-300 bg-white rounded',
                            'label' => false
                        ]) ?>
                    </td>

                    <td scope="row" class="px-4 py-2 border border-white">
                        <?= $this->Form->control('percentile_80', [
                            'class' => 'w-full p-2 border border-primary-300 bg-white rounded',
                            'label' => false
                        ]) ?>
                    </td>
                    <td scope="row" class="px-8 py-2 border border-white">
                        <a 
                            href="#" 
                            class="p-2"
                            id="calculate-indicator-btn" 
                            data-url="<?= $this->Url->build([
                                'controller' => 'Indicators',
                                'action' => 'calculate',
                                $indicator->id
                            ]) ?>"
                        >
                            参考値</a>
                    </td>
                 
                    
                    
                </tr>
            </tbody>
        </table>
                  
        <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center">保存</button>
    <?= $this->Form->end() ?>
</div>

<!-- chart.js -->
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js') ?>

<script>
document.getElementById('calculate-indicator-btn').addEventListener('click', async function () {
const url = this.getAttribute('data-url');

try {
const response = await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    });

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const json = await response.json();

    if (json.success && json.data) {
        // Populate input fields with the corresponding data
        for (const key in json.data) {
            const input = document.querySelector(`input[name="${key}"]`);
            if (input) {
                input.value = json.data[key];
            }
        }
    }
} catch (error) {
    console.error('Error fetching indicator data:', error);
    
}
});

let originalData = {
    metricValues: [],
    occurrences: []
};

let drilldownHistory = []; // each element will be {min, max, bins, binLabels}
let currentView = null; // keep track of current view's [min, max]
let ctx;

document.addEventListener('DOMContentLoaded', function() {
    const distributionGraph = document.getElementById('distribution-graph');
    ctx = distributionGraph.getContext('2d');

    ctx.canvas.width = 500;
    ctx.canvas.height = 500;
    const url = distributionGraph.getAttribute('data-url');

    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
    })
    .then(response => response.json())
    .then(response => {
        const data = response.data;
        originalData.metricValues = data.metric_values;
        originalData.occurrences = data.occurences;
        
        // Render the initial chart with 5 bins
        const originalMin = Math.min(...originalData.metricValues);
        const originalMax = Math.max(...originalData.metricValues);
        renderChart(originalMin, originalMax, originalData.metricValues, originalData.occurrences);
    });
});

document.getElementById('back-btn').addEventListener('click', () => {
    if (drilldownHistory.length > 0) {
        const previousView = drilldownHistory.pop();
        // Re-render the chart using the previous view's min and max
        renderChart(previousView.min, previousView.max, originalData.metricValues, originalData.occurrences);

        // If we've gone back to the original level, hide the back button
        if (drilldownHistory.length === 0) {
            hideNavigationButtons();
        }
    }
});

document.getElementById('reset-btn').addEventListener('click', () => {
    // Clear history and render the original chart
    drilldownHistory = [];
    const originalMin = Math.min(...originalData.metricValues);
    const originalMax = Math.max(...originalData.metricValues);
    renderChart(originalMin, originalMax, originalData.metricValues, originalData.occurrences);
    hideNavigationButtons();
});

function showNavigationButtons() {
    document.getElementById('back-btn').style.display = 'inline-block';
    document.getElementById('reset-btn').style.display = 'inline-block';
}

function hideNavigationButtons() {
    document.getElementById('back-btn').style.display = 'none';
    document.getElementById('reset-btn').style.display = 'none';
}

function chartClickHandler(event, elements) {
  // If no element is clicked, do nothing.
  if (!elements.length) return;
  
  // Get the index of the clicked bar.
  const elementIndex = elements[0].index;
  
  // Retrieve the label from the chart.
  const label = window.myChart.data.labels[elementIndex];

  // Parse the label to extract newMin and newMax.
  let newMin, newMax;
  if (label.indexOf('~') !== -1) {
    // Label is in the form "min-max"
    const parts = label.split('~');
    newMin = parseFloat(parts[0]);
    newMax = parseFloat(parts[1]);
  } else {
    // Label is a primitive value (e.g., "1900")
    newMin = parseFloat(label);
    newMax = newMin;
  }
  
  // Save the current view in the drilldown history.
  drilldownHistory.push(currentView);
  console.log(drilldownHistory);
  
  // Render the chart for the new drilldown range.
  renderChart(newMin, newMax, originalData.metricValues, originalData.occurrences);
  
  // Show the navigation buttons
  showNavigationButtons();
}



function renderChart(min, max, metricValues, occurrences) {
  
  const binCount = 5;
  let bins, binLabels, binSize;

  // Check if we have a primitive value
  if (min === max) {
    // When min and max are equal, we display a single value instead of a range.
    bins = [0];
    binLabels = [min.toString()];
    // Aggregate counts only for values equal to min
    metricValues.forEach((value, index) => {
      if (value === min) {
        bins[0] += occurrences[index];
      }
    });
  } else {
    // Normal range view: break the interval [min, max] into 5 bins.
    binSize = (max - min) / binCount;
    bins = Array(binCount).fill(0);
    binLabels = [];
    
    for (let i = 0; i < binCount; i++) {
      const lowerBound = Math.round(min + i * binSize);
      const upperBound = Math.round(min + (i + 1) * binSize);
      binLabels.push(`${lowerBound}~${upperBound}`);
    }
    
    metricValues.forEach((value, index) => {
      if (value >= min && value <= max) {
        const binIndex = Math.min(
          Math.floor((value - min) / binSize),
          binCount - 1
        );
        bins[binIndex] += occurrences[index];
      }
    });
  }

  // Save the current view. If it's a primitive value, mark it so that drilldown can be disabled.
  currentView = { min, max, binLabels, bins };

  // Create or update the chart
  if (window.myChart) {
    window.myChart.data.labels = binLabels;
    window.myChart.data.datasets[0].data = bins;
    window.myChart.options.onClick = (min === max) ? null : chartClickHandler;
    window.myChart.update();
  } else {
    window.myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: binLabels,
        datasets: [{
          label: '顧客数',
          data: bins,
          backgroundColor: '#4f46e5',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          tooltip: {
            callbacks: {
              title: (items) => `${items[0].label} メトリックス値`,
              label: (item) => `${item.formattedValue} 顧客数`
            }
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'メトリックス値'
            }
          },
          y: {
            title: {
              display: true,
              text: '顧客数'
            }
          }
        },
        // Only enable click handler if this is not a primitive value view.
        onClick: (min === max) ? null : chartClickHandler
      }
    });
  }
}


</script>
