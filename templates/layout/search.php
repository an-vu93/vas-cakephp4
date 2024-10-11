<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['tailwind-built']) ?> 
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="flex flex-col h-screen overflow-hidden">

    <?= $this->element('header') ?>

    <main class="flex flex-1 overflow-hidden">
        <article class="w-full h-full overflow-y-auto bg-slate-100 p-4">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </article>
    </main>

    <footer>
    </footer>
    <?= $this->fetch('scriptBottom') ?>
</body>
</html>
