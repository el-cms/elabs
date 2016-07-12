<?php

namespace App\View\Helper;

use Cake\Core\Configure;

/**
 * CakePHP AppHtmlHelper
 * @author mtancoigne
 */
class AppHtmlHelper extends \BootstrapUI\View\Helper\HtmlHelper
{
    public $helpers = ['Url', 'Html', 'Markdown'];
    public $config = [];

    /**
     * Creates an icon.
     * 
     * This method surcharges the icon() method from BootstrapUI :
     *  - fixed width by default
     *  - fontAwesome by default
     * 
     * Additionnal options :
     *  - fixed If true, an fa-fw class will be applied (default)
     * 
     * @param string $name Icon name
     * @param array $options
     * @return string
     */
    public function icon($name, array $options = [])
    {
        $options += [
            'iconSet' => 'fa',
            'fixed' => true,
            'class' => null
        ];
        if ($options['fixed']) {
            $this->injectClasses($options['iconSet'] . '-fw', $options);
        }
        unset($options['fixed']);
        return parent::icon($name, $options);
    }

    public function arrayToString(array $array, array $options = [])
    {
        $options+=[
            'uppercase' => true,
            'and' => true,
        ];
        $i = 1;
        $count = count($array);
        $out = '';
        foreach ($array as $item) {
            $separator = null;
            if ($i > 1) {
                $separator = ', ';
            }
            if ($i == $count && $options['and'] && $i > 1) {
                $separator = __(' et ');
            }
            $out.=$separator . (($options['uppercase']) ? ucfirst($item) : $item);
            $i++;
        }
        return $out;
    }

    /**
     * Create a link to display the page report modal
     * 
     * @param mixed $target string or array, the current page
     * @param array $options an array of options
     * @return string
     * 
     * Options:
     *  icon :  mixed (string, bool), null, an icon to place before the link
     *  
     * 
     */
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

    /**
     * Display markdown text
     * 
     * @param string $text
     * @param array $options
     * @return string
     * 
     * Options: 
     *  raw : bool, false, return raw text with no formatting (text will be escaped)
     *  protect : bool, false, Escape content. this value will overwrite cms.escapeMarkdown
     */
    public function displayMD($text, $options = [])
    {
        $options+=[
            'raw' => false,
            'protect' => false //
        ];


        if ($options['protect'] === true || \Cake\Core\Configure::read('cms.escapeMarkdown') === true || $options['raw'] === true) {
            $text = h($text);
        }

        if (!$options['raw']) {
            $text = $this->Markdown->transform($text);
        }

        return $text;
    }
}