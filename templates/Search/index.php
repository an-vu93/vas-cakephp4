<?php 
$this->Form->setTemplates([
    'inputContainer' => '{{content}}',  // No wrapping div
]);
?>

<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden mb-10">
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-6">顧客検索</h2>
        <?= $this->Form->create(null, [
            'type' => 'get',
        ]) ?>

        <table class="w-full">
        <tr class="flex">
            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('query', [
                    'type' => 'text',
                    'label' => [
                        'text' => '顧客名又はID',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['query'] ?? '',
            ]) ?>
            </td>
            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('prefecture_id', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'label' => [
                        'text' => '都道府県',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['prefecture_id'] ?? '',
                ]) ?>
            </td>
            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('salesperson_id', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'label' => [
                        'text' => '営業担当',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['salesperson_id'] ?? '',
                ]) ?>
            </td>
        </tr>
        <tr class="flex mt-4">
            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('industry_id', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'label' => [
                        'text' => '親業種',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['industry_id'] ?? '',
                ]) ?>
            </td>

            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('sub_industry_id', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'label' => [
                        'text' => '子業種',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['sub_industry_id'] ?? '',
                ]) ?>
            </td>

            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('product_type_id', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'label' => [
                        'text' => 'OB版',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['product_type_id'] ?? '',
                ]) ?>
            </td>
        </tr>
        <tr class="flex mt-4">
            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('employee_number', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'options' => [10 => '10人以上', 100 => '100人以上', 300 => '300人以上', 1000 => '1000人以上'], 
                    'label' => [
                        'text' => '従業員数' . $this->element('tooltip', ['tooltipText' => $dataSourceRef]),
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                        'escape' => false, 
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['employee_number'] ?? '',
                ]) ?>
            </td>

            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('capital', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'options' => [100 => '100万円以上', 1000 => '1000万円以上', 3000 => '3000万円以上', 10000 => '1億万円以上'], 
                    'label' => [
                        'text' => '資本金' . $this->element('tooltip', ['tooltipText' => $dataSourceRef]),
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                        'escape' => false, 
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['capital'] ?? '',
                ]) ?>
            </td>

            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('revenue', [
                    'type' => 'select',
                    'empty' => '-----選択-----',
                    'options' => [100 => '100万円以上', 1000 => '1000万円以上', 3000 => '3000万円以上', 10000 => '1億万円以上'], 
                    'label' => [
                        'text' => '年商' . $this->element('tooltip', ['tooltipText' => $dataSourceRef]),
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                        'escape' => false, 
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['revenue'] ?? '',
                ]) ?>
            </td>
        </tr>
       
        <tr class="flex mt-4">
            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('analysis_id', [
                    'type' => 'select',
                    'label' => [
                        'text' => '解析ツール',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['analysis_id'] ?? '',
                ]) ?>
            </td>
        </tr>
        </table>
    </div>

    <div class="mt-8 flex justify-center space-x-4">
        <button type="submit" class="inline-flex items-center py-2.5 px-5 ms-2 text-sm font-medium text-white bg-primary-700 rounded-lg border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>検索
        </button>
        <?= $this->Html->link(
            '検索条件クリア',
            ['action' => 'index'],
            ['class' => 'px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50']
        ) ?>
        <?= $this->Html->link(
            'CSV出力',
            ['action' => 'export', '?' => $this->request->getQueryParams()],
            ['class' => 'px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50']
        ) ?>
    </div>
    
<?= $this->Form->end() ?>
</section>

<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <?php if (!empty($requestParams)): ?>
    <h2 class="text-2xl font-semibold mb-6">検索結果</h2>

    <div class="p-6">
        <table id="dynamicTable" class="table-auto w-full border border-white my-5">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2 border border-white">
                        <?= $this->Paginator->sort('Customers.id', '顧客ID') ?> 
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        <?= $this->Paginator->sort('Customers.name', '顧客名') ?> 
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        <?= $this->Paginator->sort('Prefectures.id', '都道府県') ?> 
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        最新のOB版

                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        従業員数 
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        資本金
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        年商
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        親業種
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        子業種 
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        最初の受注日
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        最近の受注日
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        OBライセンス数
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        OB以外ライセンス数
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        OBシリーズの受注回数
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        お問い合わせの着信回数
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        お問い合わせの送信回数
                    </th>
                    <?php foreach($indicators as $indicator): ?>
                        <th scope="col" class="px-4 py-2 border border-white">
                        <?= $indicator['name'] ?> (<?= $indicator['weight'] ?>)
                    </th>
                    <?php endforeach; ?>    
                    
                    <th scope="col" class="px-4 py-2 border border-white">
                        総合評価
                    </th>
                </tr>
            </thead>
            <tbody class="bg-primary-50">
            <?php if ($customers->count() > 0): ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td>
                            <?= $customer->id ?>
                        </td>
                        <td>
                            <?= $customer->name ?>
                        </td>
                        <td>
                            <?= $customer->prefecture->name  ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= !empty($customer->customer_orders) 
                                ? $customer->customer_orders[count($customer->customer_orders) - 1]->product_type->name 
                                : 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_profile->employee_number ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_profile->capital ?? 'N/A' ?>
                        </td>
                        <td>
                        <?= $customer->customer_profile->revenue ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_profile->industry->name ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_profile->sub_industry->name ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric?->first_order_date?->i18nFormat('yyyy年MM月dd日') ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric?->last_order_date?->i18nFormat('yyyy年MM月dd日') ?? 'N/A' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric->oricoh_license_count ?? '0' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric->other_license_count ?? '0' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric->order_count ?? '0' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric->in_contact_count ?? '0' ?>
                        </td>
                        <td>
                            <?= $customer->customer_metric->out_contact_count ?? '0' ?>
                        </td>
                        <?php foreach($indicators as $indicator): ?>
                        <th>
                            <?= $customerScores[$customer->id][$indicator['id']] ?? 'NA' ?> 
                        </th>
                        <?php endforeach; ?>    
                        <td>
                            <?= $customerScores[$customer->id]['weightedAverage'] ?? 'NA' ?> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
            </tbody>
        </table>
        <nav class="flex items-center -space-x-px h-8 text-sm">
            <ul class="flex items-center">
                <?= $this->Paginator->first('<< ' . __('最初')) ?>
                <?= $this->Paginator->prev('< ' . __('前')) ?>
                <?= $this->Paginator->numbers([
                    'modulus' => 4,
                ]) ?>
                <?= $this->Paginator->next(__('次') . ' >') ?>
                <?= $this->Paginator->last(__('最後') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('ページ {{page}} / {{pages}}、合計 {{count}} 件中 {{current}} 件を表示')) ?></p>
        </nav>
    </div>
    <?php endif; ?>
</section>













