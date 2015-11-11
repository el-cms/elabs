<div class="card">
    <div class="card-main">
        <div class="card-inner margin-bottom-no">
            <p class="card-heading"><?php echo $title ?></p>
            <div class="card-table">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-condensed">
                        <?php echo $this->fetch('cardTable'); ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-action">
            <div class="card-action-btn pull-right">
                <ul class="pagination">
                    <?php echo $this->Paginator->prev(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-angle-left"></span>', __d('elabs', 'Previous')]), ['escape' => false]) ?>
                    <?php echo $this->Paginator->numbers() ?>
                    <?php echo $this->Paginator->next(__d('elabs', '{1}&nbsp;{0}', ['<span class="fa fa-fw fa-angle-right"></span>', __d('elabs', 'Next')]), ['escape' => false]) ?>
                </ul>
            </div>
        </div>
    </div>
</div>
