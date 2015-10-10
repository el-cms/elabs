<nav aria-hidden="true" class="menu menu-right" id="profile" tabindex="-1" style="display: none;">
	<div class="row">
		<div class="col-sm-4 pull-right">
			<div class="card">
				<div class="card-main">
					<div class="card-header">
						<div class="card-inner"><?= __('Login') ?></div>
					</div>
					<div class="card-inner">
						<div class="text-center">
							<span class="fa-stack fa-5x">
								<i class="fa fa-circle-o fa-stack-2x"></i>
								<i class="fa fa-user fa-stack-1x text-brand"></i>
							</span>
						</div>
						<?= $this->element('users/loginform') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>

