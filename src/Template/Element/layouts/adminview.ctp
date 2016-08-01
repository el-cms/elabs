<?php
/*
 * File:
 *   src/Templates/Elements/layouts/defaultview.ctp
 * Description:
 *   Layout element for "view" views
 * Usable blocks:
 *   pageActions - Links for actions related to the view
 *   pageLinks   - Links for pages related to the view
 *   pageInfos   - Information about the displayed item
 *   pageContent - Main view content
 */

// Blocks for this type of view
// ----------------------------
// (Order matters)
$colContentLeft = [
    'pageLinks' => ['title' => __d('elabs', 'Related links')],
    'pageActions' => ['title' => __d('elabs', 'Actions')],
    'pageInfos' => ['title' => __d('elabs', 'Informations')],
];
$colContentMain = ['pageContent'];

// Preparing content
$haveLeftCol = false;

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
?>
<div class="row">
    <?php
    // Left col
    // --------
    if ($haveLeftCol):
        ?>
        <div class="col-sm-3">
            <div class="list-group">
                <?php echo $this->fetch('leftCol'); ?>
            </div>
        </div>
        <?php
    endif;

    // Page content
    // ------------
    ?>
    <div class="col-sm-<?php echo ($haveLeftCol) ? 9 : 12 ?>">
        <?php
        echo $this->fetch('pageContent');
        ?>
    </div>
</div>

<?php
// Additionnal scripts/elements
// ----------------------------
echo $this->element('layout/loader_prism');
