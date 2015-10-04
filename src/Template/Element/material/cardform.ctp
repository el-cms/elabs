<div class="card">
	<div class="card-main">
		<div class="card-inner margin-bottom-no">
			<p class="card-heading"><?= $title ?></p>
			<div class="card-table">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-condensed">
						<?= $this->fetch('cardTable'); ?>
					</table>
				</div>
			</div>
		</div>
		<div class="card-action">
			<div class="card-action-btn pull-right">
				<ul class="pagination">
					<?= $this->Paginator->prev('<span class="fa fa-angle-left"></span>&nbsp;' . __('previous'), ['escape' => false]) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . '&nbsp;<span class="fa fa-angle-right"></span>', ['escape' => false]) ?>
				</ul>
			</div>
		</div>
	</div>
</div>
