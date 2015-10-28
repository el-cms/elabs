<?php
$this->assign('title', __d('projects', 'Projects'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
  <li><?php echo $this->Paginator->sort('name') ?></li>
  <li><?php echo $this->Paginator->sort('created') ?></li>
  <li><?php echo $this->Paginator->sort('modified') ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
if (!$projects->isEmpty()):
    foreach ($projects as $project):
        $item = [
            'fkid' => $project->id,
            'user' => $project['user'],
        ];
        echo $this->element('projects/card', ['data' => $project, 'item' => $item]);

    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
