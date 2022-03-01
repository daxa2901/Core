<?php $children = $this->getChildren(); ?>

<?php foreach ($children as $child): ?>
 	<?php $child->toHtml(); ?>
 <?php endforeach ?>
 