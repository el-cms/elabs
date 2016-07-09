<div class="card<?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">

<!--<span class="card-heading">
    <?php echo $this->Html->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $data['id']], true), ['class' => '  btn btn-flat btn-block']) ?>
</span>-->
    <div class="card-main">
        <!-- Icon -->
        <div class="card-header-side">
            <i class="fa fa-font fa-3x"></i>
        </div>
        <!-- Header -->
        <div class="card-header">
            <!-- Title -->
            <h3><?php echo $this->Html->link(h($data['title']), ['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $data['id']]) ?></h3>
            <ul class="card-informations">
                <?php if (!isset($userInfo) || $userInfo): ?>
                    <li>
                        <?= __('{0}&nbsp;{1}', [$this->Html->icon('user'), __('Author:')]) ?>
                        <?= $this->Html->link($data['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user']['id']]) ?>
                    </li>
                    <?php
                endif;
                if (!isset($licenseInfo) || $licenseInfo):
                    ?>
                    <li>
                        <?php echo __('{0}&nbsp;{1}', [$this->Html->icon('copyright'), __('License:')]) ?>
                        <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon($data['license']['icon']), $data['license']['name']]), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'view', $data['license']['id']], ['escape' => false]) ?>
                    </li>
                    <?php
                endif;
                ?>
            </ul>
        </div>
        <!-- Content -->
        <div class="card-content">
            <p>
                <?php echo $this->Html->displayMD($data['excerpt']) ?>
            </p>
        </div>
    </div>
</div>