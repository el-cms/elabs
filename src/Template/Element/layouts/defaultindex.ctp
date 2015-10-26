<div class="col-sm-3">
  <?php if (!empty($this->fetch('pageOrderMenu'))): ?>
      <div class="content-sub-heading"><?= __d('elabs', 'Filters') ?></div>
      <div class="dropdown-wrap">
        <div class="dropdown  dropdown-inline">
          <a aria-expanded="false" class="btn dropdown-toggle-btn waves-attach waves-effect" data-toggle="dropdown"><?= __d('elabs', 'Order by...') ?><span class="icon margin-left-sm">keyboard_arrow_down</span></a>
          <?= $this->fetch('pageOrderMenu') ?>
        </div>
      </div>
  <?php endif; ?>
  <?php if (!empty($this->fetch('pageActionsMenu'))): ?>
      <div class="content-sub-heading"><?= __d('elabs', 'Actions') ?></div>
      <?= $this->fetch('pageActionsMenu') ?>
  <?php endif; ?>
</div>

<div class="col-sm-9">

  <?= $this->fetch('pageContent'); ?>

  <div class="paginator">
    <ul class="pagination pull-right">
      <?= $this->Paginator->prev('< ' . __('previous')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('next') . ' >') ?>
      <li class="disabled"><?= $this->Paginator->counter() ?></li>
    </ul>

  </div>
</div>