<?php
/*
 * File:
 *   src/Templates/Admin/Reports/view.ctp
 * Description:
 *   Administration - Displays a report
 * Layout element:
 *   adminview.ctp
 */

// Page title
$this->assign('title', h($report->name));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Reports'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));



// Block: Item informations
// ------------------------
$this->start('pageInfos');
// Icon
if ($report->has(['user'])):
    $icon = 'check-circle';
    $uname = $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]);
else:
    $icon = 'circle-o';
    $uname = $report['name'];
endif;
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Source') ?></strong> <?php echo $this->Html->link(h($report->url), h($report->url)) ?></li>
    <li><strong><?php echo __d('elabs', 'Added on') ?></strong> <?php echo h($report->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Author') ?></strong> <?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon($icon), $uname]); ?></li>
    <li><strong><?php echo __d('elabs', 'E-Mail') ?></strong> <?php echo h($report->email) ?></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
?>
<div class="btn-block btn-group btn-group-vertical">
    <?php
    echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('trash-o'), 'Delete']), ['action' => 'delete', $report->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $report->id), 'escape' => false, 'class' => 'btn btn-danger']);
    echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'Reports list']), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']);
    ?>
</div>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <div class="panel-body">
        <h4><?php echo __d('elabs', 'Reason') ?></h4>
        <?php
        echo h($report->reason);
        ?>
        <h4><?php echo __d('elabs', 'Session') ?></h4>
        <pre><?php echo h($report->session); ?></pre>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/adminview');
