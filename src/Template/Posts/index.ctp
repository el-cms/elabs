<?php
/*
 * File:
 *   src/Templates/Posts/index.ctp
 * Description:
 *   List of posts, sortable and filterable
 * Layout element:
 *   defaultindex.ctp
 */

// Title and breadcrumbs
switch ($filter):
    case 'language':
        $this->assign('title', __d('elabs', 'Articles in "{0}"', $this->Html->langLabel($filterData->name, $filterData->iso639_1, ['label' => false])));
        $this->Html->addCrumb(__d('elabs', 'Languages'), ['controller' => 'Languages', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Languages', 'action' => 'view', $filterData->id], ['lang' => $filterData->iso639_1]);
        break;
    case 'license':
        $this->assign('title', __d('elabs', 'Articles with license "{0}"', $filterData->name));
        $this->Html->addCrumb(__d('elabs', 'Licenses'), ['controller' => 'Licenses', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Licenses', 'action' => 'view', $filterData->id]);
        break;
    case 'user':
        $this->assign('title', __d('elabs', 'Articles by {0}', $filterData->real_name));
        $this->Html->addCrumb(__d('elabs', 'Authors'), ['controller' => 'Users', 'action' => 'index']);
        $this->Html->addCrumb($filterData->real_name, ['controller' => 'Users', 'action' => 'view', $filterData->id]);
        break;
    case 'project':
        $this->assign('title', __d('elabs', 'Articles in project "{0}"', $filterData->name));
        $this->Html->addCrumb(__d('elabs', 'Projects'), ['controller' => 'Projects', 'action' => 'index']);
        $this->Html->addCrumb($filterData->name, ['controller' => 'Projects', 'action' => 'view', $filterData->id]);
        break;
    case 'tag':
        $this->assign('title', __d('elabs', 'Articles tagged with {0}', h($filterData->id)));
        $this->Html->addCrumb(__d('elabs', 'Tags'), ['controller' => 'Tags', 'action' => 'index']);
        $this->Html->addCrumb(h($filterData->id), ['controller' => 'Tags', 'action' => 'view', h($filterData->id)]);
        $showUserInfo = false;
        break;
    default:
        $this->assign('title', __d('elabs', 'Articles list'));
        $this->Html->addCrumb(__d('elabs', 'Articles'), ['action' => 'index']);
endswitch;
$this->Html->addCrumb(__d('elabs', 'Articles list'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('title', __d('elabs', 'Title'));
echo $this->Paginator->sort('publication_date', __d('elabs', 'Publication date'));
echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="row">
    <?php
    if (!$posts->isEmpty()):
        foreach ($posts as $post):
            echo $this->element('posts/card', ['data' => $post, 'event' => false]);
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
