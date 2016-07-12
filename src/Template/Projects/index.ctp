<?php
$this->assign('title', __d('projects', 'Projects'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => ' '];
echo $this->Paginator->sort('name', __d('projects', 'Name'), $linkOptions);
echo $this->Paginator->sort('created', __d('elabs', 'Creation date'), $linkOptions);
echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'), $linkOptions);
$this->end();

// Page content
$this->start('pageContent');
if (!$projects->isEmpty()):
    foreach ($projects as $project):
        echo $this->element('projects/card', ['data' => $project, 'event'=>false]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
