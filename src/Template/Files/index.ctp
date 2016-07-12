<?php
$this->assign('title', __d('files', 'Files'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => ' '];
echo $this->Paginator->sort('name', __d('files', 'Name'), $linkOptions);
echo $this->Paginator->sort('created', __d('files', 'Creation date'), $linkOptions);
echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'), $linkOptions);
$this->end();

// Page content
$this->start('pageContent');
if (!$files->isEmpty()):
    foreach ($files as $file):
        echo $this->element('files/card', ['data' => $file, 'event'=>false]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
