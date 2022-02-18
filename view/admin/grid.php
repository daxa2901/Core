<?php $result = $this->getAdmin(); ?>

<div class='container' style="text-align: center; ">
	<h1> Admin Details </h1> 
	<form action="index.php?c=admin&a=add" method="POST">
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
			<?php if($result): ?>
				<?php foreach ($result as $row): ?>
					<tr>
			      		<td><?php echo $row["adminId"] ?></td>
			    		<td><?php echo $row["firstName"] ?></td>
			    		<td><?php echo $row["lastName"] ?></td>
			    		<td><?php echo $row["email"] ?></td>
			    		<td><?php echo $row["password"] ?></td>
			    		<td><?php echo $row["mobile"] ?></td>
			    		<td>
				    		<?php if ($row['status'] == 1): ?>
				    			<?php echo 'Active'; ?>
				    		<?php else: ?>
				    			<?php echo 'InActive'; ?>
				    		<?php endif; ?>
			    		</td>
			    		<td><?php echo $row["createdDate"] ?></td>
			    		<td><?php echo $row["updatedDate"] ?></td>
			    		<td>
			    			<a href="index.php?c=Admin&a=delete&id=<?php echo $row['adminId'] ?>">Delete</a> 
			    			<a href="index.php?c=Admin&a=edit&id=<?php echo $row['adminId']?>">Update</a>
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>	
	</div>
</div>
