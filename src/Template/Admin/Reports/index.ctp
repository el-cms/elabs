<?php
/*
 * File:
 *   src/Templates/Admin/Reports/index.ctp
 * Description:
 *   Administration - List of reports, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('reports', 'Admin/Reports&gt; List'));

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('name', __d('reports', 'Author')) ?></th>
                <th><?php echo $this->Paginator->sort('email', __d('elabs', 'E-Mail')) ?></th>
                <th><?php echo $this->Paginator->sort('url', __d('reports', 'source')) ?></th>
                <th><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $report): ?>
                <tr>
                    <td>
                        <?php
                        if ($report->has(['user'])):
                            $icon = 'check-circle';
                            $uname = $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]);
                        else:
                            $icon = 'circle-o';
                            $uname = $report['name'];
                        endif;
                        echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon($icon), $uname]);
                        ?>
                    </td>
                    <td><?php echo $this->Html->icon((!empty($report->email) ? 'check-circle' : 'circle-o')); ?>
                    <td><?php echo $this->Html->link(h($report->url), h($report->url)) ?></td>
                    <td><?php echo h($report->created) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            // See content
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('admin', 'Full details')]), ['action' => 'view', $report->id], ['class' => 'text-sec waves-attach waves-effect', 'escape' => false, 'class' => 'btn btn-primary']);
                            echo $this->Form->postLink($this->Html->icon('times', ['title' => __d('elabs', 'Delete')]), ['action' => 'delete', $report->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $report->id), 'class' => 'btn btn-danger', 'escape' => false]);
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/adminindex');
