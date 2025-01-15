<?= $this->Paginator->sort($sortField, [
    'asc' => __($sortText) . ' <svg class="w-4 h-4 text-info ml-2 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>',
    'desc' => __($sortText) . ' <svg class="w-4 h-4 text-info ml-2 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>'
],
['escape' => false]); ?>