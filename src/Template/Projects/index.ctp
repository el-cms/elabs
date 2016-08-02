<?php
/*
 * File:
 *   src/Templates/Projects/index.ctp
 * Description:
 *   List of projects, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Title and breadcrumbs
switch ($filter):
    case 'language':
        $this->assign('title', __d('elabs', 'Projects in "{0}"', $this->Html->langLabel($filterData->name, $filterData->iso639_1, ['label' => false])));
        $this->Html->addCrumb(__d('elabs', 'Languages'), ['controller' => 'Languages', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Languages', 'action' => 'view', $filterData->id], ['lang' => $filterData->iso639_1]);
        break;
    case 'license':
        $this->assign('title', __d('elabs', 'Projects with license "{0}"', $filterData->name));
        $this->Html->addCrumb(__d('elabs', 'Licenses'), ['controller' => 'Licenses', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Licenses', 'action' => 'view', Cake\Utility\Text::slug($filterData->id . '-' . $filterData->name)]);
        break;
    case 'user':
        $this->assign('title', __d('elabs', 'Projects by {0}', $filterData->realname));
        $this->Html->addCrumb(__d('elabs', 'Authors'), ['controller' => 'Users', 'action' => 'index']);
        $this->Html->addCrumb($filterData->realname, ['controller' => 'Users', 'action' => 'view', $filterData->username]);
        break;
    default:
        $this->assign('title', __d('elabs', 'Projects list'));
        $this->Html->addCrumb(__d('elabs ', 'Projects '), ['action' => 'index']);
endswitch;
$this->Html->addCrumb(__d('elabs', 'Projects list'));

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
if (!$projects->isEmpty()):
    foreach ($projects as $project):
        echo $this->element('projects/card', ['data' => $project, 'event' => false]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
