<?php $billingAddress = $this->getBillingAddress()  ?>
<?php $shippingAddress = $this->getShippingAddress()  ?>
<div class="row mx-auto">
	<div class="<?php if($billingAddress->same == 1):?> col-sm-12 <?php else: ?> col-sm-6 <?php endif; ?>" id="billingAddress">
		<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
			<thead >
				<th colspan="2"><h3> <b>Billing Address</b></h3></th>
			</thead>
			<?php if ($billingAddress):?>
				<tr>
				    <td>First Name :</td>
				    <td><?php echo $billingAddress->firstName; ?></td>
				</tr>
				  
				 <tr>
				    <td>Last Name :</td>
				    <td><?php echo $billingAddress->lastName; ?></td>
				  </tr>
				  
				 <tr>
				    <td>Mobile :</td>
				    <td><?php echo $billingAddress->mobile; ?></td>
				  </tr>
				
				 <tr>
				    <td>Email :</td>
				    <td><?php echo $billingAddress->email; ?></td>
				  </tr>
				  
				 <tr>
				    <td>Address</td>
				    <td><?php echo $billingAddress->address; ?></td>
				  </tr>
				  
				  <tr>
				    <td>City</td>
				    <td><?php echo $billingAddress->city; ?></td>
				  </tr>
				  <tr>
				    <td>State</td>
				    <td><?php echo $billingAddress->state; ?></td>
				  </tr>
				  <tr>
				    <td>Postal Code</td>
				    <td><?php echo $billingAddress->postalCode; ?></td>
				  </tr>
				  <tr>
				    <td>Country</td>
				    <td><?php echo $billingAddress->country; ?></td>
				  </tr>
			<?php endif; ?>
		</table>
	</div>
	<div class="col-sm-6">
		<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
			<thead>
				<th colspan="3"><h3> <b>Shipping Address</b></h3></th>
			</thead>
			<?php if ($shippingAddress):?>

		    	<tr>
				    <td>First Name :</td>
				    <td><?php echo $shippingAddress->firstName; ?></td>
				  </tr>
				  
				 <tr>
				    <td>Last Name :</td>
				    <td><?php echo $shippingAddress->lastName; ?></td>
				  </tr>
				  
				 <tr>
				    <td>Mobile :</td>
				    <td><?php echo $shippingAddress->mobile; ?></td>
				  </tr>
				
				 <tr>
				    <td>Email :</td>
				    <td><?php echo $shippingAddress->email; ?></td>
				  </tr>
				  
				 <tr>
				    <td>Address</td>
				    <td><?php echo $shippingAddress->address; ?></td>
				  </tr>
				  
				  <tr>
				    <td>City</td>
				    <td><?php echo $shippingAddress->city; ?></td>
				  </tr>
				  <tr>
				    <td>State</td>
				    <td><?php echo $shippingAddress->state; ?></td>
				  </tr>
				  <tr>
				    <td>Postal Code</td>
				    <td><?php echo $shippingAddress->postalCode; ?></td>
				  </tr>
				  <tr>
				    <td>Country</td>
				    <td><?php echo $shippingAddress->country; ?></td>
				  </tr>
				 
		    <?php endif; ?>
		</table>
	</div>
</div>