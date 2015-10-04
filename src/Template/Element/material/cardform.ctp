<div class="card">
	<div class="card-main">
		<?= $this->Form->create($model) ?>
		<div class="card-inner">
			<p class="card-heading"><?= $title ?></p>
			<?= $this->fetch('cardFormFields'); ?>
		</div>
		<div class="card-action">
			<div class="card-action-btn pull-left">
				<?= $this->fetch('cardFormButtons'); ?>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
