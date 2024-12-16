<nav class="flex items-center -space-x-px h-8 text-sm">
    <ul class="flex items-center">
        <?= $this->Paginator->first('<< ' . __('最初')) ?>
        <?= $this->Paginator->prev('< ' . __('前')) ?>
        <?= $this->Paginator->numbers([
            'modulus' => 4,
        ]) ?>
        <?= $this->Paginator->next(__('次') . ' >') ?>
        <?= $this->Paginator->last(__('最後') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('ページ {{page}} / {{pages}}、合計 {{count}} 件中 {{current}} 件を表示')) ?></p>
</nav>