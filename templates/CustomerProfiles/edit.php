<?php
$this->extend('/element/container');

$this->assign('title', '顧客プロフィール');
$this->assign('buttonText', '← 戻る');
$this->assign('buttonClass', 'bg-red-600 hover:bg-red-700 focus:ring-red-300');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'CustomerProfiles',
    'action' => 'index',
]));

?>
<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    <?= $this->Form->create($customerProfile, ['class' => 'mx-auto max-w-screen-xl lg:max-w-5xl md:max-w-3xl']) ?>
            
        
            
                <?php
                    echo $this->Form->control('customer_id', [
                        'label' => [
                            'text' => '顧客ID',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'type' => 'text',
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                    echo $this->Form->control('prefecture_id', [
                        'label' => [
                            'text' => '都道府県',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'options' => $prefectures, 
                        'empty' => true,
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                    echo $this->Form->control('corporate_number', [
                        'label' => [
                            'text' => '法人番号',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'type' => 'text',
                        'required' => true,
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                    echo $this->Form->control('hw_business_number', [
                        'label' => [
                            'text' => '事務所番号(HW)',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'type' => 'text',
                        'required' => true,
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                    echo $this->Form->control('employee_number', [
                        'label' => [
                            'text' => '従業員数',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'type' => 'number',
                        'required' => true,
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                    echo $this->Form->control('capital', [
                        'label' => [
                            'text' => '資本金',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'type' => 'number',
                        'required' => true,
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                    echo $this->Form->control('revenue', [
                        'label' => [
                            'text' => '年商',
                            'class' => 'mb-2 text-lg font-medium text-gray-900'
                        ],
                        'type' => 'number',
                        'required' => true,
                        'class' => 'shadow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-1/2 p-2.5 ml-12',
                    ]);

                ?>

                <div class="flex mb-5 items-center">
                    <div class="mr-4 text-lg font-medium text-gray-900">採用中</div>
                    <div class="flex items-center space-x-4">
                        <?= $this->Form->radio('ignore_flg', [
                            ['value' => 1, 'text' => '有効', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                            ['value' => 0, 'text' => '無効', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                        ], [
                            'class' => 'flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700',
                            'default' => '1',           
                        ]) ?>
                    </div>
                </div>

                <div class="flex mb-5 items-center">
                    <div class="mr-4 text-lg font-medium text-gray-900">無視</div>
                    <div class="flex items-center space-x-4">
                        <?= $this->Form->radio('ignore_flg', [
                            ['value' => 1, 'text' => '有効', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                            ['value' => 0, 'text' => '無効', 'label' => ['class' => 'border border-gray-200 w-32 py-4 text-sm font-medium text-gray-900'], 'class' => 'w-10 h-4 text-blue-600 bg-gray-100 border-gray-300'],
                        ], [
                            'class' => 'flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700',
                            'default' => '1',           
                        ]) ?>
                    </div>
                </div>

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>

