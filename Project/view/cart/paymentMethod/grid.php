<?php $paymentMethods  = $this->getPaymentMethods()?>
<?php $cart  = $this->getCart()?>

<form class="mx-auto" action="<?php echo  $this->getUrl('save');?>" method="POST">
	<table class="w-100 border text-center">
		<thead >
			<th colspan="2"><h3> <b>Payment Method</b></h3></th>
		</thead>
		<thead >            			
			<th>Name</th>
			<th>Select </th>
		</thead>
		<?php if ($paymentMethods):?>

	        	<?php foreach ($paymentMethods as $key => $value):?>
	        		<tr>
	        			<td><?php echo $value->name ?></td>
	        			<td><input type="radio" name="cart[paymentMethod]" value = "<?php echo $value->methodId ?>" <?php if ($cart->paymentMethodId == $value->methodId): ?>
	        				checked
	        			<?php endif; ?>></td>
	        		</tr>
	        	<?php endforeach; ?>
	        	<tr>
					<td colspan="2"><button type="submit" class="btn btn-primary my-3 w-25"> Update </button></td>
	        	</tr>
	    <?php else: ?>
	    	<tr>
	    		<td colspan="2"> <h5>No Payment Method available</h5></td>
	    	</tr>
	    <?php endif; ?>
	</table>
</form>