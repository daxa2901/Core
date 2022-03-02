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
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$config->configId],true);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$config->configId],true);?>">Update</a>
	    		</td>
	    	</tr>
	  	<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan='8'>No Record Available</td></tr>
	<?php endif; ?>

</table>
</div>
