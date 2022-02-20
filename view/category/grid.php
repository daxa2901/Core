<?php $result = $this->getCategory(); ?>
<?php $getCategoryToPath = $this->getCategoryToPath(); ?>
<div class = 'container'style="text-align: center; ">
	<h1> Category Details </h1> 
	<form action="index.php?c=category&a=add" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>

	<div id='info'>
		<table border=1 width=100%>
			<tr>
				<th> Id </th>
				<th> Name </th>
				<th> Created_At </th>
				<th> Updated_At </th>
				<th> Status </th>
				<th> Action </th>
			</tr>
			<?php if($result): ?>
				<?php foreach ($result as $row):?>
					<tr>
			    		<td><?php echo $row["categoryId"] ?></td>
			    		<td><?php echo $getCategoryToPath[$row['categoryId']];?>
			    		</td>
			    		<td><?php echo $row["createdAt"] ?></td>
			    		<td><?php echo $row["updatedAt"] ?></td>
			    		<td>
				    		<?php if ($row['status'] == 1): ?>
				    			<?php echo ' Active '; ?>
				    		<?php else: ?>
				    			<?php echo ' InActive '; ?>
				    		<?php endif;?>
			    		</td>
			    		<td>
			    			<a href="index.php?c=category&a=delete&id=<?php echo $row['categoryId'] ?>">Delete</a> 
			    			<a href="index.php?c=category&a=edit&id=<?php echo $row['categoryId'] ?>">Update</a>
			    		</td>
			   		</tr>
			  	<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan='8'>No Record Available</td>
				</tr>		
			<?php endif; ?>
		</table>
	</div>	
</div>
