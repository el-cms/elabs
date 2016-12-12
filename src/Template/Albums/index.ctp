<?php
/*
 * Album:
 *   src/Templates/Albums/index.ctp
 * Description:
 *   List of albums, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Title and breadcrumbs
switch ($filter):
    case 'language':
        $this->assign('title', __d('elabs', 'Albums in "{0}"', $this->Html->langLabel($filterData->name, $filterData->iso639_1, ['label' => false])));
        $this->Html->addCrumb(__d('elabs', 'Languages'), ['controller' => 'Languages', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Languages', 'action' => 'view', $filterData->id], ['lang' => $filterData->iso639_1]);
        break;
    case 'license':
        $this->assign('title', __d('elabs', 'Albums with license "{0}"', $filterData->name));
        $this->Html->addCrumb(__d('elabs', 'Licenses'), ['controller' => 'Licenses', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Licenses', 'action' => 'view', $filterData->id]);
        break;
    case 'user':
        $this->assign('title', __d('elabs', 'Albums by {0}', $filterData->realname));
        $this->Html->addCrumb(__d('elabs', 'Authors'), ['controller' => 'Users', 'action' => 'index']);
        $this->Html->addCrumb($filterData->realname, ['controller' => 'Users', 'action' => 'view', $filterData->id]);
        break;
    default:
        $this->assign('title', __d('elabs', 'Albums list'));
        $this->Html->addCrumb(__d('elabs', 'Albums'), ['action' => 'index']);
endswitch;
$this->Html->addCrumb(__d('elabs', 'Albums list'));

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
if (!$albums->isEmpty()):
    foreach ($albums as $album):
        echo $this->element('albums/card', ['data' => $album, 'event' => false]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();


// Additionnal JS
// --------------
$this->Html->script('scrollbar',['block'=>'pageBottomScripts']);

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');