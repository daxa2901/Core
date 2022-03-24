<?php $carts = $this->getCarts(); ?>
<script type="text/javascript">
	
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

	function getRowTotal(quantity,price,productId,tax) 
	{
		let rowTotal = quantity * price;
		let total = document.getElementById(productId).textContent;
		document.getElementById(productId).innerHTML = rowTotal.toFixed(2);
		var sign = '+';
		if (total > rowTotal) 
		{
			sign = '-';
		}
		getSubtTotal(price,sign,tax);
	}

function rowTotal(quantity,price,productId) 
	{
		console.log(price);
		let rowTotal = quantity * price;
		let total = document.getElementById(productId).textContent;
		document.getElementById(productId).innerHTML = rowTotal.toFixed(2);
	}

	function getSubtTotal(price,sign,taxPercentage) 
	{
		let subtotal = parseFloat(document.getElementById('subTotal').textContent);
		let shippingCost = parseFloat(document.getElementById('shippingCost').textContent);
		let tax = parseFloat(document.getElementById('tax').textContent);
		let discount = parseFloat(document.getElementById('discount').textContent);
		if(sign == '+')
		{
			subtotal +=  price;
			tax = tax + (price * (taxPercentage/100)); 

		}
		else
		{
			subtotal -=  price;
			tax = tax - (price * (taxPercentage/100)); 
		}
		document.getElementById('subTotal').innerHTML = subtotal.toFixed(2);
		document.getElementById('subtotal').innerHTML = subtotal.toFixed((2));
		document.getElementById('tax').innerHTML = tax.toFixed(2);
		document.getElementById('grandTotal').innerHTML = (subtotal + shippingCost + tax - discount).toFixed(2);
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
<?php if(array_key_exists('customers', $carts)):?>
<div class="container mt-5 my-5 w-25" id='customer'> 
	<select onchange="createCart(this.value)" class="form-select ">
		<option>Select Customer</option>
		<?php foreach ($carts['customers'] as $key => $value):?>
			<option value="<?php echo $value->customerId ?>"><?php echo $value->firstName . ' ' . $value->email; ?></option>
		<?php endforeach; ?>
	</select>
</div>
<?php else: ?>

<div class="d-block mx-auto border" id='cart'> 

	<div class="container w-100 my-2" id='customer'>
		<?php echo $this->getCustomer()->toHtml(); ?>
	</div>

	<br>
	<div class="container w-100 mx-auto">
		<?php echo $this->getAddress()->toHtml(); ?>
	</div>
	
	<br>
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
	<br>
	<div class="container w-100 border p-2">
		<?php echo $this->getItems()->toHtml(); ?>
	
</div>
<?php endif; ?>