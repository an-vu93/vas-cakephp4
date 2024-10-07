<header class="flex flex-wrap justify-between items-center">
    <h2 class="self-center text-xl font-semibold whitespace-nowrap text-black pl-2"><?= h($this->fetch('title')) ?></h2>
    <a href="<?= $this->fetch('buttonLink', '#') ?>" class="<?= $this->fetch('buttonClass', 'bg-primary-600 hover:bg-primary-700 focus:ring-primary-300') ?> text-white focus:ring-2 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">
        <?= $this->fetch('buttonText', '+ 追加する') ?>
    </a>
</header>

<section class="h-full py-8 antialiased md:py-12">
    <div class="overflow-y-auto px-4">
        <?= $this->fetch('content') ?>
    </div>
</section>