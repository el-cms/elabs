<table class="table table-condensed">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id') ?></th>
            <th><?php echo $this->Paginator->sort('name') ?></th>
            <th><?php echo $this->Paginator->sort('email') ?></th>
            <th><?php echo $this->Paginator->sort('url') ?></th>
            <th><?php echo $this->Paginator->sort('created') ?></th>
            <th class="actions"><?php echo __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $report): ?>
            <tr>
                <td><?php echo $report->id ?></td>
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
                <td><span class="fa fa-fw fa-<?php echo (!empty($report->email) ? 'check-circle' : 'circle-o') ?>"></span></td>
                <td><?php echo $this->Html->link(h($report->url), h($report->url)) ?></td>
                <td><?php echo h($report->created) ?></td>
                <td class="padding-no">
                    <ul class="margin-no nav nav-list">
                        <li><?php echo $this->Html->link('<span class="fa fa-eye" title="' . __d('admin', 'Full details') . '"></span>', ['action' => 'view', $report->id], ['class' => 'text-sec waves-attach waves-effect', 'escape' => false]) ?></li>
                        <li><?php echo $this->Form->postLink('<span class="fa fa-times" title="' . __d('elabs', 'Delete') . '"></span>', ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'text-sec waves-attach waves-effect', 'escape' => false]) ?></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
echo $this->element('layout/paginationlinks');
