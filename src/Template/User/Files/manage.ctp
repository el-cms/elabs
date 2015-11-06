<?php
$this->assign('title', __d('posts', 'Your files'));

$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
    <li><?= $this->Paginator->sort('name') ?></li>
    <li><?= $this->Paginator->sort('weight') ?></li>
    <li><?= $this->Paginator->sort('created') ?></li>
    <li><?= $this->Paginator->sort('modified') ?></li>
</ul>
<?php
$this->end();

$this->start('pageFiltersMenu');
$options = ['escape' => false];
$active = ['<span class="fa fa-fw fa-check-circle-o"></span>'];
$inactive = ['<span class="fa fa-fw fa-circle-o"></span>'];
$clear = ['<span class="fa fa-fw fa-times"></span>'];


echo $this->Html->link(__d('elabs', '{0}&nbsp;Clear filters', $clear), ['all', 'all'], $options);
?><ul>
    <li>
        <?php
        $icon = ($filterNSFW === 'all') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), ['all', $filterStatus], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterNSFW === 'safe') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Only safe files', $icon), ['safe', $filterStatus], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Only unsafe files', $icon), ['unsafe', $filterStatus], $options);
        ?>
    </li>
</ul>
<hr />
<ul>
    <li>
        <?php
        $icon = ($filterStatus === 'all') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), [$filterNSFW, 'all'], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterStatus === 'locked') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Only locked files', $icon), [$filterNSFW, 'locked'], $options);
        ?>
    </li>
</ul>

<?php
$this->end();

$this->start('pageActionsMenu');
echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-plus"></span>', 'Add a file']), ['action' => 'add'], ['class' => 'btn btn-green waves-attach waves-button waves-effect', 'escape' => false]);
$this->end();

$this->start('pageContent');
if (!$files->isEmpty()):
    ?>

    <div class="tile-wrap" id="tiles-files">
        <?php
        foreach ($files as $file):
            $config = $this->Items->fileConfig($file['filename']);
            echo $this->element('files/tile_userindex', ['tileId' => 'tiles-files', 'file' => $file, 'config'=>$config]);
        endforeach;
        ?>
    </div>

    <?php
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
/*<h3><? = __('Files')
?></h3>
<table cellpadding="0" cellspacing="0">
    <tbody>
<?php foreach ($files as $file): ?>
        <tr>
            <td><?= $this->Number->format($file->id) ?></td>
            <td><?= h($file->name) ?></td>
            <td><?= h($file->filename) ?></td>
            <td><?= $this->Number->format($file->weight) ?></td>
            <td><?= h($file->description) ?></td>
            <td><?= h($file->created) ?></td>
            <td><?= h($file->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $file->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $file->id]) ?>
<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
<?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
</div>
*/