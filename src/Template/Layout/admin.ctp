<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset() ?>
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="initial-scale=1.0, width=device-width" name="viewport">
    <title>
			<?php echo $this->fetch('title') ?>
    </title>
		<?php echo $this->Html->meta('icon') ?>

		<?php echo $this->Html->css('admin_style.min.css', array('media' => 'screen,projection')) ?>

		<?php echo $this->fetch('meta') ?>
		<?php echo $this->fetch('css') ?>
		<?php echo $this->fetch('script') ?>

		<!-- ie -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="page-red avoid_fout">
		<?php echo$this->element('layout/pageloader') ?>
		<header class="header header-transparent header-waterfall">
			<ul class="nav nav-list pull-left">
				<li>
					<a data-toggle="menu" href="#menu">
						<span class="icon icon-lg">menu</span>
					</a>
				</li>
			</ul>
			<a class="header-logo margin-left-no" href="#">ExperimentsLabs</a>
			<!--			<ul class="nav nav-list pull-right">
							<li>
								<a data-toggle="menu" href="#profile">
									<span class="access-hide">John Smith</span>
									<span class="avatar">avatar</span>
								</a>
							</li>
						</ul>-->
		</header>
		<nav aria-hidden="true" class="menu" id="menu" tabindex="-1">
			<div class="menu-scroll">
				<div class="menu-content">
					<a class="menu-logo" href="#">ExperimentsLabs</a>
					<ul class="nav">
						<li>
							<?php echo $this->Html->link('Home', ['controller' => 'pages', 'action' => 'home'], ['class' => 'waves-attach']) ?>
						</li>
						<li>
							<?php echo $this->Html->link('News', ['controller' => 'pages', 'action' => 'news'], ['class' => 'waves-attach']) ?>
						</li>
						<li>
							<?php echo $this->Html->link('Projects', ['controller' => 'pages', 'action' => 'projects'], ['class' => 'waves-attach']) ?>
						</li>
						<li>
							<?php echo $this->Html->link('Files', ['controller' => 'pages', 'action' => 'files'], ['class' => 'waves-attach']) ?>
						</li>
					</ul>
					<hr>
					<ul class="nav">
						<li>
							<a class="waves-attach" href="#">About</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="content">
			<div class="content-heading">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="heading"><span class="fa fa-wrench"></span>&nbsp;<?php echo $this->fetch('title') ?></h1>
					</div>
				</div>
			</div>
			<div class="row content-body">
				<div class="col-sm-2">
					<div class="card">
						<div class="card-main">
							<div class="card-inner">
								<p class="card-heading"><?php echo __('Actions') ?></p>
								<?php echo $this->fetch('actionMenu', 'empty') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-10">
					<?php echo $this->Flash->render() ?>
					<?php echo $this->fetch('content', 'empty') ?>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<p>© 2015 Elabs</p>
			</div>
			<!--<a class="fbtn fbtn-lg upbtn"><span class="icon">add</span></a>-->
		</footer>
<!--				<div class="fbtn-container">
					<div class="fbtn-inner">
						<a class="fbtn fbtn-red fbtn-lg" data-toggle="dropdown"><span class="fbtn-text">Links</span><span class="fbtn-ori icon">add</span><span class="fbtn-sub icon">close</span></a>
						<div class="fbtn-dropdown">
							<a class="fbtn" href="https://github.com/Daemonite/material" target="_blank"><span class="fbtn-text">Fork me on GitHub</span><span class="fa fa-github"></span></a>
							<a class="fbtn fbtn-blue" href="https://twitter.com/daemonites" target="_blank"><span class="fbtn-text">Follow Daemon on Twitter</span><span class="fa fa-twitter"></span></a>
							<a class="fbtn fbtn-alt" href="http://www.daemon.com.au/" target="_blank"><span class="fbtn-text">Visit Daemon Website</span><span class="icon">link</span></a>
						</div>
					</div>
				</div>-->

		<!-- Javascript at the end -->
		<?php echo $this->Html->script('lib/jquery-1.11.3.min.js') ?>
		<?php echo $this->Html->script('material.min.js') ?>
		<!-- Custom scripts -->
		<?php echo $this->Html->script('custom.js') ?>
	</body>
</html>
