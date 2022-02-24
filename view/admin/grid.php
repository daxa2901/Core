<?php $admins = $this->getAdmins(); ?>

<div class='container' style="text-align: center; ">
	<h1> Admin Details </h1> 
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
				<th> Password </th>
				<th> Mobile </th>
				<th> Status </th>
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Action </th>
			</tr>
			<?php if($admins): ?>
				<?php foreach ($admins as $row): ?>
					<tr>
			      		<td><?php echo $row->adminId ?></td>
			    		<td><?php echo $row->firstName ?></td>
			    		<td><?php echo $row->lastName ?></td>
			    		<td><?php echo $row->email ?></td>
			    		<td><?php echo $row->password ?></td>
			    		<td><?php echo $row->mobile ?></td>
			    		<td><?php echo $row->getStatus($row->status) ?> </td>
			    		<td><?php echo $row->createdDate ?></td>
			    		<td><?php echo $row->updatedDate ?></td>
			    		<td>
			    			<a href="<?php echo  $this->getUrl('delete',null,['id'=>$row->adminId],true);?>">Delete</a> 
			    			<a href="<?php echo  $this->getUrl('edit',null,['id'=>$row->adminId],true);?>">Update</a>
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>	
	</div>
</div>
