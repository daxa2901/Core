<?php $children = $this->getChildren(); ?>

<?php foreach ($children as $child): ?>
 	<?php echo $child->toHtml(); ?>
 <?php endforeach ?>
 