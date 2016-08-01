<?php
/*
 * File:
 *   src/Templates/Pages/about.ctp
 * Description:
 *   Site's About page
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'About'));

$this->Html->addCrumb(__d('elabs', 'About'));

// Block: Page links
// -----------------
$this->start('pageLinks');
$linkOptions = ['escape' => false, 'class' => 'list-group-item', 'target' => "_blank"];
echo $this->Html->link($this->Html->iconT('github', __d('elabs', 'Elabs on Github')), 'https://github.com/el-cms/elabs', $linkOptions);
echo $this->Html->link($this->Html->iconT('external-link', 'CakePHP'), 'http://cakephp.org', $linkOptions);
echo $this->Html->link($this->Html->iconT('external-link', 'Bootflat'), 'http://bootflat.github.io', $linkOptions);
echo $this->Html->link($this->Html->iconT('external-link', 'FontAwesome'), 'http://fontawesome.io', $linkOptions);
echo $this->Html->link($this->Html->iconT('external-link', 'CakePHP - Gravatar plugin'), 'https://github.com/LowG33kDev/cakephp-gravatar-plugin/', $linkOptions);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<h2>Why ?</h2>
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempor laoreet ex eu sollicitudin. Nunc eu est imperdiet, sodales est eu, ullamcorper felis. Cras libero purus, laoreet eget tempor sed, pellentesque vitae orci. Nulla id neque et nisl auctor congue. In mi purus, suscipit in urna sed, mattis sollicitudin neque. In non consectetur sapien. Maecenas aliquet sollicitudin quam id auctor. Fusce eros neque, tristique vel tincidunt volutpat, consectetur ut massa. Donec ac urna nibh.
</p>
<h2>What (the tools) ?</h2>
<p>
    Proin porta ullamcorper sem ut blandit. Pellentesque vitae magna mi. Nam pretium tempor quam vel semper. Etiam lacinia orci eget tellus elementum, scelerisque elementum elit posuere. Sed quis purus nunc. Mauris ac lectus nunc. Integer in lectus ac nisi tincidunt laoreet non id libero. Vivamus leo libero, convallis eget ipsum vitae, bibendum venenatis orci. Donec luctus rhoncus gravida. Maecenas aliquam, turpis at venenatis porta, lorem justo consequat metus, ac lacinia arcu dolor in ipsum.
<ul>
    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
    <li>Morbi iaculis nibh eget neque rhoncus, in pellentesque dolor viverra.</li>
</ul>
</p>
<h2>For who ?</h2>
<p>
    Duis blandit volutpat justo a cursus. Suspendisse quis vestibulum justo. Quisque sagittis mattis justo, id consequat nunc ultrices ultrices. Suspendisse a est id augue egestas elementum. Phasellus sem nunc, tempus at elementum aliquet, venenatis vel lacus. Praesent vitae lectus at quam cursus lobortis. Cras vel sem iaculis, convallis velit ut, ullamcorper massa. Fusce mollis odio in orci egestas hendrerit. Nam sed fermentum leo, vestibulum fermentum nisi. In ut nunc in elit condimentum porttitor at nec nulla. Quisque dapibus porta elit, in suscipit tellus mollis ac. Nullam laoreet semper interdum. Proin pretium dui eu dui fermentum molestie.
</p>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
