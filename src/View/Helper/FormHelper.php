<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\View\Helper;

/**
 * CakePHP FormHelper
 * @author mtancoigne
 */
class FormHelper extends \BootstrapUI\View\Helper\FormHelper
{

    /**
     * Custom datetime widget
     *
     * @param string $fieldName Name of the field
     * @param array $options An array of options
     *
     * @return string HTML widget
     */
    public function dateTime($fieldName, array $options = [])
    {
        $options += [
            // Base options, not sure of the ones to keep
            'empty' => false,
            'value' => null,
            'interval' => 1,
            'round' => null,
            'monthNames' => true,
            'minYear' => null,
            'maxYear' => null,
            'orderYear' => 'desc',
            'timeFormat' => 24,
            // New widget options
            'notAfterNow' => false, // disable dates in the future
        ];
        $options = $this->_initInputField($fieldName, $options);
        $options = $this->_datetimeOptions($options);

        return $this->dateTimeWidget('datetime', $options);
    }

    /**
     * Creates the datetime widget
     *
     * @param type $fieldName Field name
     * @param array $options Array of options
     *
     * @return string
     */
    public function dateTimeWidget($fieldName, array $options = [])
    {
        $options['type'] = 'text';
        $options['label'] = false;
        $options['div'] = false;
        //Field
        $input = $this->input($fieldName, $options);
        // Script
        $script = '<script type="text/javascript">
            $(function () {
                $(\'#' . $options['id'] . '\').datetimepicker({
                    locale: "fr",
                    format: "YYYY-MM-DD HH:mm:ss",
                    sideBySide: true,
                    useCurrent: true,
                    inline:true,
                    focusOnShow:false,
                    stepping: 15,
                    ' . (($options['notAfterNow']) ? 'maxDate:moment(),' : '') . '
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: "fa fa-chevron-left",
                        next: "fa fa-chevron-right",
                        today: "fa fa-target",
                        clear: "fa fa-trash-o",
                        close: "fa fa-times"
                    }
                });
            });
        </script>';
//        debug(var_export(['Field'=>$fieldName, 'options'=>$options, 'Return'=>$input.$script], true));
        return $input . $script;
    }
}
