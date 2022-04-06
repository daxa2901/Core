<?php $tabs = $this->getTabs(); ?>

<?php foreach($tabs as $key=>$tab): ?>
	<li class="list-group-item">
                    <a class=" <?php echo $key ?>" href="<?php echo $tab['url']; ?>" <?php if($this->getCurrentTab() == $key) :?> style  = "color: red;" <?php endif; ?>  ><?php echo $tab['title'] ?></a>
          </li>
                  
<?php endforeach; ?>
<script type="text/javascript">
<?php foreach($tabs as $key=>$tab): ?>
	jQuery('.<?php echo $key ?>').click(function (event) {
		event.preventDefault();
		admin.setUrl(jQuery(this).attr('href'));
		admin.load();
	})
<?php endforeach; ?>
</script>