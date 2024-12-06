<?php 
$this->extend('/element/container');

$this->assign('title', 'ツール追加');
$this->assign('buttonText', '← 戻る');
$this->assign('buttonClass', 'bg-red-600 hover:bg-red-700 focus:ring-red-300');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'Analyses',
    'action' => 'index',
]));
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    
    <?= $this->Form->create($analysis, ['class' => 'mx-auto max-w-screen-xl lg:max-w-5xl md:max-w-3xl']) ?>
        
        <?= $this->Form->control('name', [
            'label' => [
                'text' => '解析名',
                'class' => 'mb-2 text-lg font-medium text-gray-900'
            ],
            'type' => 'text',
            'required' => true,
            'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
        ]) ?>

        <?= $this->Form->control('description', [
            'label' => [
                'text' => '説明文',
                'class' => 'mb-2 text-lg font-medium text-gray-900'
            ],
            'type' => 'textarea',
            'required' => true,
            'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-10/12 p-2.5 ml-12',
        ]) ?>

        <div class="flex mb-5 items-center">
            <div class="mr-4 text-lg font-medium text-gray-900">公開設定</div>
            <div class="flex items-center space-x-4">
                <?= $this->Form->radio('public_flg', [
                    ['value' => 1, 'text' => '公開', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2'],
                    ['value' => 0, 'text' => '下書き', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2'],
                ], [
                    'class' => 'flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700',
                    'default' => '1',           
                ]) ?>
            </div>
        </div>

        <table id="dynamicTable" class="table-auto w-full border border-white mt-10 mb-5">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2 border border-white">
                        指標
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        重み
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody class="bg-primary-50">
                <?php foreach($analysis->indicator_weights as $key => $indicator_weight): ?>
                <tr>
                    <th scope="row" class="px-4 py-2 border border-white">
                        <?= $this->Form->select("indicator_weights.{$key}.indicator_id", 
                            $indicators, 
                            ['class' => 'w-full p-2 border border-primary-300 bg-white rounded',]) 
                        ?>
                          <?= $this->Form->hidden("indicator_weights.{$key}.id", ['value' => $indicator_weight->id]) ?>
                    </th>
                    <td class="px-4 py-2 text-center border border-white">
                    
                        <?= $this->Form->select("indicator_weights.{$key}.weight", 
                            [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], 
                            ['class' => 'w-full p-2 border border-primary-300 bg-white rounded',]) 
                        ?>
                       
                    </td>
                    <td class="flex justify-evenly px-4 py-2 text-center border border-white">
                        <a class="add-row w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white">追加</a>
                        <!-- Cakephp postLink helper does not generate the correct html for the 1st row when it is inside other form -->
                        <?= $this->Form->postLink('Dummy', [], [ 'class' => 'hidden']) ?>
                        <?= $this->Form->postLink(__('削除'), 
                                ['controller' => 'IndicatorWeights', 'action' => 'delete', $indicator_weight->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $indicator_weight->id),
                                    'class' => 'delete-row w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white',
                                    'id' => 'delete-' . $indicator_weight->id
                                ])
                            ?>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center">保存</button>
    <?= $this->Form->end() ?>
</div>

<?= $this->Html->script('analyses_table', array('block' => 'scriptBottom')) ?>
