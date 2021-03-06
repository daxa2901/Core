<?php $paymentMethods  = $this->getPaymentMethods()?>
<?php $cart  = $this->getCart()?>

	<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
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
					<td colspan="2"><button type="button" class="btn btn-primary my-3 w-25" id="paymentSaveBtn"> Update </button></td>
	        	</tr>
	    <?php else: ?>
	    	<tr>
	    		<td colspan="2"> <h5>No Payment Method available</h5></td>
	    	</tr>
	    <?php endif; ?>
	</table>

<script type="text/javascript">
jQuery("#paymentSaveBtn").click(function () {
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getUrl('save','cart')?>");
	admin.load();
});
</script>