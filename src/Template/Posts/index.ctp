<?php
$this->assign('title', __d('posts', 'Articles'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => 'waves-attach waves-effect'];
?>
<ul class="dropdown-menu nav">
    <li><?php echo $this->Paginator->sort('title', __d('posts', 'Title'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('publication_date', __d('posts', 'Publication date'), $linkOptions) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
if (!$posts->isEmpty()):
    foreach ($posts as $post):
        echo $this->element('posts/card', ['data' => $post]);
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
