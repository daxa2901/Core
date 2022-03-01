<?php $products = $this->getProducts(); ?>
<div class='container' style="text-align: center; ">
<h1> Product Details </h1> 
<form action=<?php echo $this->getUrl('add');?> method="POST">
	<button type="submit" name="Add" class="Registerbtn"> Add New </button>
</form>

<div id='info'>
<table border=1 width=100%>
	<tr>
		<th> Id </th>
		<th> Name </th>
		<th> Price </th>
		<th> Quantity </th>
		<th> Created_At </th>
		<th> Updated_At </th>
		<th> Status </th>
		<th> Media </th>
		<th> Action </th>
	</tr>
	<?php if($products): ?>
	
		<?php foreach ($products as $row): ?>		
			<tr>
	    		<td><?php echo $row->productId ?></td>
	    		<td><?php echo $row->name ?></td>
	    		<td><?php echo $row->price ?></td>
	    		<td><?php echo $row->quantity ?></td>
	    		<td><?php echo $row->createdAt ?></td>
	    		<td><?php echo $row->updatedAt ?></td>
	    		<td><?php echo  $row->getStatus($row->status) ?> </td>
	    		<td><a href="<?php echo $this->getUrl('grid','product_media',['id'=>$row->productId],true);?>">Media</a> </td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$row->productId],true);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$row->productId],true);?>">Update</a>
	    		</td>
	    	</tr
	  	<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan='8'>No Record Available</td></tr>
	<?php endif; ?>

</table>
</div>