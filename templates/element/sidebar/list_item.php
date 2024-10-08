<li>
    <a href="<?= $link ?>" class="flex items-center p-2 rounded-lg <?= $this->request->getRequestTarget() == str_replace($this->request->getAttribute('base'), '', $link) ? 'text-white bg-primary-200 cursor-not-allowed' : 'text-gray-900 hover:bg-primary-100' ?>">
        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <?= $icon; ?> 
        </svg>
        <span class="ms-3"><?= $text ?></span>
    </a>
</li>

