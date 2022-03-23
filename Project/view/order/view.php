<?php $order = $this->getOrder(); ?>

<div class="d-block mx-auto border" id='cart'> 

	<div class="container w-100 my-2" id='order'>
		<table class="w-100 border text-center">
			<thead >
				<th colspan="4"><h3> <b>Customer Details</b></h3></th>
			</thead>
			<thead >            			
				<th>First Name</th>
				<th>Last Name </th>
				<th>Mobile </th>
				<th>Email </th>
			</thead>
			<?php if ($order):?>
				<tr>
					<td><?php echo $order->firstName ?></td>
					<td><?php echo $order->lastName ?></td>
					<td><?php echo $order->mobile ?></td>
					<td><?php echo $order->email ?></td>
				</tr>
		    <?php else: ?>
		    	<tr>
		    		<td colspan="2"> <h5>No Customer available</h5></td>
		    	</tr>
		    <?php endif; ?>
		</table>
	</div>

	<br>
	<div class="container w-100 mx-auto">
		<?php echo $this->getAddress()->toHtml(); ?>
	</div>
	
	<br>
	<div class="container w-100 " id='paymentMethod'>
		<div class="row ">
        	<div class="col-sm-6 ">
				<?php echo $this->getPaymentMethod()->toHtml(); ?>
	        </div>
    	    <div class="col-sm-6">
				<?php echo $this->getShippingMethod()->toHtml(); ?>
	        </div>
    	</div>
	</div>
	<br>
	<div class="container w-100 border p-2">
		<?php echo $this->getItems()->toHtml(); ?>
	</div>
</div>
