<?php
$this->assign('title', __d('users', 'Author: {0}', h($user->realname)));

$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __d('users', 'Username') ?></dt>
    <dd><?php echo h($user->username) ?></dd>
    <dt><?php echo __d('users', 'Name') ?></dt>
    <dd><?php echo h($user->realname) ?></dd>
    <dt><?php echo __d('users', 'Website') ?></dt>
    <dd><?php echo h($user->website) ?></dd>
    <dt><?php echo __d('users', 'Member since') ?></dt>
    <dd><?php echo h($user->created) ?></dd>
</dl>
<?php
$this->end();

$this->start('pageContent');

echo $this->Markdown->transform(h($user->bio));
?>

<nav class="tab-nav tab-nav-brand">
    <ul class="nav nav-justified">
        <li class="active">
            <a class="waves-attach waves-effect" data-toggle="tab" href="#posts-tab"><?php echo __d('posts', 'Articles') ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#projects-tab"><?php echo __d('projects', 'Projects') ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#files-tab"><?php echo __d('files', 'Files') ?></a>
        </li>
    </ul>
    <div class="tab-nav-indicator"></div>
</nav>

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
<?php
$this->end();

echo $this->element('layouts/defaultview');
