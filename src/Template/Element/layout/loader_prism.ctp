<?php
echo $this->Html->css('prism.css', ['block' => true]);
$this->append('pageBottomScripts');
echo $this->Html->script('lib/prism.js');
?>
<script>
	$(document).ready(function () {
		$("code[class*='language']").addClass('line-numbers');
	});
</script>
<?php
$this->end();
