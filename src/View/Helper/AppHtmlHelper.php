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
     * Options :
     *  - fixed: bool, If true, an fa-fw class will be applied (default)
     *  - iconSet: string, icon prefix (usually 'glyphicon' or 'fa')
     *  - class: Additionnal classes for the icon.
     *
     * @param string $name Icon name or space separated names (ie: 'home' or 'home 3x')
     * @param array $options An array of options
     *
     * @return string
     */
    public function icon($name, array $options = [])
    {
        $options += [
            'iconSet' => 'fa',
            'fixed' => true,
            'class' => null
        ];
        $names = explode(' ', $name);
        foreach ($names as $string) {
            $options = $this->injectClasses($options['iconSet'] . '-' . $string, $options);
        }
        if ($options['fixed']) {
            $options = $this->injectClasses($options['iconSet'] . '-fw', $options);
        }
        unset($options['fixed']);

        return parent::icon($name, $options);
    }

    /**
     * Returns an icon with some text nearby.
     *
     * @param string $icon Icon name
     * @param string $text Text to be placed next to the icon
     * @param array $options Array of options for the icon (see icon() for a detailed list)
     *
     * @return string
     */
    public function iconT($icon, $text, $options = [])
    {
        $options += [
            'revert' => false // Reverse the icon place
        ];
        $revert = $options['revert'];
        unset($options['revert']);
        if ($revert) {
            return __d('elabs', '{0}&nbsp;{1}', [$text, $this->icon($icon, $options)]);
        } else {
            return __d('elabs', '{0}&nbsp;{1}', [$this->icon($icon, $options), $text]);
        }
    }

    /**
     * Joins the differents strings from a given array, with a separator
     *
     * Options:
     *   - uppercase: bool, Sets the first letter of the final string uppercase.
     *   - and: bool, Set the last separator as a "and" string
     *
     * @param array $array The array of strings
     * @param array $options An array of options
     *
     * @return string
     */
    public function arrayToString(array $array, array $options = [])
    {
        $options += [
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
                $separator = __d('elabs', ' {0} ', ['and']);
            }
            $out .= $separator . $item;
            $i++;
        }

        return (($options['uppercase']) ? ucfirst($out) : $out);
    }

    /**
     * Create a link to display the page report modal
     *
     * Options:
     *   - icon:  mixed (string, bool), null, an icon to place before the link
     *   - title: string, null Alternative text
     *
     * @param mixed $target string or array, the current page
     * @param array $options an array of options
     *
     * @return string
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
            $linkTitle = (!$options['icon']) ? $titleText : $this->iconT('flag', $titleText);
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
     * Options:
     *   - raw: bool, false, return raw text with no formatting (text will be escaped)
     *   - protect: bool, false, Escape content. This value will overwrite cms.escapeMarkdown
     *
     * @param string $text Raw markdown text
     * @param array $options An array of options
     *
     * @return string
     */
    public function displayMD($text, $options = [])
    {
        $options += [
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

    /**
     * Creates a label with language attributes.
     * Use label=false to remove the label class from it.
     *
     * @param string $content Content of the label
     * @param string $isoCode ISO639-1 code (2 letters)
     * @param array $options An array of options
     * @return string
     */
    public function langLabel($content, $isoCode, $options = [])
    {
        $options += [
            'class' => null,
            'label' => true,
            'tag' => 'span',
        ];
        if ($options['label']) {
            $options = $this->injectClasses('label label-language', $options);
        }
        $tag = $options['tag'];

        $options['lang'] = $isoCode;

        unset($options['label']);
        unset($options['tag']);

        return $this->tag($tag, $content, $options);
    }

    /**
     * Create an icon with a checkmark or an empty circle
     *
     * @param bool $value Value used to create the icon
     * @param bool $returnIcon If fals, function will only return icon class.
     * @return string
     */
    public function checkIcon($value, $returnIcon = false)
    {
        $icon = ($value) ? 'check-circle-o' : 'circle-o';
        if ($returnIcon) {
            return $this->icon($icon);
        } else {
            return $icon;
        }
    }
}
