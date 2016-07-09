<?php
$haveMenu = false;
$this->start('pageMenu');
$this->end();

// Ordering menu
$this->start('pageOrderMenu_final');
$pageOrderMenu = $this->fetch('pageOrderMenu');
if (!empty($pageOrderMenu)):
    $haveMenu = true;
    ?>
    <div class="btn-group" aria-role="toolbar">
        <a><?= __('Order by:') ?></a>
        <?php echo $pageOrderMenu ?>
    </div>
    <?php
endif;
$this->end();

// Filters
$this->start('pageFiltersMenu_final');
$pageFiltersMenu = $this->fetch('pageFiltersMenu');

if (!empty($pageFiltersMenu)):
    $haveMenu = true;
    ?>
    <div class="btn-group" aria-role="toolbar">
        <a><?php echo __d('elabs', 'Filters') ?></a>
        <?php echo $pageFiltersMenu; ?>
    </div>
    <?php
endif;
$this->end();

// Actions
$this->start('pageActionsMenu_final');
$pageActionsMenu = $this->fetch('pageActionsMenu');
if (!empty($pageActionsMenu)):
    $haveMenu = true;
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo __d('elabs', 'Actions') ?></h3>
        </div>
        <div class="panel-body">

        </div>
    </div>
    <?php
endif;
$this->end();

if ($haveMenu):
    ?>
    <div class="row">
        <div class="col-sm-12 toolbar">
            <?php
            echo $this->fetch('pageOrderMenu_final');
            echo $this->fetch('pageFiltersMenu_final');
            echo $this->fetch('pageActionsMenu_final');
            ?>
        </div>
    </div>
    <?php
endif;
?>
<div class="row">
    <div class="col-sm-12">
        <?php
        echo $this->fetch('pageContent');
        echo $this->element('layout/paginationlinks');
        ?>
    </div>   
</div>