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
            <h2 class="text-xl font-bold mb-4">指標を構成するメトリクスの分布図</h2>
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
        console.log(json)
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

document.addEventListener('DOMContentLoaded', function() {
    const distributionGraph = document.getElementById('distribution-graph');
    const ctx = distributionGraph.getContext('2d');
    ctx.canvas.width = 500;
    ctx.canvas.height = 500;
    const url = distributionGraph.getAttribute('data-url');
    
    fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(response => {
            const data = response.data;
            
            const mertricValues = data.metric_values;
            const occurences = data.occurences;

            // Find the min and max values in mertricValues to determine bin ranges
            const min = Math.min(...mertricValues);
            const max = Math.max(...mertricValues);
            const binSize = (max - min) / 5;

            // Initialize bins
            const bins = Array(5).fill(0);
            const binLabels = [];

            // Populate bin labels
            for (let i = 0; i < 5; i++) {
                const lowerBound = Math.round(min + i * binSize);
                const upperBound = Math.round(min + (i + 1) * binSize);
                binLabels.push(`${lowerBound}-${upperBound}`);
            }

             // Aggregate data into bins
             mertricValues.forEach((value, index) => {
                const binIndex = Math.min(
                    Math.floor((value - min) / binSize),
                    9 // Ensure values at max fall into the last bin
                );
                bins[binIndex] += occurences[index];
            });

            new Chart(ctx, {
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
                    }
                }
            });
        });
});

</script>
