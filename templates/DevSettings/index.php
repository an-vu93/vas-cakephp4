<?php 
$this->extend('/element/container');
$this->assign('isVisible', false);
$this->assign('title', '開発者メニュー');
?>

<div class="p-8 h-full bg-white border border-gray-200 rounded-lg shadow flex justify-center">
    <div class="flex flex-col md:flex-row gap-8 justify-between max-w-4xl mx-auto">
           
        <div class="w-96">
            <a href="<?= $this->Url->build([
                    'controller' => 'CustomerProfiles',
                    'action' => 'index',
                ]) ?>" 
                class="block p-5 text-base font-medium text-gray-500 rounded-lg bg-primary-100 hover:text-gray-900 hover:bg-primary-200 transition-colors">
                <div class="flex items-center justify-between">
                    <span>顧客プロファイル</span>
                    <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="w-96">
            <a href="<?= $this->Url->build([
                    'controller' => 'ActivityLogs',
                    'action' => 'index',
                ]) ?>" 
                class="block p-5 text-base font-medium text-gray-500 rounded-lg bg-primary-100 hover:text-gray-900 hover:bg-primary-200 transition-colors">
                <div class="flex items-center justify-between">
                    <span>操作ログ</span>
                    <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="w-96">
            <a href="<?= $this->Url->build([
                    'controller' => 'OricohSeries',
                    'action' => 'index',
                ]) ?>" 
                class="block p-5 text-base font-medium text-gray-500 rounded-lg bg-primary-100 hover:text-gray-900 hover:bg-primary-200 transition-colors">
                <div class="flex items-center justify-between">
                    <span>CMSフラグ設定</span>
                    <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</div>






