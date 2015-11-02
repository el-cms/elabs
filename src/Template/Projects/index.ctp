<?php
$this->assign('title', __d('projects', 'Projects'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => 'waves-attach waves-effect'];
?>
<ul class="dropdown-menu nav">
    <li><?php echo $this->Paginator->sort('name', __d('projects', 'Name'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'), $linkOptions) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
if (!$projects->isEmpty()):
    foreach ($projects as $project):
        $item = [
            'fkid' => $project->id,
            'user' => $project['user'],
        ];
        echo $this->element('projects/card', ['data' => $project, 'item' => $item]);

    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
