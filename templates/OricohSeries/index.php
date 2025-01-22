<?php
$this->extend('/element/container');

$this->assign('title', 'CMSフラグ設定の一覧');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'OricohSeries',
    'action' => 'add',
]));
?>

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow">

    <table id="dynamicTable" class="table-auto w-full border border-white mt-10 mb-5">
        <thead>
        <thead class="bg-primary-500 text-white">
            <tr>
                <th scope="col" class="px-4 py-2 border border-white">
                    ID
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    商品名
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    CMS有無
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    操作
                </th>
            </tr>
        
        <tbody>
            <?php foreach ($oricohSeries as $oricohSeries): ?>
            <tr>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($oricohSeries->id) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $oricohSeries->has('product_type') ? $this->Html->link($oricohSeries->product_type->name, ['controller' => 'ProductTypes', 'action' => 'view', $oricohSeries->product_type->id]) : '' ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($oricohSeries->cms_flg) ?></td>
                <td class="flex justify-evenly px-4 py-2 text-center border border-white">
                    <?= $this->Html->link(__('編集'), 
                        ['action' => 'edit', $oricohSeries->id],
                        ['class' => 'add-row w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white']
                    ) ?>
                    <?= $this->Form->postLink(__('削除'), 
                        ['action' => 'delete', $oricohSeries->id], 
                        [   
                            'class' => 'add-row w-2/5 px-2 py-2 bg-red-500 text-white border border-red-700 text-red-500 rounded hover:bg-red-700 hover:text-white',
                            'confirm' => __('「 {0} 」のCMSフラグを削除しますか?', $oricohSeries->product_type->name)
                        ]
                    )?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?= $this->element('pagination') ?>
</div>
    