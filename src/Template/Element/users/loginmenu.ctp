<nav aria-hidden="true" class="menu menu-right" id="profile" tabindex="-1" style="display: none;">
	<div class="menu-scroll">
		<div class="menu-top">
			<div class="menu-top-info plain">
				<?php echo __('Login') ?>
			</div>
		</div>
		<div class="menu-content text-center plain">
			<span class="fa-stack fa-5x">
				<i class="fa fa-circle-o fa-stack-2x"></i>
				<i class="fa fa-user fa-stack-1x text-brand"></i>
			</span>
			<?php echo $this->element('users/loginform') ?>
		</div>
	</div>
</nav>

