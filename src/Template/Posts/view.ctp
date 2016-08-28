<?php
/*
 * File:
 *   src/Templates/Posts/view.ctp
 * Description:
 *   Display of a single post
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', h($post->title));

// Language
$this->assign('contentLanguage', $post->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Articles'), ['action' => 'index']);
$this->Html->addCrumb($this->Html->langLabel($post->title, $post->language->iso639_1, ['label' => false]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Author:') ?></strong> <?php echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->Html->link($this->Html->iconT($post->license->icon, $post->license->name), ['controller' => 'Licenses', 'action' => 'view', $post->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($post->language->name, $post->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Publication date:') ?></strong> <?php echo h($post->publication_date) ?></li>
    <?php if ($post->modified != $post->created): ?>
        <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($post->modified) ?></li>
    <?php endif; ?>
    <li>
        <strong><?php echo __d('elabs', 'Safe content:') ?></strong>
        <span class="label label-<?php echo $post->sfw ? 'success' : 'danger'; ?>">
            <?php echo $post->sfw ? $this->Html->iconT('check-circle', __d('elabs', 'Yes')) : $this->Html->iconT('circle-o', __d('elabs', 'No')); ?>
        </span>
    </li>
    <?php
    $nbProj = count($post->projects);
    if ($nbProj > 0):
        ?>
        <li>
            <strong><?php echo __dn('elabs', 'Project:', 'Projects:', $nbProj) ?></strong>
            <?php
            if ($nbProj === 1):
                echo $this->Html->link(h($post->projects[0]->name), ['controller' => 'Projects', 'action' => 'view', $post->projects[0]->id]);
            else:
                ?>
                <ul>
                    <?php foreach ($post->projects as $project):
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
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div lang="<?php echo $post->language->id ?>">
    <?php
    echo $this->Html->displayMD($post->excerpt);
    echo $this->Html->displayMD($post->text);
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
