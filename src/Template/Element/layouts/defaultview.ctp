<div class="col-sm-3">
	<div class="content-sub-heading"><?= __d('elabs', 'Infos') ?></div>
	<?= $this->fetch('pageInfos') ?>
</div>

<div class="col-sm-9 rendered-text">

	<?= $this->fetch('pageContent'); ?>

</div>