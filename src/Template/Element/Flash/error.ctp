<div class="alert alert-danger" onclick="this.classList.add('hidden');">
  <?php echo h($message) ?>
  <?php if (isset($params) AND isset($params['errors'])) : ?>
        <ul class="list">
            <?php foreach ($params['errors'] as $error) : ?>
                <li><?php echo $this->Html->iconT('warning', h($error)) ?></li>
            <?php endforeach;
            ?>
        </ul>
    <?php endif; ?>
</div>
