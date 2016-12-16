<?php
/*
 * File:
 *   src/Templates/Languages/view.ctp
 * Description:
 *   Display of a single license
 * Layout element:
 *   defaultview.ctp
 */
use Cake\Core\Configure;

// Page title
$this->assign('title', __d('elabs', 'Language: {0}', $this->Html->langLabel(h($language->name), $language->iso639_1, ['label' => false])));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'About'), ['controller' => 'Pages', 'action' => 'display', 'about']);
$this->Html->addCrumb(__d('elabs', 'Languages'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Content in "{0}"', $this->Html->langLabel(h($language->name), $language->iso639_1, ['label' => false])));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>  
<ul class="list-unstyled">
    <li><strong><?php echo $this->Html->iconT('font', __d('elabs', 'Name:')) ?></strong> <span<?php echo $this->Html->langAttr($language->iso639_1) ?>><?php echo h($language->name) ?></span></li>
    <li><strong><?php echo $this->Html->iconT('info', __d('elabs', 'Available translation:')) ?></strong> <?php echo $this->Html->checkIcon($language->has_site_translation) ?></li>
    <li><strong><?php echo $this->Html->iconT('info', __d('elabs', 'iso639-1 code:')) ?></strong> <?php echo h($language->iso639_1) ?></li>
    <li class="separator"></li>
    <li><strong><?php echo $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $language->post_count, [$language->post_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('sticky-note', __dn('elabs', '{0} note', '{0} notes', $language->note_count, $language->note_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('file-o', __dn('elabs', '{0} file','{0} files', $language->file_count, $language->file_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('cogs', __dn('elabs', '{0} project', '{0} projects', $language->project_count, $language->project_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('book', __dn('elabs', '{0} album', '{0} albums', $language->album_count, $language->album_count)) ?></strong></li>
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
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all articles in this language')]), 
                    ['controller' => 'posts', 'action' => 'index', 'language', $language->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all notes in this language')]), 
                    ['controller' => 'notes', 'action' => 'index', 'language', $language->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#notes-tab"><?php echo __d('elabs', 'Notes') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all projects in this language')]), 
                    ['controller' => 'projects', 'action' => 'index', 'language', $language->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all files in this language')]), 
                    ['controller' => 'files', 'action' => 'index', 'language', $language->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all albums in this language')]), 
                    ['controller' => 'albums', 'action' => 'index', 'language', $language->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#albums-tab"><?php echo __d('elabs', 'Albums') ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <h4>
            <?php echo __d('elabs', 'Last {0} elements in this language', [Configure::read('cms.maxRelatedData')]) ?>
        </h4>
        <?php
        if (!$seeNSFW):
            ?>
            <div class="alert alert-info alert-sm">
                <?php echo $this->Html->iconT('info', __d('elabs','Some entries may be hidden, depending on your NSFW settings.')) ?>
            </div>
        <?php endif; ?>
        <div class="tab-pane fade active in" id="posts-tab">
            <?php
            if (!empty($language->posts)):
                foreach ($language->posts as $posts):
                    echo $this->element('posts/card', ['data' => $posts, 'event' => false, 'languageInfo' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false,]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="notes-tab">
            <?php
            if (!empty($language->notes)):
                foreach ($language->notes as $note):
                    echo $this->element('notes/card', ['data' => $note, 'event' => false, 'languageInfo' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($language->projects)):
                foreach ($language->projects as $projects):
                    echo $this->element('projects/card', ['data' => $projects, 'event' => false, 'languageInfo' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($language->files)):
                foreach ($language->files as $files):
                    echo $this->element('files/card', ['data' => $files, 'event' => false, 'languageInfo' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>
        <div class="tab-pane" id="albums-tab">
            <?php
            if (!empty($language->albums)):
                foreach ($language->albums as $album):
                    echo $this->element('albums/card', ['data' => $album, 'event' => false, 'languageInfo' => false]);
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
