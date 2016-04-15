<div class="col-sm-3">
    <?php
    if (!empty($this->fetch('pageOrderMenu'))):
        ?>
        <div class="side-menu">
            <div class="content-sub-heading"><?php echo __d('elabs', 'Display order') ?></div>
            <div class="dropdown dropdown-inline">
                <a aria-expanded="false" class="btn dropdown-toggle-btn waves-attach waves-effect" data-toggle="dropdown"><?php echo __d('elabs', 'Order by...') ?><span class="icon margin-left-sm">keyboard_arrow_down</span></a>
                <?php echo $this->fetch('pageOrderMenu') ?>
            </div>
        </div>
        <?php
    endif;

    if (!empty($this->fetch('pageFiltersMenu'))):
        ?>
        <div class="side-menu">
            <div class="content-sub-heading"><?php echo __d('elabs', 'Filters') ?></div>
            <div class="side-menu-content">
                <?php echo $this->fetch('pageFiltersMenu'); ?>
            </div>
        </div>
        <?php
    endif;

    if (!empty($this->fetch('pageActionsMenu'))):
        ?>
        <div class="side-menu">
            <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
            <div class="side-menu-content">
                <?php echo $this->fetch('pageActionsMenu'); ?>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

<div class="col-sm-9">
    <?php
    echo $this->fetch('pageContent');
    echo $this->element('layout/paginationlinks');
    ?>
</div>