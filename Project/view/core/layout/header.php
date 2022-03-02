<?php $children = $this->getMenu(); ?>
<?php foreach ($children as $key => $child): ?>
	<?php $child->toHtml();?>
<?php endforeach ; ?>