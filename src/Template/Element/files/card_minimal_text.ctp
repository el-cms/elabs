    <?php

    echo $this->Html->link($this->Html->icon('file-text-o 5x') . '<br/>' . $data['name'], ['controller' => 'Files', 'action' => 'view', $data['id']], ['escape' => false]);
    