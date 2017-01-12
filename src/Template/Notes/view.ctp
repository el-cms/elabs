<?php
/*
 * File:
 *   src/Templates/Notes/view.ctp
 * Description:
 *   Display of a single note
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'A note'));

// Language
$this->assign('contentLanguage', $note->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo $this->Html->iconT('user', __d('elabs', 'Author:')) ?></strong> <?php echo $this->Html->link($note->user->username, ['controller' => 'Users', 'action' => 'view', $note->user->id]) ?></li>
    <li><strong><?php echo $this->Html->iconT('copyright', __d('elabs', 'License:')) ?></strong> <?php echo $this->Html->link($this->Html->iconT($note->license->icon, $note->license->name), ['controller' => 'Licenses', 'action' => 'view', $note->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo $this->Html->iconT('language', __d('elabs', 'Language:')) ?></strong> <?php echo $this->Html->langLabel($note->language->name, $note->language->iso639_1) ?></li>
    <li><strong><?php echo $this->Html->iconT('calendar', __d('elabs', 'Created on:')) ?></strong> <?php echo h($note->created) ?></li>
    <?php if ($note->modified != $note->created): ?>
        <li><strong><?php echo $this->Html->iconT('calendar', __d('elabs', 'Updated on:')) ?></strong> <?php echo h($note->modified) ?></li>
    <?php endif; ?>
    <li>
        <strong><?php echo $this->Html->iconT('info', __d('elabs', 'Safe content:')) ?></strong>
        <span class="label label-<?php echo $note->sfw ? 'success' : 'danger'; ?>">
            <?php echo $note->sfw ? $this->Html->iconT('check-circle', __d('elabs', 'Yes')) : $this->Html->iconT('circle-o', __d('elabs', 'No')); ?>
        </span>
    </li>
    <?php
    $nbProj = count($note->projects);
    ?>
    <li class="separator"></li>
    <li>
        <strong><?php echo $this->Html->iconT('cogs', __dn('elabs', 'Project:', 'Projects:', $nbProj)) ?></strong>
        <?php
        if ($nbProj > 0):
            if ($nbProj === 1):
                echo $this->Html->link(h($note->projects[0]->name), ['controller' => 'Projects', 'action' => 'view', $note->projects[0]->id]);
            else:
                ?>
                <ul>
                    <?php foreach ($note->projects as $project):
                        ?>
                        <li><?php echo $this->Html->link(h($project->name), ['controller' => 'Projects', 'action' => 'view', $project->id]) ?></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            <?php
            endif;
        else:
            echo __d('elabs', 'No projects');
        endif;
        ?>
    </li>
    <li class="separator"></li>
    <li>
        <strong><?php echo $this->Html->iconT('tags', __d('elabs', 'Tags:')) ?></strong>
        <?php
        if (count($note->tags) > 0):
            echo $this->Html->arrayToString(array_map(function($tag) {
                        return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                    }, $note->tags));
        else:
            echo __d('elabs', 'No tags');
        endif;
        ?>
    </li>
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div <?php echo $this->Html->langAttr($note->language->iso639_1) ?>>
    <?php echo $this->Html->displayMD($note->text); ?>
</div>
<?php
echo $this->cell('Comments::AddForm', ['authUser' => $authUser]);

$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
