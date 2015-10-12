<li>
	<?= $this->Html->link('Home', ['controller' => 'pages', 'action' => 'home'], ['class' => 'waves-attach']) ?>
</li>
<li>
	<?= $this->Html->link('News', ['controller' => 'posts', 'action' => 'news'], ['class' => 'waves-attach']) ?>
</li>
<li>
	<?= $this->Html->link('Projects', ['controller' => 'projects', 'action' => 'projects'], ['class' => 'waves-attach']) ?>
</li>
<li>
	<?= $this->Html->link('Files', ['controller' => 'files', 'action' => 'files'], ['class' => 'waves-attach']) ?>
</li>

<!--<div class="dropdown-wrap">
	<div class="dropdown dropdown-inline">-->
<li class="dropdown dropdown-inline">
	<a class="dropdown-toggle-btn btn btn-flat" data-toggle="dropdown">Testing layout<span class="icon margin-left-sm">keyboard_arrow_down</span></a>
	<ul class="dropdown-menu nav">
		<li>
			<?= $this->Html->link('Home', ['controller' => 'pages', 'action' => 'home'], ['class' => 'waves-attach']) ?>
		</li>
		<li>
			<?= $this->Html->link('News', ['controller' => 'pages', 'action' => 'news'], ['class' => 'waves-attach']) ?>
		</li>
		<li>
			<?= $this->Html->link('Projects', ['controller' => 'pages', 'action' => 'projects'], ['class' => 'waves-attach']) ?>
		</li>
		<li>
			<?= $this->Html->link('Files', ['controller' => 'pages', 'action' => 'files'], ['class' => 'waves-attach']) ?>
		</li>
	</ul>
</li>
<!--	</div>
</div>-->