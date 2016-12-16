<?php
/*
 * File:
 *   src/Templates/Admin/Users/view.ctp
 * Description:
 *   Administration - Displays an user
 * Layout element:
 *   adminview.ctp
 */
use Cake\Core\Configure;

// Page title
$this->assign('title', h($user->realname));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Authors'), ['action' => 'index']);
$this->Html->addCrumb(h($user->realname));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Gravatar->generate($user->email, ['image-options' => ['class' => 'img-responsive img-rounded']]) ?>
    </div>
    <div class="col-sm-8">
        <ul class="list-unstyled">
            <li><strong><?php echo $this->Html->iconT('user', h($user->realname)) ?></strong></li>
            <li><?php echo $this->Html->iconT('user', h($user->username)) ?></li>
        </ul>
    </div>
</div>
<ul class="list-unstyled margin-top-md">
    <li><strong><?php echo $this->Html->iconT('calendar', 'Joined:') ?></strong> <?php echo $this->Time->nice($user->created) ?></li>
    <?php if ($user->has('website')): ?>
        <li><?php echo $this->Html->iconT('external-link', $this->Html->link(__d('elabs', 'Website'), h($user->website), ['escape' => false, 'target' => '_blank'])) ?></li>
    <?php endif; ?>
    <li class="separator"></li>
    <li><strong><?php echo $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $user->post_count, [$user->post_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('sticky-note', __dn('elabs', '{0} note', '{0} notes', $user->note_count, $user->note_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('file-o', __dn('elabs', '{0} file', '{0} files', $user->file_count, $user->file_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('cogs', __dn('elabs', '{0} project', '{0} projects', $user->project_count, $user->project_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('book', __dn('elabs', '{0} album', '{0} albums', $user->album_count, $user->album_count)) ?></strong></li>
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
if (!empty($user->bio)):
    ?>
    <div class="well">
        <?php echo $this->Html->displayMD($user->bio) ?>
    </div>
<?php endif; ?>
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active">
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all posts for this author')]), ['controller' => 'Posts', 'action' => 'index', 'user', $user->id], ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles') ?></a>
        </li>
        <li>
<?php
echo $this->Html->link(
        $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all notes for this author')]), ['controller' => 'Notes', 'action' => 'index', 'user', $user->id], ['escape' => false, 'class' => 'tab-btn-right']
)
?>
            <a data-toggle="tab" href="#notes-tab"><?php echo __d('elabs', 'Notes') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all projects for this author')]), ['controller' => 'Projects', 'action' => 'index', 'user', $user->id], ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all files for this author')]), ['controller' => 'Files', 'action' => 'index', 'user', $user->id], ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all albums for this author')]), ['controller' => 'Albums', 'action' => 'index', 'user', $user->id], ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#albums-tab"><?php echo __d('elabs', 'Albums') ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <h4>
            <?php echo __d('elabs', 'Last {0} elements posted by {1}', [Configure::read('cms.maxRelatedData'), $user->username]) ?>
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
            if (!empty($user->posts)):
                foreach ($user->posts as $post):
                    echo $this->element('posts/card', ['data' => $post, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="notes-tab">
            <?php
            if (!empty($user->notes)):
                foreach ($user->notes as $note):
                    echo $this->element('notes/card', ['data' => $note, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($user->projects)):
                foreach ($user->projects as $project):
                    echo $this->element('projects/card', ['data' => $project, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($user->files)):
                foreach ($user->files as $file):
                    echo $this->element('files/card', ['data' => $file, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="albums-tab">
            <?php
            if (!empty($user->albums)):
                foreach ($user->albums as $album):
                    echo $this->element('albums/card', ['data' => $album, 'userInfo' => false, 'event' => false]);
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

// Additionnal JS
// --------------
            $this->Html->script('scrollbar', ['block' => 'pageBottomScripts']);

// Load the layout element
// -----------------------
            echo $this->element('layouts/adminview');
            