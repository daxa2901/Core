<?php $data = $this->getProducts();?>

<div class='container text-center'>
<h1>  Customer Price Details </h1> 
<form action="<?php echo $this->getUrl('save');?>" method="POST" class="form-group">
	<button type="submit" class="btn btn-primary"> Update </button>

	<a href="<?php echo $this->getUrl('grid','salseman_customer');?>"><button type="button" class="btn btn-danger">Cancel</button></a>
		

	<div class="container w-100 my-2">
	<table class="table table-light shadow-sm" >
		<tr>
			<th> Customers Price </th>
			<th> Product Id </th>
			<th> Product Name </th>
			<th> Product Price </th>
			<th> Product Sku </th>
			<th> Salseman Price </th>
			
		</tr>
		<?php if($data['products']): ?>
			<?php foreach ($data['products'] as $row): ?>		
				<tr>
					<td>
			    		<?php if($row->customerPrice):?>
			    			<input type="float" name="price[exists][<?php echo $row->entityId ?>]" required step="0.01" min = "<?php echo floor($row->price - ($row->price/100) * $data['salseman']->percentage) ?>" max = <?php echo $row->price ?> value = <?php echo floor($row->customerPrice) ?> class="form-control ">
			    		<?php else: ?> 
			    			<input type="float" name="price[new][<?php echo $row->productId ?>]" step="0.01" min = "<?php echo floor($row->price - ($row->price/100) * $data['salseman']->percentage) ?>" max = <?php echo floor($row->price) ?> required value = "<?php echo $row->price ?>" class = "form-control ">
			    		<?php endif; ?>
		    		</td>
					<td><?php echo $row->productId ?></td>
					<td><?php echo $row->name ?></td>
					<td><?php echo $row->price ?></td>
					<td><?php echo $row->sku ?></td>
					<td><?php echo floor($row->price - ($row->price/100) * $data['salseman']->percentage) ?></td>
					
		    		</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='6'>No Record Available</td></tr>
		<?php endif; ?>
	</form>
	</table>
	
</div></div>
