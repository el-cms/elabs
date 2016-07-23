<?php
/*
 * File:
 *   src/Templates/Users/index.ctp
 * Description:
 *   List of users, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('users', 'Authors'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Authors'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderMenu');
echo $this->Paginator->sort('realname', __d('users', 'Real name'));
echo $this->Paginator->sort('username', __d('users', 'User name'));
echo $this->Paginator->sort('created', __d('users', 'Join date'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="row">
    <?php
    foreach ($users as $user):
        echo $this->element('users/card', ['user' => $user]);
    endforeach;
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
