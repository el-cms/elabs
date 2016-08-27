<?php
/*
 * File:
 *   src/Templates/Files/view.ctp
 * Description:
 *   Display of a single file record
 * Layout element:
 *   defaultview.ctp
 */

// Custom helpers
$this->loadHelper('Items');

// Page title
$this->assign('title', $file->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Files'), ['action' => 'index']);
$this->Html->addCrumb($file->name);

// Block: Item informations
// ------------------------
$this->start('pageInfos');
$config = $this->Items->fileConfig($file['filename']);
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Name:') ?></strong> <?php echo h($file->name) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->License->d($file->license, true) ?></li>
    <li><strong><?php echo __d('elabs', 'Creator:') ?></strong> <?php echo $file->has('user') ? $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></li>
    <li><strong><?php echo __d('elabs', 'File size:') ?></strong> <?php echo $file->weight ?></li>
    <li><strong><?php echo __d('elabs', 'Mime type:') ?></strong> <?php echo $file->mime ?></li>
    <li><strong><?php echo __d('elabs', 'Added on:') ?></strong> <?php echo h($file->created) ?></li>
    <?php if ($file->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($file->modified) ?></li>
    <?php endif; ?>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($file->language->name, $file->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe content:') ?></strong> <span class="label label-<?php echo $file->sfw ? 'success' : 'danger'; ?>"><?php echo $file->sfw ? __d('elabs', 'Yes') : __d('elabs', 'No'); ?></span></li>
    <?php
    $nbProj = count($file->projects);
    if ($nbProj > 0):
        ?>
        <li>
            <strong><?php echo __dn('elabs', 'Project:', 'Projects:', $nbProj) ?></strong>
            <?php
            if ($nbProj === 1):
                echo $this->Html->link(h($file->projects[0]->name), ['controller' => 'Projects', 'action' => 'view', $file->projects[0]->id]);
            else:
                ?>
                <ul>
                    <?php foreach ($file->projects as $project):
                        ?>
                        <li><?php echo $this->Html->link(h($project->name), ['controller' => 'Projects', 'action' => 'view', $project->id]) ?></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            <?php
            endif;
            ?>
        </li>
        <?php
    endif;
    ?>
    <li><strong><?php echo __d('elabs', 'Tags:') ?></strong> <?php echo $this->element('layout/dev_inline') ?></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
echo $this->html->link($this->Html->iconT('download', __d('elabs', 'Download')), ['action' => 'download', $file->id], ['escape' => false, 'class' => 'btn btn-block']);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div lang="<?php echo $file->language->iso639_1 ?>">
    <?php echo $this->Html->displayMD($file->description) ?>
    <div class="panel">
        <div class="panel-body">
            <?php echo $this->element('files/view_content_' . $config['element'], ['data' => $file]) ?>
        </div>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
