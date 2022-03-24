<!DOCTYPE html>
<html>
	<?php echo $this->getHead()->toHtml(); ?>
<body>
	<table  class="w-100">
		<tr>
			<td> <?php echo $this->getHeader()->toHtml(); ?></td>
		</tr>	
		<tr>
			<td> <?php echo $this->getContent()->toHtml(); ?></td>
		</tr>	
		<tr>
			<td> <?php echo $this->getFooter()->toHtml(); ?></td>

		</tr>	
	</table>
</body>
</html>