<?php $carts = $this->getCarts(); ?>
<script type="text/javascript">
	
	window.onload = function() 
	{
  		showBlock();
	}
	function showBlock() 
	{
		<?php if(array_key_exists('customers', $carts)):?>
			let element = document.getElementById('customer');
			element.classList.remove('d-none');
			element.classList.add('d-block');
		<?php else: ?>
			let cart = document.getElementById('cart');
			cart.classList.remove('d-none');
			cart.classList.add('d-block');
		<?php endif;?>
	}

	function createCart(val) 
	{
		window.location = "<?php echo $this->getUrl('createCart');?>&id="+val;
	}

	function hideItems() 
	{
    	$('#newItem').hide(200);
	}

	function showItem() 
	{
		let newItem = document.getElementById('newItem');
		newItem.classList.remove('d-none');
    	$('#newItem').show(200);
	}

	function getRowTotal(quantity,price,productId) 
	{
		let rowTotal = quantity * price;
		let total = document.getElementById(productId).textContent;
		document.getElementById(productId).innerHTML = rowTotal;
		var sign = '+';
		if (total > rowTotal) 
		{
			sign = '-';
		}
		getSubtTotal(price,sign);
	}

	function getSubtTotal(price,sign) 
	{
		let subtotal = parseInt(document.getElementById('subTotal').textContent);
		if(sign == '+')
		{
			subtotal +=  price;
		}
		else
		{
			subtotal -=  price;
		}
		document.getElementById('subTotal').innerHTML = subtotal;
	}

	function hideShipping() {
		let val =  document.getElementById('same').checked;
        if(val) 
        { 
          document.getElementById('shippingAddress').style.display = 'none';
          document.getElementById('billingAddress').classList.add('col-sm-12');
      	}
        else
        {
          	document.getElementById('billingAddress').classList.remove('col-sm-12');
          	document.getElementById('billingAddress').classList.add('col-sm-6');
            document.getElementById('shippingAddress').style.display = 'block';
        }
	}

</script>

<div class="d-none container d-flex mt-5 my-5 align-items-center justify-content-center" id='customer'> 
	<select onchange="createCart(this.value)">
		<option>Select Customer</option>
		<?php foreach ($carts['customers'] as $key => $value):?>
			<option value="<?php echo $value->customerId ?>"><?php echo $value->firstName . ' ' . $value->email; ?></option>
		<?php endforeach; ?>
	</select>
</div>

<div class="d-none mx-auto border" id='cart'> 

	<div class="container w-100 my-5 " id='customer'>
		<?php echo $this->getCustomer()->toHtml(); ?>
	</div>

	<hr>
	<div class="container w-100 mx-auto">
		<?php echo $this->getAddress()->toHtml(); ?>
	</div>
	
	<hr>
	<div class="container w-100 " id='paymentMethod'>
		<div class="row ">
        	<div class="col-sm-6 ">
				<?php echo $this->getPaymentMethods()->toHtml(); ?>
	        </div>
    	    <div class="col-sm-6">
				<?php echo $this->getShippingMethods()->toHtml(); ?>
	        </div>
    	</div>
	</div>

	<hr>
	<div class="container w-100">
		<?php echo $this->getItems()->toHtml(); ?>
	</div>
	<div class="container w-100 float-center ">
		<div class="w-25 my-5 border float-end">
			<table class="w-100 ">
				<tbody>
					<tr>
						<td> SUB TOTAL : </td>
						<td> <?php echo $subtotal = $carts['cart']->subTotal ?> </td>
					</tr>
					<tr>
						<td> SHIPPING : </td>
						<td> <?php echo $shippingCost = $carts['cart']->shippingCost ?> </td>
					</tr>
					<tr>
						<td> TAX : </td>
						<td> 150 </td>
					</tr>
					<tr>
						<td> DISCOUNT : </td>
						<td> 150 </td>
					</tr>
					<tr>
						<td> <b> GRAND TOTAL :</b> </td>
						<td> <b> <?php echo $subtotal + $shippingCost + 150 ?></b></td>
					</tr>
					<tr>
						<td colspan="2" class="float-end"><button type="submit" class="btn btn-primary w-100 my-3 "> Place Order </button></td>
	        		</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
