<?php
$this->extend('/element/container');

$this->assign('title', '指標追加');
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

        <?= $this->Form->control('short_name', [
            'label' => [
                'text' => '短名　',
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
                 
                    
                    
                </tr>
            </tbody>
        </table>
                  
        <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center">保存</button>
    <?= $this->Form->end() ?>
</div>

</div>
