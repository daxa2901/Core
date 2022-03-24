<?php $customers = $this->getCustomers(); ?>

<div class='container text-center'>
<h1> Salseman Customer Details </h1> 
<form action="<?php echo $this->getUrl('save');?>"" method="POST">
	<button type="submit" class="btn btn-primary"> Update </button>

	<a href="<?php echo $this->getUrl('grid','salseman',['id'=>null]);?>"><button type="button" class="btn btn-danger">Cancel</button></a>
		

	<div class="container w-100 my-2">
	<table class="table table-light shadow-sm">
		<tr>
			<th> Select Customers </th>
			<th> Id </th>
			<th> Name </th>
			<th> Manage Customer Price </th>
			
		</tr>
		<?php if($customers): ?>
			<?php foreach ($customers as $row): ?>		
				<tr>
		    		<td><input type="checkbox" name="customer[]"  value = "<?php echo $row->customerId ?>" <?php if($row->salsemanId): ?> checked disabled<?php endif; ?>></td>
					<td><?php echo $row->customerId ?></td>
					<td><?php echo $row->firstName .' '. $row->lastName ?></td>
					<td>
					<?php if($row->salsemanId): ?> 
	
						<a href="<?php echo $this->getUrl('grid','salseman_customer_price',['id'=>$row->salsemanId,'customerId'=>$row->customerId],true);?>">Manage Customer Price</a> 
					<?php endif; ?>
	    		</td>
		    		</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='4'>No Customer Available</td></tr>
		<?php endif; ?>
	</form>
	</table>
	
</div></div>
