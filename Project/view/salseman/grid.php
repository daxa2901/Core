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
			    		<td> <a href="<?php echo  $this->getUrl('grid','salseman_customer',['id'=>$row->salsemanId],true);?>">Manage Customer</a> </td>
			    		<td>
			    			<a href="<?php echo  $this->getUrl('delete',null,['id'=>$row->salsemanId],true);?>">Delete</a> 
			    			<a href="<?php echo  $this->getUrl('edit',null,['id'=>$row->salsemanId],true);?>">Update</a>
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='11'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>	
	</div>
</div>
