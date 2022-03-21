<?php $salsemans = $this->getSalsemans(); ?>

<div class='container' style="text-align: center; ">
	<h1> Salseman Details </h1> 
	<form action="<?php echo  $this->getUrl('add');?>" method="POST">
	<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>
	
	<div id='info'>
		<table border=1 width=100%>
			<tr>
				<th> Id </th>
				<th> First Name </th>
				<th> Last Name </th>
				<th> Email </th>
				<th> Mobile </th>
				<th> Percentage </th>
				<th> Status </th>
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Manage Customer </th>
				<th> Action </th>
			</tr>
			<?php if($salsemans): ?>
				<?php foreach ($salsemans as $row): ?>
					<tr>
			      		<td><?php echo $row->salsemanId ?></td>
			    		<td><?php echo $row->firstName ?></td>
			    		<td><?php echo $row->lastName ?></td>
			    		<td><?php echo $row->email ?></td>
			    		<td><?php echo $row->mobile ?></td>
			    		<td><?php echo $row->percentage ?></td>
			    		<td><?php echo $row->getStatus($row->status) ?> </td>
			    		<td><?php echo $row->createdAt ?></td>
			    		<td><?php echo $row->updatedAt ?></td>
			    		<td> <a href="<?php echo  $this->getUrl('grid','salseman_customer',['id'=>$row->salsemanId,'p'=>1]);?>">Manage Customer</a> </td>
			    		<td>
			    			<a href="<?php echo  $this->getUrl('delete',null,['id'=>$row->salsemanId]);?>">Delete</a> 
			    			<a href="<?php echo  $this->getUrl('edit',null,['id'=>$row->salsemanId]);?>">Update</a>
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='11'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>	
	</div>
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
					<option value="<?php echo $value ?>" <?php if($this->getPager()->getPerPageCount() == $value):  ?> selected <?php endif; ?>> <?php echo $value ?></option>
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


