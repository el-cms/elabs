<div class="card<?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
	<div class="card-side pull-left">
		<span class="card-heading">
			<?php echo $this->Html->link(__d('elabs', 'Read more...'), ['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $this->Number->format($data['id'])], ['class' => 'waves-attach waves-effect btn btn-flat']) ?>
		</span>
	</div>
	<div class="card-main">
		<!-- Header -->
		<div class="card-header">
			<!-- Icon -->
			<div class="card-header-side pull-left">
				<i class="fa fa-cogs fa-3x"></i>
			</div>
			<!-- Title -->
			<div class="card-inner">
				<div class="text-overflow"><?php echo h($data['name']) ?></div>
				<em class="subtitle">
					<?php
					echo __d('elabs', 'Created on: {0}', h($data['created']));
					if ($data['created'] != $data['modified']):
						echo ' - ' . __d('elabs', 'Updated on: {0}', h($data['modified']));
					endif;
					?>
				</em>
			</div>
		</div>
		<!-- Content -->
		<div class="card-inner">
			<p>
				<?php echo $this->Markdown->transform(h($data['short_description'])) ?>
			</p>
		</div>
	</div>
</div>