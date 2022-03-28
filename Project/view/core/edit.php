<form action="<?php echo  $this->getEditUrl() ?>" method="POST" class="p-2">
<?php echo $this->getTab()->toHtml(); ?>
<?php echo $this->getTabContent()->toHtml(); ?>
</form>