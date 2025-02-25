<?php 
$this->extend('/element/container');

$this->assign('title', 'ユーザー管理');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'UserRoles',
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
                    社員番号
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    Eメール
                </th>
                <th scope="col" class="px-4 py-2 border border-white">
                    権限
                </th>
                <?php if (in_array($authUser['user_role'], ['root', 'owner'])): ?>
                <th scope="col" class="px-4 py-2 border border-white">
                    操作
                </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="bg-primary-50">
        <?php foreach ($userRoles as $userRole): ?>
            <tr>
                <td scope="row" class="px-4 py-2 border border-white"><?= $this->Number->format($userRole->id) ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $userRole->employee_number ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $userRole->email ?></td>
                <td scope="row" class="px-4 py-2 border border-white"><?= $userRole->role ?></td>
                
                <?php if (in_array($authUser['user_role'], ['root', 'owner'])): ?>
                <td class="flex justify-evenly px-4 py-2 text-center border border-white">
                    <?= $this->Html->link(__('編集'), 
                            ['action' => 'edit', $userRole->id],
                            ['class' => 'w-2/5 px-2 py-2 bg-white border border-primary-700 text-primary-500 rounded hover:bg-primary-500 hover:text-white']
                    ) ?>
                    <?= $this->Form->postLink(__('削除'), 
                        ['action' => 'delete', $userRole->id], 
                        [   
                            'class' => 'w-2/5 px-2 py-2 bg-red-500 text-white border border-red-700 text-red-500 rounded hover:bg-red-700 hover:text-white',
                            'confirm' => __('「 {0} 」の指標を削除しますか?', $userRole->name)
                        ]
                    )?>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

    <?= $this->element('pagination') ?>
</div>
