<?php $data = $this->getProducts();?>


<div class='container' style="text-align: center; ">
<h1>  Customer Price Details </h1> 
<form action=<?php echo $this->getUrl('save');?> method="POST">
	<button type="submit" class="Registerbtn"> Update </button>

	<a href="<?php echo $this->getUrl('grid','salseman_customer');?>"><button type="button" class="cancel">Cancel</button></a>
		

	<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Customers Price </th>
			<th> Product Id </th>
			<th> Product Name </th>
			<th> Product Price </th>
			<th> Product Sku </th>
			<th> Salseman Price </th>
			
		</tr>
		<?php if($data): ?>
			<?php foreach ($data['products'] as $row): ?>		
				<tr>
		    		<td>
			    		<?php if($row->customerPrice):?>
			    			<input type="number" name="price[old][<?php echo $row->entityId ?>]" required min = "<?php echo $row->price - ($row->price/100) * $data['salseman']->percentage ?>" max = <?php echo $row->price ?> value = <?php echo $row->customerPrice ?>>
			    		<?php else: ?> 
			    			<input type="number" name="price[new][<?php echo $row->productId ?>]" min = "<?php echo $row->price - ($row->price/100) * $data['salseman']->percentage ?>" max = <?php echo $row->price ?> required value = "<?php echo $row->price ?>">
			    		<?php endif; ?>
		    		</td>
					<td><?php echo $row->productId ?></td>
					<td><?php echo $row->name ?></td>
					<td><?php echo $row->price ?></td>
					<td><?php echo $row->sku ?></td>
					<td><?php echo $row->price - ($row->price/100) * $data['salseman']->percentage ?></td>
					
		    		</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='6'>No Record Available</td></tr>
		<?php endif; ?>
	</form>
	</table>
	
</div></div>
