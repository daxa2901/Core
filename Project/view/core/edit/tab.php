<?php $tabs = $this->getTabs(); ?>

<?php foreach($tabs as $key=>$tab): ?>
	<a href="<?php echo $tab['url']; ?>" <?php if($this->getCurrentTab() == $key) :?> style  = "color: red;" <?php endif; ?> class = "<?php echo $key ?>" ><?php echo $tab['title'] ?></a> 
<?php endforeach; ?>
<script type="text/javascript">
<?php foreach($tabs as $key=>$tab): ?>
	jQuery('.<?php echo $key ?>').click(function (event) {
		event.preventDefault();
		admin.setUrl(jQuery(this).attr('href'));
		// alert(admin.getUrl());
		admin.load();
	})
<?php endforeach; ?>
</script>