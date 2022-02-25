<?php $result = $this->getCategory(); ?>
<?php $getCategoryToPath = $this->getCategoryToPath(); ?>
<div class = 'container'style="text-align: center; ">
	<h1> Category Details </h1> 
	<form action="<?php echo  $this->getUrl('add');?>" method="POST">
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
			    		<td><?php echo $row->categoryId ?></td>
			    		<td><?php echo $getCategoryToPath[$row->categoryId];?>
			    		</td>
			    		<td><?php echo $row->createdAt ?></td>
			    		<td><?php echo $row->updatedAt ?></td>
			    		<td>
				    		<?php echo $row->getStatus($row->status) ?>
			    		</td>
			    		<td>
			    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$row->categoryId],true);?>">Delete</a> 
			    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$row->categoryId],true);?>">Update</a>
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
