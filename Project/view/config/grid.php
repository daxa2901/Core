<?php $configs = $this->getConfigs(); ?>
<div class='container' style="text-align: center; ">
<h1> Config Details </h1> 
<form action=<?php echo $this->getUrl('add');?> method="POST">
	<button type="submit" name="Add" class="Registerbtn"> Add New </button>
</form>

<div id='info'>
<table border=1 width=100%>
	<tr>
		<th> Id </th>
		<th> Name </th>
		<th> Code </th>
		<th> Value </th>
		<th> Status </th>
		<th> Created_At </th>
		<th> Action </th>
	</tr>
	<?php if($configs): ?>
	
		<?php foreach ($configs as $config): ?>		
			<tr>
	    		<td><?php echo $config->configId ?></td>
	    		<td><?php echo $config->name ?></td>
	    		<td><?php echo $config->code ?></td>
	    		<td><?php echo $config->value ?></td>
	    		<td><?php echo $config->getStatus($config->status); ?></td>
	    		<td><?php echo $config->createdAt ?></td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$config->configId]);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$config->configId]);?>">Update</a>
	    		</td>
	    	</tr>
	  	<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan='8'>No Record Available</td></tr>
	<?php endif; ?>

</table>
</div>
<script type="text/javascript">
function changeURL(val) 
{
	window.location = "<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart(),'ppc'=>null]);?>&ppc="+val; 
}

</script>
<table  align="center" cellspacing="20">
	<tr>
		<td> 
			<select name="perPageCountOption" onchange="changeURL(this.value)" id='ppc'>
					<option value="">select Per Page Count Option</option>
				<?php foreach ($this->getPager()->getPerPageCountOption() as $key => $value) : ?>
					<option value="<?php echo $value ?>"> <?php echo $value ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()]) ?>" <?php if(!$this->getPager()->getStart()): ?> style = "pointer-events : none;" <?php endif; ?>>Start</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()]) ?>"<?php if(!$this->getPager()->getPrev()): ?> style = "pointer-events : none;"<?php endif; ?>>Previous</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getCurrent()]) ?>">Current</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()]) ?>" <?php if(!$this->getPager()->getNext()): ?> style = "pointer-events : none;" <?php endif; ?>>Next</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()]) ?>" <?php if(!$this->getPager()->getEnd()): ?> style = "pointer-events : none;" <?php endif; ?>>End</a></td>
	</tr>
</table>	

