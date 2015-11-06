<?php
$this->assign('title', __d('files', 'Files'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => 'waves-attach waves-effect'];
?>
<ul class="dropdown-menu nav">
    <li><?php echo $this->Paginator->sort('name', __d('files', 'Name'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('created', __d('files', 'Creation date'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'), $linkOptions) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
if (!$files->isEmpty()):
    foreach ($files as $file):
       $item = [
            'fkid' => $file->id,
            'user' => $file['user'],
        ];
        echo $this->element('files/card', ['data' => $file, 'item' => $item]);

    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
