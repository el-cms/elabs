<?php
// Page title
$this->assign('title', __d('elabs', 'Nope.'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
$this->Html->addCrumb($title);
?>
<h2><?php echo __d('elabs', 'This content is not suitable for everyone.') ?></h2>
<?php
echo __d('elabs', 'If you really want to see it, please click on the "Show NSFW" button in the menu.');
