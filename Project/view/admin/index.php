<form action="<?php echo $this->getUrl('grid'); ?>" method = "POST" id="indexForm">
	<div id="indexMessage">
	</div>
	<div id="indexContent">
	</div>
</form>

<script type="text/javascript">
	jQuery(document).ready(function () {
		admin.setForm(jQuery('#indexForm'));
		admin.load();
	});
	
</script>