<?php
/*
 * File:
 *   src/Templates/Admin/Dashboard/index.ctp
 * Description:
 *   Administration - Dashboard
 * Layout element:
 *   --
 */

// Page title
$this->assign('title', __d('elabs', 'Dashboard'));

// Breadcrumbs
$this->Html->addCrumb($this->fetch('title'));

echo $this->element('layout/dev_block');