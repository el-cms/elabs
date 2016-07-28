<?php
/*
 * File:
 *   src/Templates/Files/index.ctp
 * Description:
 *   List of files, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Files list'));


// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Files'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('name', __d('elabs', 'Name'));
echo $this->Paginator->sort('created', __d('elabs', 'Creation date'));
echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
if (!$files->isEmpty()):
    foreach ($files as $file):
        echo $this->element('files/card', ['data' => $file, 'event'=>false]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
