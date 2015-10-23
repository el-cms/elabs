<?php
/**
 * This element loads the CodeMirror scripts and activates CodeMirror for the 
 * given textareas.
 * 
 * Call:
 * -----
 * echo $this->element('layout/loader_codemirror', 
 *   ['texareas' => [
 *     'txt1',
 *     'txt2',
 *     ...
 *     ]]);
 */
echo $this->Html->css('codemirror.css', ['block' => true]);
$this->append('pageBottomScripts');
echo $this->Html->script('lib/codemirror.js');
echo $this->Html->script('lib/codemirror/active-line.js');
echo $this->Html->script('lib/codemirror/matchbrackets.js');
echo $this->Html->script('lib/codemirror/modes/markdown.js');
echo $this->Html->script('lib/codemirror/modes/xml.js');
?>
<script>
<?php
if(!isset($textareas)):
    $textareas=[];
endif;
foreach ($textareas as $area):
    ?>
    		var <?php echo $area ?>CodeMirror = CodeMirror.fromTextArea(
    						document.getElementById("<?php echo $area ?>"),
    						{
    							lineNumbers: true,
    							lineWrapping: true,
    							mode: "markdown",
    							styleActiveLine: true,
    							theme: "elegant"
    						}
    		);
<?php endforeach; ?>
</script>
<?php
$this->end();
