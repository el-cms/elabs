<div class="paginator">
    <ul class="pagination pull-right">
        <?php echo $this->Paginator->prev(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-angle-left"></span>', __d('elabs', 'Previous')]), ['escape' => false]) ?>
        <?php echo $this->Paginator->numbers() ?>
        <?php echo $this->Paginator->next(__d('elabs', '{1}&nbsp;{0}', ['<span class="fa fa-fw fa-angle-right"></span>', __d('elabs', 'Next')]), ['escape' => false]) ?>
        <li class="disabled"><?php echo $this->Paginator->counter() ?></li>
    </ul>
</div>