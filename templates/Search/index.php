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

            <td class="flex w-1/3 border-none p-0">
                <?= $this->Form->control('min_score', [
                    'type' => 'number',
                    'label' => [
                        'text' => '最低点数',
                        'class' => 'font-medium bg-primary-500 text-white w-1/4',
                        'escape' => false, 
                    ],
                    'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                    'value' => $requestParams['min_score'] ?? '',
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
    <div class= "p-6">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold mb-6">検索結果</h2>
            <div class="flex">
                <div class="flex items-center me-4">
                    <input 
                        id="company-info" 
                        type="checkbox" 
                        value="" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600"
                        onclick="toggleColumnVisibility(this, 'company-info')"
                    >
                    <label for="company-info" class="ms-2 text-sm font-medium text-gray-900">企業情報</label>
                </div>
           </div>

        </div>
        <?= $this->element('pagination') ?>
        <table id="dynamicTable" class="table-auto w-full border border-white my-5">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'Customers.id',
                            'sortText' => '顧客ID',
                        ]); ?>
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'Customers.name',
                            'sortText' => '顧客名',
                        ]); ?>
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        求人確認
                    </th>

                    <th scope="col" class="px-4 py-2 border border-white">
                        注意事項
                    </th>
                    
                    
                    <th scope="col" class="px-4 py-2 border border-white">
                        製品情報

                    </th>
                 
                    <th scope="col" class="company-info hidden px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'Prefectures.id',
                            'sortText' => '都道府県',
                        ]); ?>
                    </th>
                    <th scope="col" class="company-info hidden px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'CustomerProfiles.employee_number',
                            'sortText' => '従業員数',
                        ]); ?>
                    </th>
                    <th scope="col" class="company-info hidden px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'CustomerProfiles.capital',
                            'sortText' => '資本金',
                        ]); ?>
                    </th>
                    <th scope="col" class="company-info hidden px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'CustomerProfiles.revenue',
                            'sortText' => '年商',
                        ]); ?>
                        
                    </th>
                    <th scope="col" class="company-info hidden px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'CustomerProfiles.industry_id',
                            'sortText' => '親業種',
                        ]); ?>
                    </th>    
                       
                    <th scope="col" class="px-4 py-2 border border-white">
                        メトリクス
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        指標別の点数
                    </th>
                    <th scope="col" class="px-4 py-2 border border-white">
                        <?= $this->element('sort_field', [
                            'sortField' => 'Customers.weighted_avg_score',
                            'sortText' => '総合評価',
                        ]); ?>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-primary-50">
            <?php if ($customers->count() > 0): ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <?= $customer->id ?>
                        </td>
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <div>
                                <a 
                                    href="<?= $customer->customer_profile->homepage ?? '#' ?>" 
                                    class="<?= $customer->customer_profile->homepage ? 'inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline' : '' ?>">
                                        <?= $customer->name ?>
                                </a>
                            </div>
                        </td>
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <?php if($customer->customer_profile->corporate_number): ?>
                                <a 
                                    class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
                                    data-title="<?= $customer->name ?>"
                                    data-description="<?= $customer->name ?>様のメトリクス"
                                    data-customer-id="<?= $customer->id ?>"
                                    data-hw-business-number="<?= $customer->customer_profile->hw_business_number ?>"
                                    data-corporate-number="<?= $customer->customer_profile->corporate_number ?>"
                                    onclick="openModal(this, checkHellowork)"
                                >
                                    詳細
                                </a>
                            <?php if ($customer->customer_profile->hw_business_number): ?>
                                <div>
                                    <span class="bg-green-500 text-white">過去あり</span>
                                </div>
                            <?php endif; ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                            
                        </td>

                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <a 
                                data-title="<?= $customer->name ?>"
                                data-description="<?= $customer->name ?>注意事項"
                                data-remarks="<?= h('一般注意事項@@@'. ($customer->remarks ?? '')) ?>"
                                data-support-remarks="<?= h('CS注意事項@@@'. ($customer->support_remarks ?? '')) ?>"
                                data-support-memo="<?= h('CS対応メモ@@@'.($customer->support_memo ?? '')) ?>"
                                onclick="openModal(this, displayData)"
                                class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
                                >
                                詳細
                            </a>
                        </td>
                       
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <ul>
                                <?php 
                                if (!empty($customer->customer_products)):
                                    foreach ($customer->customer_products as $customer_product):
                                ?>
                                    <li>
                                        <a 
                                            href="<?= 'http://192.168.0.31/in_house/tech_manager/goods/add/' . $customer->id . '/' . $customer_product->id ?>" 
                                            target="_blank"
                                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"    
                                        >
                                            <?= $customer_product->product_type->short_name ?>
                                        </a>
                                        <?php if ($customer_product->cancel_flg == 0): ?>
                                            <span class="bg-primary-500 text-white">契約中</span>
                                        <?php elseif ($customer_product->cancel_flg == 1): ?>
                                            <span class="bg-red-500 text-white">キャンセル</span>
                                        <?php else: ?>
                                            <span class="bg-red-500 text-white">解約</span>
                                        <?php endif; ?>
                                        <?php if ($customer_product->shift_goods_flg == 1): ?>
                                            <span class="bg-red-500 text-white">移行</span>
                                        <?php endif; ?>
                                    </li>
                                <?php 
                                endforeach;
                                endif;
                                ?>
                            </ul>
                        </td>

                        <td scope="row" class="company-info hidden px-4 py-2 border border-white text-center">
                            <?= $customer->prefecture->name  ?? 'N/A' ?>
                        </td>
                        <td scope="row" class="company-info hidden px-4 py-2 border border-white text-center">
                            <?= $customer->customer_profile->employee_number ?? 'N/A' ?>
                        </td>
                        <td scope="row" class="company-info hidden px-4 py-2 border border-white text-center">
                            <?= $customer->customer_profile->capital ? $this->Number->format($customer->customer_profile->capital) : 'N/A' ?>
                        </td>
                        <td scope="row" class="company-info hidden px-4 py-2 border border-white text-center">
                            <?= $customer->customer_profile->revenue ? $this->Number->format($customer->customer_profile->revenue) : 'N/A' ?>
                        </td>
                        <td scope="row" class="company-info hidden px-4 py-2 border border-white text-center">
                            <?= $customer->customer_profile->industry->name ?? 'N/A' ?>
                        </td>
                        
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <a 
                                data-title="<?= $customer->name ?>"
                                data-description="<?= $customer->name ?>様のメトリクス"
                                data-first-order-date="<?= '最初の受注日@@@' . ($customer->customer_metric->first_order_date ?? '') ?>"
                                data-last-order-date="<?= '最近の受注日@@@' . ($customer->customer_metric->last_order_date ?? '') ?>"
                                data-order-count="<?= '受注回数（保守のみを除く）@@@' . ($customer->customer_metric->order_count ?? '') ?>"
                                data-oricoh-license-count="<?= 'OBライセンス数@@@' . ($customer->customer_metric->oricoh_license_count ?? '') ?>"
                                data-other-license-count="<?= 'OB以外のライセンス数@@@' . ($customer->customer_metric->other_license_count ?? '') ?>"
                                data-verup-count="<?= 'バージョンアップ回数@@@' . ($customer->customer_metric->verup_count ?? '') ?>"
                                data-in-contact-count="<?= 'お問い合わせの着信回数@@@' . ($customer->customer_metric->in_contact_count ?? '') ?>"
                                data-out-contact-count="<?= 'お問い合わせの送信回数@@@' . ($customer->customer_metric->out_contact_count ?? '') ?>"
                                data-total-order-amount="<?= '受注金額合計@@@' . ($this->Number->format($customer->customer_metric->all_order_amount) ?? '') . '円' ?>"
                                data-option-included-order-count="<?= 'オプションを含め製品数@@@' . ($customer->customer_metric->option_included_order_count ?? '') ?>"
                                data-option-weekly-login-count="<?= '週間ログイン回数@@@' . ($customer->customer_metric->week_login_count ?? '0') ?>"
                                data-option-weekly-edit-count="<?= '週間編集回数@@@' . ($customer->customer_metric->week_edit_count ?? '0') ?>"
                                data-option-relationship-strength="<?= '顧客関係力@@@' . ($relationshipStatuses[$customer->customer_metric->relationship_strength] ?? '') ?>"
                    
                                onclick="openModal(this, displayData)"
                                class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                詳細
                            </a>
                        </td>
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <a 
                                data-title="<?= $customer->name ?>"
                                data-description="<?= $customer->name ?>様の指標別の点数"
                                <?php foreach($customer->customer_scores as $customer_score): 
                                    if (in_array($customer_score->indicator_id, $activeIndicatorIds)): 
                                ?>
                                    data-indicator-<?= $customer_score->indicator_id ?>="<?= $indicators[$customer_score->indicator_id] . '@@@' . ($customer_score->indicator_score ?? '') ?>"
                                        <?php endif; ?>
                                <?php endforeach; ?>
                                onclick="openModal(this, displayData)"
                                class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                詳細
                            </a>
                        </td>
                        <td scope="row" class="px-4 py-2 border border-white text-center">
                            <?= $customer->weighted_avg_score ?> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <p>該当の顧客情報が見つかりません！</p>
            <?php endif; ?>
            </tbody>
        </table>
        <?= $this->element('pagination') ?>
    </div>
    <?php endif; ?>
</section>

<div id="modalContainer" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-lg max-h-96 w-full mx-4 overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitle" class="text-xl font-bold">Details</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="mt-4">
        </div>
    </div>
</div>

<script>
async function openModal(button, setFunction) {
    
    const title = button.getAttribute('data-title');
    document.getElementById('modalTitle').textContent = title;
    
    // Wait for the setFunction to complete
    await setFunction(button);

    // Show modal
    document.getElementById('modalContainer').classList.remove('hidden');
    
    // Prevent body scrolling
    document.body.style.overflow = 'hidden';
}

function closeModal() {

    document.getElementById('modalContainer').classList.add('hidden');
    document.getElementById('modalContent').innerHTML = "";
    
    // Restore body scrolling
    document.body.style.overflow = 'auto';
}

function displayData(button) {
    const modalContent = document.getElementById('modalContent');
    
    modalContent.innerHTML = '';
    
    const dataAttributes = button.dataset;

    for (const [key, value] of Object.entries(dataAttributes)) {
        if (key === "title")
            continue
        if (key === "description") {
            modalContent.innerHTML += `<p class="mb-4">${value}</p>`;
            continue
        }
        
        const [label, content] = value.split("@@@");
        
        modalContent.innerHTML += `<p><span class="font-bold">${label}：</span><span class="whitespace-pre-wrap">${content}</span></p>`;
    }
}


/**
 * Toggles the visibility of table columns based on checkbox state.
 * @param {HTMLInputElement} checkbox - The checkbox element.
 * @param {string} className - The class of the columns to toggle.
 */
function toggleColumnVisibility(checkbox, className) {
    const elements = document.querySelectorAll(`.${className}`);
    elements.forEach(element => {
        if (checkbox.checked) {
            element.classList.remove('hidden'); 
        } else {
            element.classList.add('hidden'); 
        }
    });
}


async function checkHellowork(button) {
    // Extract data attributes from the clicked element
    const customerId = button.getAttribute('data-customer-id');
    const hwBusinessNumber = button.getAttribute('data-hw-business-number');
    const corporateNumber = button.getAttribute('data-corporate-number');

    const params = new URLSearchParams({
        customer_id: customerId,
        corporate_number: corporateNumber,
    });

    const url = `/python-app/check-hellowork2?${params.toString()}`;
    
    // Show loading state
    modalContent.innerHTML = `<p>データを取得中です...</p>`;

    try {
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const json = await response.json();

        // Build modal content
        let content = `<p><span class="font-bold">現在求人件数：</span><span>${json.data["number_of_job_openings"]}</span></p>`;
        
        const jobTypeInfoTemplate = (jobType, targetContent) => {
            if (json.errors[jobType["key"]].length === 0) {
           
                detail_url = "";
                if (json.data["job_type"][jobType["key"]]["detail_url"] !== "") {
                    detail_url = `<a 
                            href="${json.data["job_type"][jobType["key"]]["detail_url"]}"
                            action="_blank"
                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
                        >
                            （参照先）
                        </a>`
                } 

                targetContent += `<p><span class="font-bold">・うちの${jobType["value"]}件数：</span><span>${json.data["job_type"][jobType["key"]]["count"]}</span>${detail_url}</p>`;
                targetContent += `<p><span class="font-bold ml-6">給料レンジ：</span></p>`;
                targetContent += `<p><span class="font-bold ml-8">上レンジ：</span><span>${json.data["job_type"][jobType["key"]]["salary_range"]["higher_range"]}</span></p>`;
                targetContent += `<p><span class="font-bold ml-8">下レンジ：</span><span>${json.data["job_type"][jobType["key"]]["salary_range"]["lower_range"]}</span></p>`;
            } else {
                targetContent += `<p><span class="font-bold">・うちの${jobType["value"]}件数：</span><span>${json.data["job_type"][jobType["key"]]["count"]}</span></p>`;
            }
      

            return targetContent;
        }
        
        content = jobTypeInfoTemplate({key: "fulltime", value:"フルタイム"}, content);
        content = jobTypeInfoTemplate({key: "parttime", value:"パート"}, content);
        
        // Update modal content
        modalContent.innerHTML = content;

    } catch (error) {
        console.error('Error fetching data:', error);
        modalContent.innerHTML = `<p>データの取得中にエラーが発生しました。</p>`;
    }
}
</script>