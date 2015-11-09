<?php
$config = $this->Items->fileConfig($data['filename']);
?>
<div class="card<?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-side pull-left">
        <span class="card-heading">
            <?php echo $this->Html->link(__d('elabs', 'View...'), ['prefix' => false, 'controller' => 'Files', 'action' => 'view', $this->Number->format($item['fkid'])], ['class' => 'waves-attach waves-effect btn btn-flat btn-block']) ?>
            <?php echo $this->Elabs->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Files', 'action' => 'view', $this->Number->format($item['fkid'])], true), ['class' => 'waves-attach waves-effect btn btn-flat btn-block']) ?>
        </span>
    </div>
    <div class="card-main">
        <!-- Header -->
        <div class="card-header">
            <!-- Icon -->
            <div class="card-header-side pull-left">
                <i class="fa fa-<?php echo $config['icon'] ?> fa-3x"></i>
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
            <?php echo __d('elabs', '{0}&nbsp;Creator: {1}', '<i class="fa fa-user"></i>', $this->Html->link($item['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $this->Number->format($item['user']['id'])])) ?><br/>
            <?php echo __d('elabs', '{0}&nbsp;License: {1}', '<i class="fa fa-copyright"></i>', $this->Html->link($this->License->d($data['license']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'view', $this->Number->format($data['license']['id'])], ['escape' => false])) ?>
        </div>
        <div class="card-inner">
            <?php echo $this->element('files/card_content_' . $config['element'], ['data' => $data]) ?>
            <p>
                <?php echo $this->Markdown->transform(h($data['description'])) ?>
            </p>
        </div>
    </div>
</div>