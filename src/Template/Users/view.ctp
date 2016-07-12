<?php
$this->assign('title', __d('users', 'Author: {0}', h($user->realname)));

$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('users', 'Username:') ?></strong> <?php echo h($user->username) ?></li>
    <?php if ($user->has('website')): ?>
        <li><strong><?php echo __d('users', 'Website:') ?></strong><br/><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-external-link"></span>', h($user->website)]), h($user->website), ['escape' => false, 'target' => '_blank']) ?></li>
    <?php endif; ?>
    <li><strong><?php echo __d('users', 'Member since:') ?></strong> <?php echo h($user->created) ?></li>
</ul>
<?php
$this->end();

$this->start('pageContent');
?>
<div class="well">
    <?php echo $this->Html->displayMD($user->bio) ?>    
</div>
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#posts-tab"><?php echo __d('posts', 'Articles ({0})', $user->post_count) ?></a></li>
        <li><a data-toggle="tab" href="#projects-tab"><?php echo __d('projects', 'Projects ({0})', $user->project_count) ?></a></li>
        <li><a data-toggle="tab" href="#files-tab"><?php echo __d('files', 'Files ({0})', $user->file_count) ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="posts-tab">
            <?php
            if (!empty($user->posts)):
                foreach ($user->posts as $posts):
                    echo $this->element('posts/card', ['data' => $posts, 'userInfo' => false]);
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
                    echo $this->element('projects/card', ['data' => $projects, 'userInfo' => false]);
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
                    echo $this->element('files/card', ['data' => $files, 'userInfo' => false]);
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

echo $this->element('layouts/defaultview');
