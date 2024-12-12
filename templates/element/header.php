<header>
    <nav class="bg-gray-800 border-gray-200 px-4 lg:px-6 py-3">
        <div class="flex flex-wrap justify-between items-center mx-auto ">
            <a 
                href="<?= $this->Url->build([
                    'controller' => 'Search',
                    'action' => 'index',
                ]) ?>" 
                class="flex items-center"
            >
                <h1 class="self-center text-xl font-semibold whitespace-nowrap text-white py-2 px-4">おりこうブログ（Value Analysis System）</h1>
                <p class="block py-2 pr-4 pl-3 text-white text-sm rounded bg-primary-700 lg:bg-transparent lg:p-0" aria-current="version">Ver.1.0.0</p>
            </a>
            <div class="flex items-center lg:order-2">
                <?php if (!($currentController === 'Users' && $currentAction === 'login')): ?>
                    <?php if(true): ?>
                        <a 
                            href="<?= $this->Url->build([
                                'controller' => 'analyses',
                                'action' => 'index'
                            ]) ?>" 
                            class="text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2">管理画面へ
                        </a>
                    <?php endif; ?>
                        <a href="#" class="text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2">(<?= $loggedInUser->staff_no ?>) <?= $loggedInUser->name ?></a>
                        <?= $this->Form->postLink(
                            'ログアウト',
                            ['controller' => 'Users', 'action' => 'logout'],
                            ['class' => 'bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded', 'confirm' => '本当にログアウトしますか?']
                        ) ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>