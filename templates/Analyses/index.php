<?php 
$this->extend('/element/container');

$this->assign('title', 'ツール一覧');
$this->assign('buttonLink', $this->Url->build([
    'controller' => 'Analyses',
    'action' => 'add',
]))
?>

<div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    <?= $this->element('analysis_card') ?>
    
</div>






