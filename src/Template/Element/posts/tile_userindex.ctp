<div class="tile tile-collapse">
  <div data-parent="#<?php echo $tileId ?>" data-target="#<?php echo $tileId . $post->id ?>" data-toggle="tile" class="padding-no">
    <div class="pull-right">
      <ul class="margin-no nav nav-list">
        <li class="dropdown">
          <a aria-expanded="false" class="dropdown-toggle text-default waves-attach waves-effect" data-toggle="dropdown"><span class="icon">more_vert</span></a>
          <ul class="dropdown-menu">
            <li>
              <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;View online', '<span class="fa fa-eye fa-fw"></span>'), ['prefix' => false, 'action' => 'view', $post->id], ['class' => 'waves-attach waves-effect', 'escape' => false]); ?>
            </li>
            <li>
              <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;Edit', '<span class="fa fa-pencil fa-fw"></span>'), ['action' => 'edit', $post->id], ['class' => 'waves-attach waves-effect', 'escape' => false]) ?>
            </li>
            <li>
              <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;Delete', '<span class="fa fa-trash fa-fw text-red "></span>'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id), 'class' => 'waves-attach waves-effect', 'escape' => false]) ?>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="tile-inner cell-title">
      <?php if ($post->sfw): ?>
          <span class="label label-green fixed-font"><?php echo __d('elabs', 'Safe') ?></span>
      <?php else: ?>
          <span class="label label-red fixed-font"><?php echo __d('elabs', 'NSFW') ?></span>
      <?php endif; ?>&nbsp;
      <?php if ($post->status===1): ?>
          <span class="label label-green"><?php echo __d('posts','Published') ?></span>
      <?php elseif ($post->status===0): ?>
          <span class="label label-gray"><?php echo __d('posts','Draft') ?></span>
      <?php else: ?>
          <span class="label label-red"><?php echo __d('posts','Locked') ?></span>
      <?php endif; ?>&nbsp;
      <?php echo h($post->title) ?>
    </div>
  </div>
  <div style="height: 0px;" class="tile-active-show collapse" id="<?php echo $tileId . $post->id ?>">
    <div class="tile-sub">
      <dl class="dl-horizontal">
        <dt><?php echo __('Id') ?></dt>
        <dd><?php echo $this->Number->format($post->id) ?></dd>
        <?php if ($post->published): ?>
            <dt><?php echo __d('posts', 'Publication date') ?></dt>
            <dd><?php echo h($post->publication_date) ?></dd>
        <?php endif; ?>
        <dt><?php echo __d('elabs', 'Creation date') ?></dt>
        <dd><?php echo h($post->created) ?></dd>
        <dt><?php echo __d('elabs', 'Updated on') ?></dt>
        <dd><?php echo h($post->modified) ?></dd>
        <dt><?php echo __d('elabs', 'License') ?></dt>
        <dd><?php echo $this->Html->link(h($post->license->name), ['prefix' => false, 'controller' => 'licenses', 'action' => 'view', $post->license_id]); ?></dd>
        <dt><?php echo __d('elabs', 'Tags') ?></dt>
        <dd><?php echo $this->element('layout/dev_inline') ?></dd>
      </dl>
    </div>
  </div>
</div>
