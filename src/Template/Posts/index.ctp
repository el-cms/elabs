<?php
$this->assign('title', __d('posts', 'Articles'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => ''];
echo $this->Paginator->sort('title', __d('posts', 'Title'), $linkOptions);
echo $this->Paginator->sort('publication_date', __d('posts', 'Publication date'), $linkOptions);
$this->end();

// Page content
$this->start('pageContent');
?>
<div class="row">
    <?php
    if (!$posts->isEmpty()):
        foreach ($posts as $post):
            echo $this->element('posts/card', ['data' => $post, 'event' => false]);
        endforeach;
    else:
        echo $this->element('layout/empty');
    endif;
    ?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultindex');
