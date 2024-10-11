<?php 
$this->Form->setTemplates([
    'inputContainer' => '{{content}}',  // No wrapping div
]);
?>

<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden mb-10">
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-6">顧客検索</h2>
        <?= $this->Form->create(null, [
            'type' => 'post',
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
        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
            検索条件クリア
        </button>
        <button type="button" class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
            CSV出力
        </button>
    </div>
    
<?= $this->Form->end() ?>
</section>

<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <?php if (!empty($searchData)): ?>
        <h2 class="text-2xl font-semibold mb-6">検索結果</h2>
        <?php if ($results->count() > 0): ?>
            <?php foreach ($results as $customer): ?>
                <div class="p-6">
                    <table id="dynamicTable" class="table-auto w-full border border-white my-5">
                        <thead class="bg-primary-500 text-white">
                            <tr>
                                <th scope="col" class="px-4 py-2 border border-white">
                                    顧客名
                                </th>
                                <th scope="col" class="px-4 py-2 border border-white">
                                    都道府県
                                </th>
                                <th scope="col" class="px-4 py-2 border border-white">
                                    営業の担当
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
                                    VU回数
                                </th>
                                <th scope="col" class="px-4 py-2 border border-white">
                                    お問い合わせの回数
                                </th>
                                <th scope="col" class="px-4 py-2 border border-white">
                                    総合評価
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-primary-50">
                        <tr>
                                <td>
                                    (<?= $customer->id ?>)<?= $customer->name ?>
                                </td>
                                <td>
                                    <?= $customer->prefecture->name ?>
                                </td>
                                <td>
                                <?= $customer->salesperson->name ?>
                                </td>
                                <td>
                                    2015年9月9日
                                </td>
                                <td>
                                    02024年7月9日
                                </td>
                                <td>
                                    15
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    413
                                </td>
                                <td>
                                    3.53
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="flex">
                <h3><?= h($customer->name) ?> (ID: <?= $customer->id ?>)</h3>
                <p>Email: <?= h($customer->email) ?></p>
                <p>prefecture: <?= h($customer->prefecture->name) ?></p>
        
                <h4>Orders:</h4>
                <?php if (!empty($customer->customer_orders)): ?>
                    <ul>
                    <?php foreach ($customer->customer_orders as $order): ?>
                        <li>Order ID: <?= $order->id ?>, Date: <?= $order->order_date ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No orders found for this customer.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
<?php endif; ?>
</section>













