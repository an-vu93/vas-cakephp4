<?php 
$this->extend('/element/container');

$this->assign('title', '指標一覧');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'Indicators',
    'action' => 'add',
]));
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">

    <table id="dynamicTable" class="table-auto w-full border border-white mt-10 mb-5">
        <thead class="bg-primary-500 text-white">
            <tr>
                <th scope="col" class="px-4 py-2 border border-white">
                    ID
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    指標名
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    有効
                </th>
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
                <th scope="col" class="px-4 py-2 border border-white">
                    作成日
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    編集日
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    操作
                </th>
            </tr>
        </thead>
        <tbody class="bg-primary-50">
        <?php foreach ($indicators as $indicator): ?>
            <tr>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($indicator->id) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($indicator->name) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($indicator->active) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($indicator->percentile_20) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($indicator->percentile_40) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($indicator->percentile_60) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($indicator->percentile_80) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($indicator->created) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= h($indicator->modified) ?></td>
                <td class="flex justify-evenly px-4 py-2 text-center border border-white">
                    <?= $this->Html->link(__('編集'), 
                        ['action' => 'edit', $indicator->id],
                        ['class' => 'add-row w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white']
                    ) ?>
                    <?= $this->Form->postLink(__('削除'), 
                        ['action' => 'delete', $indicator->id], 
                        [   
                            'class' => 'add-row w-2/5 px-2 py-2 bg-red-500 text-white border border-red-700 text-red-500 rounded hover:bg-red-700 hover:text-white',
                            'confirm' => __('「 {0} 」の指標を削除しますか?', $indicator->name)
                        ]
                    )?>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

    <?= $this->element('pagination') ?>
</div>
