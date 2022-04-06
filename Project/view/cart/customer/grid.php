<?php $customer = $this->getCustomer(); ?>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
	<thead >
		<th colspan="4"><h3> <b>Customer Details</b></h3></th>
	</thead>
	<thead >            			
		<th>First Name</th>
		<th>Last Name </th>
		<th>Mobile </th>
		<th>Email </th>
	</thead>
	<?php if ($customer):?>
		<tr>
			<td><?php echo $customer->firstName ?></td>
			<td><?php echo $customer->lastName ?></td>
			<td><?php echo $customer->mobile ?></td>
			<td><?php echo $customer->email ?></td>
		</tr>
    <?php else: ?>
    	<tr>
    		<td colspan="2"> <h5>No Customer available</h5></td>
    	</tr>
    <?php endif; ?>
</table>