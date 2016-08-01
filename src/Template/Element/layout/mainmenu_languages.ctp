<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php echo __d('elabs', 'Language') ?>
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <?php
        foreach ($availableLanguages as $lang):
            ?>
            <li>
                <?php
                $icon = null;
                if ($lang['iso639_1'] === $siteLanguage):
                    $icon = 'check-circle-o';
                else:
                    $icon = 'circle-o';
                endif;
                echo $this->Html->link($this->Html->iconT($icon, $lang['name']), ['plugin' => null, 'prefix' => false, 'action' => 'changeLanguage', $lang['translation_folder']], ['escape' => false]);
                ?>
            </li>
            <?php
        endforeach;
        ?>

    </ul>
</li>