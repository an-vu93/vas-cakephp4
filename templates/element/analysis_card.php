<div class="max-w-screen-xl px-4 2xl:px-0">
    <div class="flex flex-col rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="flex flex-col justify-between h-56 w-full bg-[url('https://flowbite.com/docs/images/examples/image-1@2x.jpg')]">
            <div class="flex justify-between items-center mb-4 p-6">
                <div class="w-6 h-6 flex flex-col justify-around">
                    <div class="h-0.5 bg-gray-500 w-full"></div>
                    <div class="h-0.5 bg-gray-500 w-full"></div>
                    <div class="h-0.5 bg-gray-500 w-full"></div>
                </div>
                <?php if ($record->public_flg): ?>
                    <div class="bg-primary-500 text-white text-xs font-bold py-1 px-2 rounded"><?= __('配信中') ?></div>
                <?php else: ?>
                    <div class="bg-red-500 text-white text-xs font-bold py-1 px-2 rounded"><?= __('下書き') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="flex flex-col text-xt text-gray-500 p-6 mb-2">
                <p><?= __('更新日：{0}', $record->modified->i18nFormat('yyyy年MM月dd日')) ?></p>
                <p><?= __('作成日：{0}', $record->created->i18nFormat('yyyy年MM月dd日')) ?></p>
            </div>
        </div>
        <div class="h-56 p-6">
            <h3 class="text-lg font-semibold leading-tight text-gray-900 hover:underline"><?= __($record->name) ?></h3>
            
            <p class="text-sm text-gray-600 mb-4"><?= __($record->description) ?></p>
            
            <div class="flex justify-between mb-4">
                <div class="flex items-center">
                    <span class="bg-primary-500 text-white text-xs font-bold py-1 px-2 rounded mr-2">解析回数</span>
                    <span class="font-bold">306</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-primary-500 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold">609</span>
                </div>
            </div>
            
            <div class="flex justify-between">
                <?= $this->Html->link(
                    __('編集'), 
                    ['action' => 'edit', $record->id], 
                    ['class' => 'bg-white text-primary-500 border border-primary-500 font-bold py-3 px-4 rounded w-[48%] text-center']
                    ) 
                ?>
                <?= $this->Form->postLink(
                    __('削除'), 
                    ['action' => 'delete', $record->id], 
                    ['confirm' => __('本当に削除しますか # {0}?', $record->id), 
                    'class' => 'bg-white text-primary-500 border border-primary-500 font-bold py-3 px-4 rounded w-[48%] text-center'
                    ]) 
                ?>
            </div>
        </div>
    </div>
</div>

