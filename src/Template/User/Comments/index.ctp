<?php

/*
 * File:
 *   src/Templates/User/Comments/index.ctp
 * Description:
 *   List of comments, sortable and filterable
 * Layout element:
 *   defaultindex.ctp
 */

// Additionnal helpers
$this->loadHelper('Items');
$this->loadHelper('Time', ['className' => 'ElabsTime']);

// Page title
$this->assign('title', __d('elabs', 'Comments'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Comments'));

// Block: Page content
// -------------------
$this->start('pageContent');
if (!$comments->isEmpty()):
    foreach ($comments as $comment):
        echo $this->element('comments/card', ['data' => $comment]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
