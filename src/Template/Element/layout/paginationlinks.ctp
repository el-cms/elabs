<div class="paginator pull-right">
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev($this->Html->iconT('angle-left', __d('elabs', 'Previous')), ['escape' => false]);
        echo $this->Paginator->numbers();
        echo $this->Paginator->next($this->Html->iconT('angle-right', __d('elabs', 'Next'), ['revert' => true]), ['escape' => false]);
        ?>
    </ul>
    <span><?php echo $this->Paginator->counter() ?></span>
</div>