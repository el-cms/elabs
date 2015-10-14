<?php
echo $this->Html->script('lib/prism.js');
echo $this->Html->css('prism.css', ['block' => true]);
?>
<script>
	$(document).ready(function () {
		$("[class*='language']").addClass('line-numbers');
	});
</script>
