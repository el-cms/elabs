<?php
$this->assign('title', __d('elabs', 'Home'));
?>

<div class="container">
	<section class="content-inner">

		<div class="row">

			<div class="col-sm-4">
				<h2 class="content-sub-heading"><?= __d('elabs', 'Latest news') ?></h2>
				<p>
					<a href="#" class="btn btn-green waves-effect btn-block"><span class="fa fa-arrow-right"></span>&nbsp;<?= __d('elabs', 'All articles') ?></a>
				</p>
				<?= $this->Element('home/last_news'); ?>
			</div>
			<div class="col-sm-4">
				<h2 class="content-sub-heading"><?= __d('elabs', 'Projects updates') ?></h2>
				<p>
					<a href="#" class="btn btn-green waves-effect btn-block"><span class="fa fa-arrow-right"></span>&nbsp;<?= __d('elabs', 'All projects') ?></a>
				</p>
				<?= $this->Element('home/last_projects'); ?>
			</div>
			<div class="col-sm-4">
				<h2 class="content-sub-heading"><?= __d('elabs', 'Files') ?></h2>
				<p>
					<a href="#" class="btn btn-green waves-effect btn-block"><span class="fa fa-arrow-right"></span>&nbsp;<?= __d('elabs', 'All files') ?></a>
				</p>
				<?= $this->Element('home/last_files'); ?>
			</div>

		</div>

	</section>
</div>