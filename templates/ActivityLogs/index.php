<?php 
$this->extend('/element/container');
$this->assign('isVisible', false);
$this->assign('title', '操作歴史の一覧');
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">

    <table id="dynamicTable" class="table-auto w-full border border-white mt-10 mb-5">
        <thead class="bg-primary-500 text-white">
            <tr>
                <th scope="col" class="px-4 py-2 border border-white">
                    ID
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    社員番号
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    社員名
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    操作種類
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    説明
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    IPアドレス
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    操作日
                </th>
            </tr>
        </thead>
        <tbody class="bg-primary-50">
        <?php foreach ($activityLogs as $activityLog): ?>
            <tr>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($activityLog->id) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($activityLog->employee_number) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($activityLog->employee_name) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($activityLog->type) ?></td>
                <td scope="row" class="px-4 py-2 border border-white max-w-xs break-words"><?= h($activityLog->description) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($activityLog->ip_address) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($activityLog->created) ?></td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

    <?= $this->element('pagination') ?>
</div>
