<?php
/*
 * File:
 *   src/Templates/Notes/index.ctp
 * Description:
 *   List of notes, sortable and filterable
 * Layout element:
 *   defaultindex.ctp
 */

// Title and breadcrumbs
switch ($filter):
    case 'language':
        $this->assign('title', __d('elabs', 'Notes in "{0}"', $this->Html->langLabel($filterData->name, $filterData->iso639_1, ['label' => false])));
        $this->Html->addCrumb(__d('elabs', 'Languages'), ['controller' => 'Languages', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Languages', 'action' => 'view', $filterData->id], ['lang' => $filterData->iso639_1]);
        break;
    case 'license':
        $this->assign('title', __d('elabs', 'Notes with license "{0}"', $filterData->name));
        $this->Html->addCrumb(__d('elabs', 'Licenses'), ['controller' => 'Licenses', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Licenses', 'action' => 'view', $filterData->id]);
        break;
    case 'user':
        $this->assign('title', __d('elabs', 'Notes by {0}', $filterData->realname));
        $this->Html->addCrumb(__d('elabs', 'Authors'), ['controller' => 'Users', 'action' => 'index']);
        $this->Html->addCrumb($filterData->realname, ['controller' => 'Users', 'action' => 'view', $filterData->id]);
        break;
    default:
        $this->assign('title', __d('elabs', 'Notes list'));
        $this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
endswitch;
$this->Html->addCrumb(__d('elabs', 'Notes list'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('created', __d('elabs', 'Creation date'));
echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="row">
    <?php
    if (!$notes->isEmpty()):
        foreach ($notes as $note):
            echo $this->element('notes/card', ['data' => $note, 'event' => false]);
        endforeach;
    else:
        echo $this->element('layout/empty');
    endif;
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
