<?php

namespace App\View\Helper;

use Cake\Core\Configure;

/**
 * CakePHP AppHtmlHelper
 * @author mtancoigne
 */
class AppHtmlHelper extends \BootstrapUI\View\Helper\HtmlHelper
{
    public $helpers = ['Url'];
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
}
