<?php
/*
 * File:
 *   src/Templates/User/Dashboard/index.ctp
 * Description:
 *   Dashboard for the user
 * Layout element:
 *   --
 */

// Page title
$this->assign('title', __d('elabs', 'Dashboard'));

// Breadcrumbs
$this->Html->addCrumb($this->fetch('title'));

echo $this->element('layout/dev_block');