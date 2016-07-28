<?php
/*
 * File:
 *   src/Templates/Admin/Users/view.ctp
 * Description:
 *   Administration - Displays an user
 * Layout element:
 *   adminview.ctp
 */

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
            <li><strong><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('user'), h($user->username)]) ?></strong></li>
            <li><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('calendar'), h($user->created)]) ?></li>
            <?php if ($user->has('website')): ?>
                <li><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('external-link'), $this->Html->link(__d('elabs', 'Website'), h($user->website), ['escape' => false, 'target' => '_blank'])]) ?></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
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
        <li class="active"><a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles {0}', '<span class="badge">' . $user->post_count . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects {0}', '<span class="badge">' . $user->project_count . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files {0}', '<span class="badge">' . $user->file_count . '</span>') ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="posts-tab">
            <?php
            if (!empty($user->posts)):
                foreach ($user->posts as $posts):
                    echo $this->element('posts/card', ['data' => $posts, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($user->projects)):
                foreach ($user->projects as $projects):
                    echo $this->element('projects/card', ['data' => $projects, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($user->files)):
                foreach ($user->files as $files):
                    echo $this->element('files/card', ['data' => $files, 'userInfo' => false, 'event' => false]);
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
echo $this->element('layouts/adminview');
