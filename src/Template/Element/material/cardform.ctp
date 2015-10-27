<div class="card">
	<div class="card-main">
		<?php echo $this->Form->create($model) ?>
		<div class="card-header">
			<div class="card-inner"><?php echo $title ?></div>
		</div>
		<div class="card-inner">
			<?php echo $this->fetch('cardFormFields'); ?>
		</div>
	</div>
	<div class="card-action">
		<div class="card-action-btn pull-left">
			<?php echo $this->fetch('cardFormButtons'); ?>
		</div>
	</div>
	<?php echo $this->Form->end() ?>
</div>
