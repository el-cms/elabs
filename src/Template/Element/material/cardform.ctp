<div class="card">
	<div class="card-main">
		<?= $this->Form->create($model) ?>
		<div class="card-header">
			<div class="card-inner"><?= $title ?></div>
		</div>
		<div class="card-inner">
			<?= $this->fetch('cardFormFields'); ?>
		</div>
	</div>
	<div class="card-action">
		<div class="card-action-btn pull-left">
			<?= $this->fetch('cardFormButtons'); ?>
		</div>
	</div>
	<?= $this->Form->end() ?>
</div>
