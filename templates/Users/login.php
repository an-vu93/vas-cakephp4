<div class="flex items-center justify-center min-h-full bg-gray-100">
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-md">
        <?= $this->Flash->render() ?>
        <h3 class="text-lg font-semibold text-center text-gray-700">ログイン</h3>
        <h4 class="text-center">（会社の個人メールとパスワード）</h4>
        <?= $this->Form->create(null, ['class' => 'mt-4']) ?>
        <div class="mb-4">
            <?= $this->Form->control('username', [
                'label' => 'ログインID',
                'class' => 'block w-9/12 px-4 py-2 ml-8 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring',
                'required' => true
            ]) ?>
        </div>
        <div class="mb-4">
            <?= $this->Form->control('password', [
                'label' => 'パスワード',
                'type' => 'password',
                'class' => 'block w-9/12 px-4 py-2 ml-8 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring',
                'required' => true
            ]) ?>
        </div>
        <div class="mt-6">
            <?= $this->Form->button(__('ログイン'), [
                'type' => 'submit',
                'class' => 'w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600'
            ]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
