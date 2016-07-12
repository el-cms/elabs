<?php
$this->assign('title', __d('licenses', 'Licenses'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => ' '];
echo $this->Paginator->sort('name', __d('licenses', 'Real name'), $linkOptions);
echo $this->Paginator->sort('post_count', __d('licenses', 'Number of posts'), $linkOptions);
echo $this->Paginator->sort('project_count', __d('licenses', 'Number of projects'), $linkOptions);
echo $this->Paginator->sort('file_count', __d('licenses', 'Number of files'), $linkOptions);
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
