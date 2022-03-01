<?php $vendors = $this->getVendors(); ?>

<div class='container' style="text-align: center; ">
<h1> Vendor Details </h1> 
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
		<th> Status </th>
		<th> Address </th>
		<th> Create Date </th>
		<th> Update Date </th>
		<th> Action </th>
	</tr>
	<?php if($vendors):?>
		<?php foreach ($vendors as $row): ?>
			 
			<tr>
	      		<td><?php echo $row->vendorId; ?></td>
	    		<td><?php echo $row->firstName; ?></td>
	    		<td><?php echo $row->lastName; ?></td>
	    		<td><?php echo $row->email; ?></td>
	    		<td><?php echo $row->mobile; ?></td>
	    		<td><?php echo  $row->getStatus($row->status) ?> </td>
	    		<td> <?php echo $row->address; ?> </td>
	    		<td><?php echo $row->createdAt; ?></td>
	    		<td><?php echo $row->updatedAt; ?></td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$row->vendorId],true);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$row->vendorId],true);?>">Update</a>
	    		</td>
	   		</tr>
	 	<?php endforeach;?>
	<?php else:?>
		<tr><td colspan='10'>No Record Available</td></tr>			
	<?php endif; ?>

	</table>
</div>
