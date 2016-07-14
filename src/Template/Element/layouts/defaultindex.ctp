<?php
/*
 * File:
 *   src/Templates/Elements/layouts/defaultindex.ctp
 * Description:
 *   Layout element for index views
 * Usable blocks:
 *   pageOrderBy - Pagination links
 *   pageFilters - Filter links
 *   pageActions - Links for actions related to the view
 *   pageLinks   - Links for pages related to the view
 *   pageContent - Main view content
 */

// Blocks for this type of view
// ----------------------------
$toolbarContent = [
    'pageOrderBy' => ['title' => __d('elabs', 'Order by:')],
    'pageFilters' => ['title' => __d('elabs', 'Filters:')]
];
$colContentLeft = [
    'pageActions' => ['title' => __d('elabs', 'Actions')],
    'pageLinks' => ['title' => __d('elabs', 'Related links')]
];
$colContentMain = ['pageContent'];

// Preparing content
$haveLeftCol = false;

// Block: Toolbar
// -----------
$this->start('pageToolbar');
foreach ($toolbarContent as $block => $options):
    $blockData = $this->fetch($block);
    if (!empty($blockData)):
        ?>
        <div class="btn-group">
            <a><?= $options['title'] ?></a>
            <?php echo $blockData ?>
        </div>
        <?php
    endif;
endforeach;
$this->end();

// Block: Left column
// ------------------
$this->start('leftCol');
foreach ($colContentLeft as $block => $options):
    $blockData = $this->fetch($block);
    if (!empty($blockData)):
        $haveLeftCol = true;
        ?>
        <div class="list-group-item">
            <h4 class="list-group-item-heading"><?php echo $options['title'] ?></h4>
            <div class="list-group-item-text">
                <?php echo $blockData ?>
            </div>
        </div>
        <?php
    endif;
endforeach;
$this->end();

// Rendering the view
// ------------------
// Note: Toolbar is rendered in Layout/default.ctp
?>
<div class="row">
    <?php
    // Left col
    // --------
    if ($haveLeftCol):
        ?>
        <div class="col-sm-4">
            <div class="list-group">
                <?php echo $this->fetch('leftCol'); ?>
            </div>
        </div>
        <?php
    endif;

    // Page content
    // ------------
    ?>
    <div class="col-sm-<?php echo ($haveLeftCol) ? 8 : 12 ?>">
        <?php
        echo $this->fetch('pageContent');
        echo $this->element('layout/paginationlinks');
        ?>
    </div>
</div>
