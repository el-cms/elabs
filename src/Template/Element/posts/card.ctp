<div class="card<?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-side pull-left">
        <span class="card-heading">
            <?php echo $this->Html->link(__d('elabs', 'Read more...'), ['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $data['id']], ['class' => 'waves-attach waves-effect btn btn-flat btn-block']) ?>
            <?php echo $this->Elabs->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $data['id']], true), ['class' => 'waves-attach waves-effect btn btn-flat btn-block']) ?>
        </span>
    </div>
    <div class="card-main">
        <!-- Header -->
        <div class="card-header">
            <!-- Icon -->
            <div class="card-header-side pull-left">
                <i class="fa fa-font fa-3x"></i>
            </div>
            <!-- Title -->
            <div class="card-inner">
                <div class="text-overflow"><?php echo h($data['title']) ?></div>
                <em class="subtitle">
                    <?php
                    echo __d('posts', 'Published on: {0}', h($data['publication_date']));
                    if ($data['publication_date'] < $data['modified']):
                        echo ' - ' . __d('elabs', 'Updated on: {0}', h($data['modified']));
                    endif;
                    ?>
                </em>
            </div>
        </div>
        <!-- Content -->
        <div class="card-description">
            <?php
            if (!isset($userInfo) || $userInfo):
                echo __d('elabs', '{0}&nbsp;Author: {1}', '<i class="fa fa-user"></i>', $this->Html->link($data['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user']['id']]))
                ?><br/>
                <?php
            endif;
            if (!isset($licenseInfo) || $licenseInfo):
                echo __d('elabs', '{0}&nbsp;License: {1}', '<i class="fa fa-copyright"></i>', $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $data['license']['icon'] . '"></span>', $data['license']['name']]), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'view', $data['license']['id']], ['escape' => false]));
            endif;
            ?>
        </div>
        <div class="card-inner">
            <p>
                <?php echo $this->Elabs->displayMD($data['excerpt']) ?>
            </p>
        </div>
    </div>
</div>