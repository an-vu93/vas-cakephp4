<?php
$this->extend('/element/container');

$this->assign('title', '指標編集');
$this->assign('buttonText', '← 戻る');
$this->assign('buttonClass', 'bg-red-600 hover:bg-red-700 focus:ring-red-300');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'OricohSeries',
    'action' => 'index',
]));
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    <?= $this->Form->create($oricohSeries, ['class' => 'mx-auto max-w-screen-xl lg:max-w-5xl md:max-w-3xl']) ?>

    <?= $this->Form->control('nproduct_type_idame', [
            'label' => [
                'text' => '指標名',
                'class' => 'mb-2 text-lg font-medium text-gray-900'
            ],
            'options' => $productTypes,
            'required' => true,
            'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
    ]) ?>

    <div class="flex mb-5 items-center">
        <div class="mr-4 text-lg font-medium text-gray-900">CMSフラグ</div>
        <div class="flex items-center space-x-4">
            <?= $this->Form->radio('cms_flg', [
                ['value' => 1, 'text' => 'はい', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                ['value' => 0, 'text' => 'いいえ', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
            ], [
                'class' => 'flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700',
                'default' => '1',           
            ]) ?>
        </div>
    </div>

    <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center">保存</button>
    <?= $this->Form->end() ?>
</div>