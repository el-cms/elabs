<?php
$this->assign('title', __d('reports', 'Admin/Reports&gt; List'));
?>
<table class="table table-condensed">
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
                    $icon = '<span class="fa fa-fw fa-' . $icon . '"></span>';

                    echo __d('elabs', '{0}&nbsp;{1}', [$icon, $uname]);
                    ?>
                </td>
                <td><span class="fa fa-fw fa-<?php echo ($report->email ? 'check-circle' : 'circle-o') ?>"></span></td>
                <td><?php echo $this->Html->link(h($report->url), h($report->url)) ?></td>
                <td><?php echo h($report->created) ?></td>
                <td class="padding-no">
                    <ul class="margin-no nav nav-list">
                        <li><?php echo $this->Html->link('<span class="fa fa-eye" title="' . __d('admin', 'Full details') . '"></span>', ['action' => 'view', $report->id], ['class' => 'text-sec waves-attach waves-effect', 'escape' => false]) ?></li>
                        <li><?php echo $this->Form->postLink('<span class="fa fa-times" title="' . __d('elabs', 'Delete') . '"></span>', ['action' => 'delete', $report->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $report->id), 'class' => 'text-sec waves-attach waves-effect', 'escape' => false]) ?></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
echo $this->element('layout/paginationlinks');
