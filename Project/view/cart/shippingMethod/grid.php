<?php $shippingMethods = $this->getShippingMethods() ?>
<?php $cart = $this->getCart() ?>
	<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
		<thead>
			<th colspan="3"><h3> <b>Shipping Method</b></h3></th>
		</thead>
		<thead>            			
			<th>Name</th>
			<th>Amount</th>
			<th>Select </th>
		</thead>
		<?php if ($shippingMethods):?>

        	<?php foreach ($shippingMethods as $key => $value):?>
        		<tr>
        			<td><?php echo $value->name ?></td>
        			<td><?php echo $value->amount ?></td>
        			<td><input type="radio" name="cart[shippingMethod]"  value = "<?php echo $value->methodId ?>"  <?php if ($cart->shippingMethodId == $value->methodId): ?>
            				checked
            			<?php endif; ?>></td>
        		</tr>
        	<?php endforeach; ?>
        	<tr>
				<td colspan="3"><button type="button" class="btn btn-primary my-3 w-25" id="shippingMethodSaveBtn"> Update </button></td>
        	</tr>
    	<?php else: ?>
    		<tr><td colspan="2" class="text-center"> <h5>No Shipping Method available</h5></td></tr>
        <?php endif; ?>
    </table>

<script type="text/javascript">
jQuery("#shippingMethodSaveBtn").click(function () {
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getUrl('save','cart')?>");
	admin.load();
});
</script>