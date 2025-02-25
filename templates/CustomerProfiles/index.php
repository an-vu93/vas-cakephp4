<?php 
$this->extend('/element/container');
$this->assign('isVisible', false);
$this->assign('title', '顧客プロファイル');

?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
    <table id="dynamicTable" class="table-auto w-full border border-white mt-10 mb-5">
        <thead class="bg-primary-500 text-white">
            <tr>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('customer_id', '顧客名') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('corporate_number', '法人番号') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('hw_business_number', '事業所番号(HW)') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('prefecture_id', '都道府県') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('employee_number', '従業員数') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('capital', '資本金') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('revenue', '年商') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('recruiting_flg', '採用中') ?></th>
                <th scope="col" class="px-4 py-2 border border-white"><?= $this->Paginator->sort('ignore_flg', '無視') ?></th>
                <th scope="col" class="px-4 py-2 border border-white">操作</th>
            </tr>
        </thead>
        <tbody class="bg-primary-50">
            <?php foreach ($customerProfiles as $customerProfile): ?>
            <tr>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->id ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->has('customer') ? $customerProfile->customer->name : '' ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->corporate_number === null ? '' : $customerProfile->corporate_number ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->hw_business_number === null ? '' : $customerProfile->hw_business_number ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->has('prefecture') ? $customerProfile->prefecture->name : '' ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->employee_number === null ? '' : $this->Number->format($customerProfile->employee_number) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->capital === null ? '' : $this->Number->format($customerProfile->capital) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->revenue === null ? '' : $this->Number->format($customerProfile->revenue) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->recruiting_flg === null ? '' : $this->Number->format($customerProfile->recruiting_flg) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $customerProfile->ignore_flg === null ? '' : $this->Number->format($customerProfile->ignore_flg) ?></td>
                <td class="w-20 px-4 py-2 text-center border border-white">
                    <?= $this->Html->link(__('編集'), 
                        ['action' => 'edit', $customerProfile->id],
                        ['class' => 'block w-10 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white']
                    ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?= $this->element('pagination') ?>
</div>
