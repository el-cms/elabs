<?php
$hasSideBar = false;

// Actions
$pageActions = $this->fetch('pageActions');
if (!empty($pageActions)):
    $hasSideBar = true;
    $this->start('pageActions_final');
    ?>
    <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo __d('elabs', 'Actions') ?></h4>
        <div class="list-group-item-text">
            <?php echo $this->fetch('pageActions') ?>
        </div>
    </div>
    <?php
    $this->end();
endif;

// Infos
$pageInfos = $this->fetch('pageInfos');
if (!empty($pageInfos)):
    $hasSideBar = true;
    $this->start('pageInfos_final');
    ?>
    <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo __d('elabs', 'Infos') ?></h4>
        <div class="list-group-item-text">
            <?php echo $this->fetch('pageInfos') ?>
        </div>
    </div>
    <?php
    $this->end();
endif;


if ($hasSideBar):
    ?>
    <div class="col-sm-4 side-menu">
        <div class="list-group">
            <?php
            echo $this->fetch('pageActions_final');
            echo $this->fetch('pageInfos_final');
            ?>
        </div>
    </div>
    <?php
endif;
?>
<div class = "col-sm-<?php echo ($hasSideBar) ? 8 : 12 ?> rendered-text">
    <?php echo $this->fetch('pageContent'); ?>
</div>