<?php
/*
 * Album:
 *   src/Templates/Album/view.ctp
 * Description:
 *   Display of a single album record
 * Layout element:
 *   defaultview.ctp
 */

// Custom helpers
$this->loadHelper('Items');

// Page title
$this->assign('title', $album->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Albums'), ['action' => 'index']);
$this->Html->addCrumb($album->name);

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo $this->Html->iconT('font', __d('elabs', 'Name:')) ?></strong> <?php echo h($album->name) ?></li>
    <li><strong><?php echo $this->Html->iconT('user', __d('elabs', 'Creator:')) ?></strong> <?php echo $album->has('user') ? $this->Html->link($album->user->username, ['controller' => 'Users', 'action' => 'view', $album->user->id]) : '' ?></li>
    <li><strong><?php echo $this->Html->iconT('calendar', __d('elabs', 'Added on:')) ?></strong> <?php echo h($album->created) ?></li>
    <?php if ($album->modified != $album->created): ?>
        <li><strong><?php echo $this->Html->iconT('calendar', __d('elabs', 'Updated on:')) ?></strong> <?php echo h($album->modified) ?></li>
    <?php endif; ?>
    <li><strong><?php echo $this->Html->iconT('language', __d('elabs', 'Language:')) ?></strong> <?php echo $this->Html->langLabel($album->language->name, $album->language->iso639_1) ?></li>
    <li><strong><?php echo $this->Html->iconT('info', __d('elabs', 'Safe content:')) ?></strong> <span class="label label-<?php echo $album->sfw ? 'success' : 'danger'; ?>"><?php echo $album->sfw ? __d('elabs', 'Yes') : __d('elabs', 'No'); ?></span></li>
    <?php
    $nbProj = count($album->projects);
    ?>
    <li class="separator"></li>
    <li>
        <strong><?php echo $this->Html->iconT('cogs', __dn('elabs', 'Project:', 'Projects:', $nbProj)) ?></strong>
        <?php
        if ($nbProj > 0):
            if ($nbProj === 1):
                echo $this->Html->link(h($album->projects[0]->name), ['controller' => 'Projects', 'action' => 'view', $album->projects[0]->id]);
            else:
                ?>
                <ul>
                    <?php foreach ($album->projects as $project):
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
        if (count($album->tags) > 0):
            echo $this->Html->arrayToString(array_map(function($tag) {
                        return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                    }, $album->tags));
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
<div<?php echo $this->Html->langAttr($album->language->iso639_1) ?>>
    <?php
    echo $this->Html->displayMD($album->description);
    ?>
    <div class="row">
        <?php
        if (count($album->files) > 0):
            foreach ($album->files as $file):
                $config = $this->Items->fileConfig($file['filename']);
                ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 thumbnail-col">
                    <div class="thumbnail thumbnail-square">
                        <?php
                        if ($file->sfw || $seeNSFW === true):
                            echo $this->element('files/card_minimal_' . $config['element'], ['data' => $file]);
                        else:
                            echo $this->element('layout/nsfw_block');
                        endif;
                        ?>
                    </div>
                </div>
                <?php
            endforeach;
        else:
            echo $this->element('layout/empty');
        endif;
        ?>
    </div>
</div>
<?php
echo $this->cell('Comments::AddForm', ['authUser' => $authUser]);
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
