<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden mb-10">
    <div class="p-6">
    <h2 class="text-2xl font-semibold mb-6">企業の情報調査</h2>
        <?= $this->Form->create(null, [
            'type' => 'get',
        ]) ?>

    </div>

    <div class="flex justify-center">
        <div class="w-2/3">
        

            <?= $this->Form->control('corporate_number', [
                'type' => 'text',
                'label' => [
                    'text' => '法人番号',
                    'class' => 'font-medium bg-primary-500 text-white w-1/4',
                ],
                'class' => 'shadow w-3/4 bg-gray-50 text-gray-900 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 p-2.5',
                'value' => $requestParams['query'] ?? '',
            ]) ?>
        </div>
    </div>

    <div class="mt-8 flex justify-center space-x-4">
        <button type="submit" class="inline-flex items-center py-2.5 px-5 ms-2 text-sm font-medium text-white bg-primary-700 rounded-lg border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>検索
        </button>
    </div>
    <?= $this->Form->end() ?>
</section>

<section class="mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <?php if (!empty($corporation)): ?>
    <div class= "p-6">
        <h2 class="text-2xl font-semibold mb-6">検索結果</h2>
        <div>
            <div><?= $corporation->name ?></div>
            <div><?= $corporation->prefecture_name ?></div>
            <div><?= $corporation->city_name ?></div>
            <div><?= $corporation->street_number ?></div>
            <div><?= $corporation->homepage ?></div>
            <div><?= $corporation->number_of_employees ?></div>
            <div><?= $corporation->capital ?></div>
            <div><?= $corporation->revenue ?></div>
        </div>
    </div>
    <?php endif; ?>
</section>