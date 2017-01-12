<?php
/*
 * File:
 *   src/Templates/Projects/view.ctp
 * Description:
 *   Display of a single project
 * Layout element:
 *   defaultview.ctp
 */

use Cake\Core\Configure;

// Page title
$this->assign('title', h($project->name));

// Language
$this->assign('contentLanguage', $project->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Projects'), ['action' => 'index']);
$this->Html->addCrumb($this->Html->langLabel($project->name, $project->language->iso639_1, ['label' => false]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo $this->Html->iconT('user', __d('elabs', 'Author:')) ?></strong><?php echo $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) ?></li>
    <li><strong><?php echo $this->Html->iconT('font', __d('elabs', 'Name:')) ?></strong> <?php echo $project->name ?></li>
    <li><strong><?php echo $this->Html->iconT('copyright', __d('elabs', 'License:')) ?></strong> <?php echo $this->Html->link($this->Html->iconT($project->license->icon, $project->license->name), ['controller' => 'Licenses', 'action' => 'view', $project->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo $this->Html->iconT('calendar', __d('elabs', 'Created on:')) ?></strong> <?php echo h($project->created) ?></li>
    <?php if ($project->has('modified')): ?>
        <li><strong><?php echo $this->Html->iconT('calendar', __d('elabs', 'Updated on:')) ?></strong> <?php echo h($project->modified) ?></li>
<?php endif; ?>
    <li><strong><?php echo $this->Html->iconT('language', __d('elabs', 'Language:')) ?></strong> <?php echo $this->Html->langLabel($project->language->name, $project->language->iso639_1) ?></li>
    <li>
        <strong><?php echo $this->Html->iconT('info', __d('elabs', 'Safe content:')) ?></strong>
        <span class="label label-<?php echo $project->sfw ? 'success' : 'danger'; ?>">
<?php echo $project->sfw ? $this->Html->iconT('check-circle', __d('elabs', 'Yes')) : $this->Html->iconT('circle-o', __d('elabs', 'No')); ?>
        </span>
    </li>
    <li class="separator"></li>
    <li><strong><?php echo $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $project->post_count, [$project->post_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('sticky-note', __dn('elabs', '{0} note', '{0} notes', $project->note_count, $project->note_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('file-o', __dn('elabs', '{0} file', '{0} files', $project->file_count, $project->file_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('book', __dn('elabs', '{0} album', '{0} albums', $project->album_count, $project->album_count)) ?></strong></li>
    <li class="separator"></li>
    <li>
        <strong><?php echo $this->Html->iconT('tags', __d('elabs', 'Tags:')) ?></strong>
        <?php
        if (count($project->tags) > 0):
            echo $this->Html->arrayToString(array_map(function($tag) {
                        return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                    }, $project->tags));
        else:
            echo __d('elabs', 'No tags');
        endif;
        ?>
    </li>
</ul>

<?php
$this->end();

// Block: Actions
// --------------
if (!empty($project->mainurl)):
    $this->start('pageActions');
    echo $this->Html->link($this->Html->iconT('external-link', __d('elabs', 'Website')), $project->mainurl, ['escape' => false, 'class' => 'btn btn-block']);
    $this->end();
endif;

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div<?php echo $this->Html->langAttr($project->language->iso369_1) ?>>
    <?php
    echo $this->Html->displayMD($project->short_description);
    echo $this->Html->displayMD($project->description);
    ?>
</div>
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active">
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all posts in this project')]),
                    ['controller' => 'posts', 'action' => 'index', 'project', $project->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all notes in this project')]),
                    ['controller' => 'notes', 'action' => 'index', 'project', $project->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#notes-tab"><?php echo __d('elabs', 'Notes') ?></a>
        </li>
        <li>
<?php
echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all files in this project')]),
                    ['controller' => 'files', 'action' => 'index', 'project', $project->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
)
?>
            <a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all albums in this project')]),
                    ['controller' => 'albums', 'action' => 'index', 'project', $project->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#albums-tab"><?php echo __d('elabs', 'Albums') ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <h4>
            <?php echo __d('elabs', 'Last {0} elements added to project', [Configure::read('cms.maxRelatedData')]) ?>
        </h4>
        <?php
        if (!$seeNSFW):
            ?>
            <div class="alert alert-info alert-sm">
                <?php echo $this->Html->iconT('info', __d('elabs', 'Some entries may be hidden, depending on your NSFW settings.')) ?>
            </div>
        <?php endif; ?>
        <div class="tab-pane fade active in" id="posts-tab">
        <?php
        if (!empty($project->posts)):
            foreach ($project->posts as $posts):
                echo $this->element('posts/card', ['data' => $posts, 'projectInfos' => false, 'event' => false]);
            endforeach;
        else:
            echo $this->element('layout/empty', ['alternative' => false]);
        endif;
        ?>
        </div>

        <div class="tab-pane" id="notes-tab">
            <?php
            if (!empty($project->notes)):
                foreach ($project->notes as $note):
                    echo $this->element('notes/card', ['data' => $note, 'projectInfos' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($project->files)):
                foreach ($project->files as $files):
                    echo $this->element('files/card', ['data' => $files, 'projectInfos' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="albums-tab">
            <?php
            if (!empty($project->albums)):
                foreach ($project->albums as $albums):
                    echo $this->element('albums/card', ['data' => $albums, 'projectInfos' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>
    </div>
</div>
<?php
echo $this->cell('Comments::AddForm', ['authUser' => $authUser]);

$this->end();

// Additionnal JS
// --------------
$this->Html->script('scrollbar', ['block' => 'pageBottomScripts']);

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
