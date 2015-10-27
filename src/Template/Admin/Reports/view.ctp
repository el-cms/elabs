<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit Report'), ['action' => 'edit', $report->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Report'), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Reports'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Report'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reports view large-9 medium-8 columns content">
    <h3><?php echo h($report->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Name') ?></th>
            <td><?php echo h($report->name) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Email') ?></th>
            <td><?php echo h($report->email) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Url') ?></th>
            <td><?php echo h($report->url) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($report->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?php echo __('Reason') ?></h4>
        <?php echo $this->Text->autoParagraph(h($report->reason)); ?>
    </div>
    <div class="row">
        <h4><?php echo __('Session') ?></h4>
        <?php echo $this->Text->autoParagraph(h($report->session)); ?>
    </div>
</div>
