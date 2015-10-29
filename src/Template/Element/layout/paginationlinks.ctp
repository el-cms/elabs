<div class="paginator">
  <ul class="pagination pull-right">
    <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
    <?php echo $this->Paginator->numbers() ?>
    <?php echo $this->Paginator->next(__('next') . ' >') ?>
    <li class="disabled"><?php echo $this->Paginator->counter() ?></li>
  </ul>
</div>