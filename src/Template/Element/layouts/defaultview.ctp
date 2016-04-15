<div class="col-sm-3 side-menu">
    <?php
    if (!empty($this->fetch('pageActions'))):
        ?>
        <div class="side-menu">
            <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
            <div class="side-menu-content">
                <?php echo $this->fetch('pageActions') ?>
            </div>
        </div>
        <?php
    endif;

    if (!empty($this->fetch('pageInfos'))):
        ?>
        <div class="side-menu">
            <div class="content-sub-heading"><?php echo __d('elabs', 'Infos') ?></div>
            <div class="side-menu-content">
                <?php echo $this->fetch('pageInfos') ?>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

<div class="col-sm-9 rendered-text">
    <?php echo $this->fetch('pageContent'); ?>
</div>