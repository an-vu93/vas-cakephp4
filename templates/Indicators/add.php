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
    <div class="flex mb-5">
            <label for="name" class="mb-2 text-lg font-medium text-gray-900">指標名</label>
            <input type="text" id="name" name="name" class="shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-8" required />
        </div>
    <?= $this->Form->button(__('保存'), ['class' => 'text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center']) ?>
    <?= $this->Form->end() ?>
</div>



