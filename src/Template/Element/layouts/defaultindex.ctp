<?php
$haveMenu = false;
// Starting the toolbar
$this->start('pageToolbar');

// Ordering options
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
// End of ordering options
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
// End of filters
$this->end();

// Actions
$this->start('pageActionsMenu_final');
$pageActionsMenu = $this->fetch('pageActionsMenu');
if (!empty($pageActionsMenu)):
    $haveMenu = true;
    ?>
    <div class="btn-group" aria-role="toolbar">
        <a><?php echo __d('elabs', 'Actions') ?></a>
        <?php echo $pageFiltersMenu; ?>
    </div>
    <?php
endif;
// End of Actions
$this->end();

// Rendering the toolbar
if ($haveMenu):
    ?>
    <div class="toolbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->fetch('pageOrderMenu_final');
                    echo $this->fetch('pageFiltersMenu_final');
                    echo $this->fetch('pageActionsMenu_final');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;

// End of toolbar
$this->end();

// Page layout
?>
<div class="row">
    <div class="col-sm-12">
        <?php
        echo $this->fetch('pageContent');
        echo $this->element('layout/paginationlinks');
        ?>
    </div>   
</div>