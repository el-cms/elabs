<?php
// Additionnal helpers
$this->loadHelper('CodeMirror');

// Blocks:
$colContentLeft = ['pageActions' => ['title' => __d('elabs', 'Actions')], 'pageLinks' => ['title' => __d('elabs', 'Related links')]];
$colContentMain = ['pageContent'];

// Preparing content
$haveLeftCol = false;
$haveRightCol = false;

// Left column
// -----------
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

// Rendering the left col
// ----------------------
if ($haveLeftCol):
    ?>
    <div class="col-sm-3">
        <div class="list-group">
            <?php echo $this->fetch('leftCol'); ?>
        </div>
    </div>
    <?php
endif;

// Rendering the page content
// --------------------------
?>
<div class="col-sm-<?php echo ($haveLeftCol) ? 9 : 12 ?>">
    <?php echo $this->fetch('pageContent'); ?>
</div>
<?php
// Custom scripts
// --------------
$this->append('pageBottomScripts');
echo $this->CodeMirror->scripts();
echo $this->Html->script('lib/jquery.fs.selecter.min');
?>
<script>
    $(document).ready(function () {
      $('select:not([data-role="tagsinput"])').selecter();
      $('select[multiple][data-role=tagsinput]').tagsinput({
        confirmKeys: [13, 188]
      });
      $('.bootstrap-tagsinput input').on('keypress', function (event) {
        if (event.keyCode === 13) {
          event.keyCode = 188;
          event.preventDefault();
        }
      });
    });
</script>
<?php
$this->end();
