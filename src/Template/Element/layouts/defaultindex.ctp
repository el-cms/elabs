<div class="col-sm-3">
  <?php
  if (!empty($this->fetch('pageOrderMenu'))):
      ?>
      <div class="content-sub-heading"><?php echo __d('elabs', 'Display order') ?></div>
      <div class="dropdown-wrap">
        <div class="dropdown  dropdown-inline">
          <a aria-expanded="false" class="btn dropdown-toggle-btn waves-attach waves-effect" data-toggle="dropdown"><?php echo __d('elabs', 'Order by...') ?><span class="icon margin-left-sm">keyboard_arrow_down</span></a>
          <?php echo $this->fetch('pageOrderMenu') ?>
        </div>
      </div>
      <?php
  endif;

  if (!empty($this->fetch('pageFiltersMenu'))):
      ?>
      <div class="content-sub-heading"><?php echo __d('elabs', 'Filters') ?></div>
      <?php
      echo $this->fetch('pageFiltersMenu');
  endif;

  if (!empty($this->fetch('pageActionsMenu'))):
      ?>
      <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
      <?php
      echo $this->fetch('pageActionsMenu');
  endif;
  ?>
</div>

<div class="col-sm-9">
  <?php
  echo $this->fetch('pageContent');
  echo $this->element('layout/paginationlinks');
  ?>
</div>