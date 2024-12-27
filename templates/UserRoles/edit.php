<?php
$this->extend('/element/container');

$this->assign('title', '権限編集');
$this->assign('buttonText', '← 戻る');
$this->assign('buttonClass', 'bg-red-600 hover:bg-red-700 focus:ring-red-300');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'UserRoles',
    'action' => 'index',
]));
?>


<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
<?= $this->Form->create($userRole, ['class' => 'mx-auto max-w-screen-xl lg:max-w-5xl md:max-w-3xl']) ?>
    
    <?= $this->Form->control('employee_number', [
        'label' => [
            'text' => '社員番号',
            'class' => 'mb-2 text-lg font-medium text-gray-900'
        ],
        'type' => 'number',
        'required' => true,
        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
    ]) ?>

    <?= $this->Form->control('email', [
        'label' => [
            'text' => 'メール　',
            'class' => 'mb-2 text-lg font-medium text-gray-900'
        ],
        'type' => 'email',
        'required' => true,
        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
    ]) ?>

    <?= $this->Form->control('role', [
          'label' => [
              'text' => '権限　　',
              'class' => 'mb-2 text-lg font-medium text-gray-900'
          ],
          'type' => 'select',
          'options' => ['root' => '開発', 'owner' => 'オーナー', 'analyst' => 'アナリスト'],
          'empty' => '権限を選択',
          'required' => true,
          'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
    ]) ?>
               
    <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-10 py-3 text-center">保存</button>
<?= $this->Form->end() ?>

</div>
