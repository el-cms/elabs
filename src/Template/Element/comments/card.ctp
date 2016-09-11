<?php
switch ($data['model']):
    case 'Files':
        $cardIcon = 'file-o';
        $itemTitle = $data['file']['name'];
        break;
    case 'Notes';
        $cardIcon = 'sticky-note';
        $itemTitle = substr($data['note']['text'], 0, 20) . "...";
        break;
    case 'Posts':
        $cardIcon = 'font';
        $itemTitle = $data['post']['title'];
        break;
    case 'Projects':
        $cardIcon = 'cogs';
        $itemTitle = $data['project']['name'];
        break;
    default:
        $cardIcon = 'interrogation-mark';
endswitch;
$contentType = strtolower(\Cake\Utility\Inflector::singularize($data['model']));
?>

<div class="card">
    <div class="card-main">
        <!-- Card toolbar -->
        <ul class="card-toolbar">
            <!-- Language pill -->
            <li><a class="language-pill" lang="<?php echo $data[$contentType]['language']['iso639_1'] ?>"><?php echo $data[$contentType]['language']['name'] ?></a></li>
        </ul>
        <!-- Headings -->
        <div class="card-heading">
            <!-- Header -->
            <div class="card-header">
                <!-- Title -->
                <ul class="card-informations">
                    <li>
                        <?php
                        echo $this->Form->postLink($this->Html->icon('trash-o'), ['action' => 'delete', $data['id']], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $data->id), 'escape' => false, 'class' => 'btn btn-danger btn-xs']);
                        ?>
                    </li>
                    <li lang="<?php echo $data[$contentType]['language']['iso639_1'] ?>">
                        <?php echo $this->Html->iconT($cardIcon, $this->Html->link($itemTitle, ['prefix' => null, 'controller' => $data['model'], 'action' => 'view', $data['fkid']])); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->iconT('calendar', __d('elabs', 'Posted on: {0}', h($data['created']))); ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->iconT('user', __d('elabs', 'Author:'));
                        if (!empty($data['user_id'])):
                            echo $this->Html->link($data['name'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user_id']]);
                        else:
                            echo $data['name'];
                        endif;
                        ?>
                    </li>
                    <li>
                        <?php echo $this->Html->iconT($this->Html->checkIcon($data['allow_contact'], false), $data['email']); ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Content -->
        <div class="card-content">
            <?php echo $this->Html->displayMD($data['message'], ['protect' => true]) ?>
        </div>
    </div>
</div>
