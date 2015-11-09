<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * CakePHP ElabsHelper
 */
class ElabsHelper extends Helper
{
    public $helpers = ['Html', 'Url'];

    public function reportLink($target = null, $options = [])
    {
        if (isset($options['title'])) {
            $titleText = $options['title'];
            unset($options['title']);
        } else {
            $titleText = __d('elabs', 'Report this');
        }

        if (isset($options['icon']) && $options['icon']) {
            $linkTitle = (!$options['icon']) ? $titleText : __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-flag"></span>', $titleText]);
            unset($options['icon']);
        } elseif (isset($options['icon']) && !$options['icon']) {
            $linkTitle = $titleText;
            unset($options['icon']);
        } else {
            $linkTitle = $titleText;
        }

        $options['escape'] = false;
        $options['data-toggle'] = 'modal';
        $options['data-target'] = '#reportModal';
        $options['data-itemtarget'] = (is_null($target) ? $this->Url->build() : $target); // The current page
        return $this->Html->Link($linkTitle, '#', $options);
    }
}
