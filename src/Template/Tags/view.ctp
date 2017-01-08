<?php
/*
 * File:
 *   src/Templates/Tags/view.ctp
 * Description:
 *   Display of a single tag
 * Layout element:
 *   defaultview.ctp
 */

use Cake\Core\Configure;

// Page title
$this->assign('title', __d('elabs', 'Tag: {0}', h($tag->id)));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Tags'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'List of tags'));
$this->Html->addCrumb(__d('elabs', 'Content with the {0} tag', [h($tag->id)]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo $this->Html->iconT('font', __d('elabs', 'Name:')) ?></strong> <?php echo h($tag->id) ?></li>
    <li class="separator"></li>
    <li><strong><?php echo $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $tag->post_count, [$tag->post_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('sticky-note', __dn('elabs', '{0} note', '{0} notes', $tag->note_count, [$tag->note_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('file-o', __dn('elabs', '{0} file', '{0} files', $tag->file_count, [$tag->file_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('cogs', __dn('elabs', '{0} project', '{0} projects', $tag->project_count, [$tag->project_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('book', __dn('elabs', '{0} album', '{0} albums', $tag->post_count, [$tag->album_count])) ?></strong></li>
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active">
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all articles with this tag')]),
                    ['controller' => 'posts', 'action' => 'index', 'tag', $tag->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all notes with this tag')]),
                    ['controller' => 'notes', 'action' => 'index', 'tag', $tag->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#notes-tab"><?php echo __d('elabs', 'Notes') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all projects with this tag')]),
                    ['controller' => 'projects', 'action' => 'index', 'tag', $tag->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all files with this tag')]),
                    ['controller' => 'files', 'action' => 'index', 'tag', $tag->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all albums with this tag')]),
                    ['controller' => 'albums', 'action' => 'index', 'tag', $tag->id],
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#albums-tab"><?php echo __d('elabs', 'Albums') ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <h4>
            <?php echo __d('elabs', 'Last {0} elements with this tag', [Configure::read('cms.maxRelatedData')]) ?>
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
            if (!empty($tag->posts)):
                foreach ($tag->posts as $post):
                    echo $this->element('posts/card', ['data' => $post, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="notes-tab">
            <?php
            if (!empty($tag->notes)):
                foreach ($tag->notes as $note):
                    echo $this->element('notes/card', ['data' => $note, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($tag->projects)):
                foreach ($tag->projects as $project):
                    echo $this->element('projects/card', ['data' => $project, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($tag->files)):
                foreach ($tag->files as $file):
                    echo $this->element('files/card', ['data' => $file, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="albums-tab">
            <?php
            if (!empty($tag->albums)):
                foreach ($tag->albums as $album):
                    echo $this->element('albums/card', ['data' => $album, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
