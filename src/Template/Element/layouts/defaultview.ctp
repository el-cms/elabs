<div class="col-sm-3">
	<?php
//    if(!empty($this->fetch('pageActions'))):
        ?>
    <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
	<?php echo $this->fetch('pageActions') ?>
    <?php //endif; 
//     if(!empty($this->fetch('pageInfos'))):
    ?>
	<div class="content-sub-heading"><?php echo __d('elabs', 'Infos') ?></div>
	<?php echo $this->fetch('pageInfos') ?>
</div>

<div class="col-sm-9 rendered-text">

	<?php echo $this->fetch('pageContent'); ?>

</div>