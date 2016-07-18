<div class="paginator pull-right">
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('angle-left'), __d('elabs', 'Previous')]), ['escape' => false]);
        echo $this->Paginator->numbers();
        echo $this->Paginator->next(__d('elabs', '{1}&nbsp;{0}', [$this->Html->icon('angle-right'), __d('elabs', 'Next')]), ['escape' => false]);
        ?>
    </ul>
    <span><?php echo $this->Paginator->counter() ?></span>
</div>