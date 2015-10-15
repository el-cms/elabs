<?php

echo $this->Html->css('codemirror.css', ['block' => true]);
$this->append('pageBottomScripts');
echo $this->Html->script('lib/codemirror.js');
echo $this->Html->script('lib/codemirror/active-line.js');
echo $this->Html->script('lib/codemirror/matchbrackets.js');
echo $this->Html->script('lib/codemirror/modes/markdown.js');
echo $this->Html->script('lib/codemirror/modes/xml.js');
?>
<script>
	var myCodeMirror = CodeMirror.fromTextArea(
					document.getElementById("textArea"),
					{
						lineNumbers: true,
						lineWrapping: true,
						mode: "markdown",
						styleActiveLine: true,
						theme:"elegant"
					}
	);
</script>
<?php

$this->end();
