<div class="card<?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-side pull-left">
        <span class="card-heading">
            <?php echo $this->Html->link(__d('elabs', 'Read more...'), ['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $data['id']], ['class' => 'waves-attach waves-effect btn btn-flat']) ?>
            <?php echo $this->Elabs->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $data['id']], true), ['class' => 'waves-attach waves-effect btn btn-flat btn-block btn-block']) ?>
        </span>
    </div>
    <div class="card-main">
        <!-- Header -->
        <div class="card-header">
            <!-- Icon -->
            <div class="card-header-side pull-left">
                <i class="fa fa-cogs fa-3x"></i>
            </div>
            <!-- Title -->
            <div class="card-inner">
                <div class="text-overflow"><?php echo h($data['name']) ?></div>
                <em class="subtitle">
                    <?php
                    echo __d('elabs', 'Created on: {0}', h($data['created']));
                    if ($data['created'] != $data['modified']):
                        echo ' - ' . __d('elabs', 'Updated on: {0}', h($data['modified']));
                    endif;
                    ?>
                </em>
            </div>
        </div>
        <!-- Content -->
        <div class="card-description">
            <?php echo __d('elabs', '{0}&nbsp;Creator: {1}', '<i class="fa fa-user"></i>', $this->Html->link($data['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user']['id']])) ?><br/>
            <?php echo __d('elabs', '{0}&nbsp;License: {1}', '<i class="fa fa-copyright"></i>', $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $data['license']['icon'] . '"></span>', $data['license']['name']]), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'view', $data['license']['id']], ['escape' => false])) ?>
        </div>
        <div class="card-inner">
            <p>
                <?php echo $this->Markdown->transform(h($data['short_description'])) ?>
            </p>
        </div>
    </div>
</div>