<?php
$this->assign('title', __d('licenses', 'Licenses'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => 'waves-attach waves-effect'];
?>
<ul class="dropdown-menu nav">
    <li><?php echo $this->Paginator->sort('name', __d('licenses', 'Real name'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('post_count', __d('licenses', 'Number of posts'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('project_count', __d('licenses', 'Number of projects'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('file_count', __d('licenses', 'Number of files'), $linkOptions) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
?>
<div class="row">
    <?php
    foreach ($licenses as $license):
        echo $this->element('licenses/card', ['license' => $license]);
    endforeach;
    ?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultindex');
