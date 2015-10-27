<div class="row">
	<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="card">
			<div class="card-main">
				<div class="card-header">
					<div class="card-inner">
						<?php echo __('Register') ?>
					</div>
				</div>
				<div class="card-inner">
					<div class="row">
						<div class="col-xs-2 text-center">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle-o fa-stack-2x"></i>
								<i class="fa fa-user-plus fa-stack-1x text-brand"></i>
							</span>
						</div>
						<div class="col-xs-10">
							<?php echo $this->element('users/manifest') ?>
						</div>
					</div>
					<?php echo $this->element('users/registerform') ?>
				</div>
			</div>
		</div>
	</div>
</div>

