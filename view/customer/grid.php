<?php $result = $this->getCustomers(); ?>
<?php $address = $this->getAddress();  ?>

<div class='container' style="text-align: center; ">
<h1> Customer Details </h1> 
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
	<?php if($result):?>
		<?php foreach ($result as $index => $value): ?>
			 
			<tr>
	      		<td><?php echo $value->customerId; ?></td>
	    		<td><?php echo $value->firstName; ?></td>
	    		<td><?php echo $value->lastName; ?></td>
	    		<td><?php echo $value->email; ?></td>
	    		<td><?php echo $value->mobile; ?></td>
	    		<td><?php echo  $value->getStatus($value->status) ?> </td>
	    		<td> <?php echo $address[$index]->address;?> </td>
	    		<td><?php echo $value->createdDate; ?></td>
	    		<td><?php echo $value->updatedDate; ?></td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$value->customerId],true);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$value->customerId],true);?>">Update</a>
	    		</td>
	   		</tr>
	 	<?php endforeach;?>
	<?php else:?>
		<tr><td colspan='10'>No Record Available</td></tr>			
	<?php endif; ?>

	</table>
</div>
