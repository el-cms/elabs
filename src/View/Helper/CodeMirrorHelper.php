<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * CakePHP CodeMirror helper
 *
 * Creates and returns CodeMirror activation scripts.
 */
class CodeMirrorHelper extends Helper
{
    /**
     * Array of codeMirror definitions.
     *
     * @var array
     */
    private $_stack = [];

    /**
     * List of helper used by this one
     * @var array
     */
    public $helpers = ['Html'];

    /**
     * Creates a CodeMirror definition for a given field target (field ID)
     *
     * @param string $target Target's ID
     * @param array $options Array of CodeMirror options.
     * @param array $additionnalCode Other instructions to execute
     *
     * Default options are :
     *   - lineNumbers: bool, Show line numbers
     *   - lineWrapping: bool, Wrap lines
     *   - mode: string, Writing mode (def. markdown)
     *   - styleActiveLine: bool, Highlight the active line
     *   - theme: string, Theme to use (if CSS exists)
     *
     * Example with additionnalCode:
     *
     *   $this->CodeMirror->add('fieldId', [], ['{0}.setSize("500","300")'])
     *
     *   This will create a
     *     fieldIdCodeMirror.setSize("500", "300");
     *   instruction after the declaration.
     *
     * @return void
     */
    public function add($target, $options = [], $additionnalCode = [])
    {
        // You can add other default values if you want to set ones...
        // List : http://codemirror.net/doc/manual.html#config
        $defaults = [
            'lineNumbers' => true,
            'lineWrapping' => true,
            'mode' => 'markdown',
            'styleActiveline' => true,
            'theme' => 'elegant',
        ];
        foreach ($options as $k => $v) {
            $defaults[$k] = $v;
        }

        $elementName = $target . 'CodeMirror';

        $element = 'var ' . $elementName . ' = CodeMirror.fromTextArea(
    						document.getElementById("' . $target . '"),
    						' . json_encode($defaults) . '
    		);';
        foreach ($additionnalCode as $a) {
            $element .= sprintf($a . ';', $elementName);
        }
        $this->_stack[$elementName] = $element;
    }

    /**
     * Returns all the codemirror configuration and styles.
     * @return string
     */
    public function scripts()
    {
        $out = $this->Html->css('codemirror.css', ['block' => true]) .
                $this->Html->script('lib/codemirror.js') .
                $this->Html->script('lib/codemirror/active-line.js') .
                $this->Html->script('lib/codemirror/matchbrackets.js') .
                $this->Html->script('lib/codemirror/modes/markdown.js') .
                $this->Html->script('lib/codemirror/modes/xml.js') .
                $this->Html->script('toolbar.js') .
                '<script>';
        $i = 0;

        // Toolbars
        foreach ($this->_stack as $editor => $cm) {
            $out .= $cm;
            $out .= 'cm_toolbar(' . $editor . ', \'' . $editor . '\');';
            $i++;
        }
        $out .= '</script>';

        return $out;
    }
}
