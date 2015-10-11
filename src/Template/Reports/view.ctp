<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Report'), ['action' => 'edit', $report->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Report'), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reports view large-9 medium-8 columns content">
    <h3><?= h($report->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($report->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($report->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($report->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($report->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reason') ?></h4>
        <?= $this->Text->autoParagraph(h($report->reason)); ?>
    </div>
    <div class="row">
        <h4><?= __('Session') ?></h4>
        <?= $this->Text->autoParagraph(h($report->session)); ?>
    </div>
</div>
