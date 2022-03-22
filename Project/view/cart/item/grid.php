<?php $items = $this->getItems(); ?>
<?php $products = $this->getProducts(); ?>
<?php $carts = $this->getCart(); ?>

<div class="container w-100 d-none" id="newItem">
	<form action="<?php echo  $this->getUrl('add');?>" method="POST" class="w-100 mx-auto">
		<button type="submit" class="btn btn-outline-primary float-end my-3 w-25"> Add Selected Items </button>
		<button type="button" onclick= "hideItems()" id = "cancel" class="btn btn-outline-primary float-end my-3 mx-2 w-25"> Cancel</button>
		<table class="w-100 border mt-5">
			<thead class="border">
				<th> Image </th>
				<th> Name </th>
				<th> Quantity </th>
				<th> Price </th>
				<th> Row Total </th>
				<th> Action </th>
			</thead>
			<tbody>
		<?php foreach ($products as $key => $value): ?>
				<tr>
					<td> <?php if($value->base): ?><img src="<?php echo $value->getBase()->getImageUrl()?>" alt =  "no Image"  height="50px" width="50px" /> <?php else: ?> No Image <?php endif; ?></td>
					<td> <?php echo $value->name ?></td>
					<td> <input type="number" id = 'quantity' name = item[quantity][<?php echo $value->productId ?>] min = 1  max= <?php echo $value->quantity ?> value='1' onchange ="rowTotal(this.value, <?php echo $value->price ?> , <?php echo $value->productId ?>)"></td>
					<td> <?php echo $value->price ?></td>
					<td> <label id = <?php echo $value->productId ?>><?php echo $value->price ?></td>
					<td> <input type="checkbox" name="item[productId][]" value="<?php echo $value->productId ?>"></td>
				</tr>	
		<?php endforeach ?>
			</tbody>
		</table>
	</form>	
</div>
<div class="container w-100">
	<form action="<?php echo  $this->getUrl('save');?>" method="POST" class="w-100 mx-auto">
		<button type="button" class="btn btn-outline-primary float-end my-3 mx-2 w-25" onclick="showItem()"> New Item</button>
		<button type="submit" class="btn btn-outline-primary float-end my-3 w-25"> Update </button>
		<table class="w-100 border mt-5">
			<thead class="border">
				<th> Image </th>
				<th> Name </th>
				<th> Quantity </th>
				<th> Price </th>
				<th> Row Total </th>
				<th> Action </th>
			</thead>
			<tbody>
			<?php $subtotal = 0 ?> 
			<?php $tax = 0 ?> 
		<?php foreach ($items as $key => $value): ?>
			<?php $product = $value->getProduct(); ?>
				<tr>
					<?php $subtotal = $subtotal + ($value->quantity * $product->price) ?> 
					<?php $tax = $tax + ($product->price * ($product->tax /100) * $value->quantity) ?> 
					<td> <?php if($product->base): ?><img src="<?php echo $product->getBase()->getImageUrl() ?>" alt =  "no Image"  height="50px" width="50px" /><?php else: ?> No Image <?php endif; ?></td>
					<td> <?php echo $product->name ?></td>
					<td> <input type="number" name="cart[quantity][<?php echo $value->itemId ?>]" id = 'quantity' min = 1  max= <?php echo $product->quantity ?> value="<?php echo $value->quantity ?>" onchange ="getRowTotal(this.value, <?php echo $product->price ?> , <?php echo $product->productId ?> , <?php echo $product->tax ?>)">
						<input type="hidden" name="cart[itemId][<?php echo $value->itemId ?>]" value="<?php echo $product->price ?>">
					</td>
					<td> <?php echo $product->price ?></td>
					<td> <label id = <?php echo $product->productId ?>><?php echo $value->quantity * $product->price ?></label> </td>
					<td> <a href="<?php echo $this->getUrl('delete',null,['id'=>$value->itemId]);?>">delete</a></td>
				</tr>	
		<?php endforeach ?>
				<tr>
					<td colspan="5"><button type="button" class="btn btn-outline-primary float-end my-3 mx-2 w-25 disabled"> Sub Total :- <label id = 'subTotal'> <?php echo $subtotal ?> </label>  </button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
</div>
	<div class="container w-100 float-center ">
		<div class="w-25 my-5 border float-end">
			<table class="w-100 ">
				<tbody>
							<form action="<?php echo  $this->getUrl('save','order');?>" method = "POST">
					<tr>
						<td> SUB TOTAL : </td>
						<td> <label id="subtotal"><?php echo $subtotal?> </label></td>
					</tr>
					<tr>
						<td> SHIPPING COST: </td>
						<td><label id="shippingCost"> <?php echo $shippingCost = $carts->shippingCost ?></label> </td>
					</tr>
					<tr>
						<td> TAX : </td>
						<td><label id="tax"> <?php echo $tax ?></label> </td>
					</tr>
					<tr>
						<td> DISCOUNT : </td>
						<td> <label id="discount">150 </label></td>
					</tr>
					<tr>
						<td> <b> GRAND TOTAL :</b> </td>
						<td> <b><label id='grandTotal'> <?php echo $grandTotal = $subtotal + $tax + $shippingCost - 150 ?></b></label>
								<input type="hidden" name="grandTotal" value="<?php echo $grandTotal ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2" class="float-end"><button type="submit" class="btn btn-primary w-100 my-3 "> Place Order </button></a></td>
	        		</tr>
	        		</form>
				</tbody>
			</table>
		</div>
	</div>