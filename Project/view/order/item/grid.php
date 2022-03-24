<?php $items = $this->getItems(); ?>
<?php $order = $this->getOrder(); ?>

<div class="container w-100 ">
		<table class="w-100 border mt-5">
			<thead class="border">
				<th> Image </th>
				<th> Name </th>
				<th> Quantity </th>
				<th> Price </th>
				<th> Cost </th>
				<th> Discount </th>
				<th> Row Total </th>
			</thead>
			<tbody>
			<?php $subtotal = 0 ?> 
			<?php $discount = 0 ?> 
		<?php foreach ($items as $key => $value): ?>
			<?php $product = $value->getProduct(); ?>
				<tr>
					<?php $subtotal = $subtotal + ($value->quantity * $value->getFinalPrice()) ?> 
					<?php if($product->discountMode == get_class($product)::DISCOUNT_PERCENTAGE): ?>
						<?php $discount = $discount + $value->price  * ($value->discount / 100) ?> 
					<?php else : ?>
						<?php $discount = $discount + $value->discount ?>
					<?php endif ?> 
					<td> <?php if($product->base): ?>
							<img src="<?php echo $product->getBase()->getImageUrl() ?>" alt =  "no Image"  height="50px" width="50px" />
						<?php else: ?>
							 No Image 
						<?php endif; ?>
					</td>
					<td> <?php echo $value->name ?></td>
					<td> <?php echo $value->quantity?></td>
					<td> <?php echo $value->price ?></td>
					<td> <?php echo $value->cost ?></td>
					<td> <?php echo $value->discount ?></td>
					<td> <?php echo $value->quantity * $value->getFinalPrice() ?></td>
				</tr>	
		<?php endforeach ?>
				<tr>
					<td colspan="6">
						<button type="button" class="btn btn-outline-primary float-end my-3 mx-2 w-25 disabled"> Sub Total :- <?php echo $subtotal ?> </button>
					</td>
				</tr>
			</tbody>
		</table>
</div>
	<div class="container w-100 float-center ">
		<div class="w-25 my-5 border float-end p-3 shadow-sm">
			<table class="w-100 ">
				<tbody>
					<tr>
						<td> SUB TOTAL : </td>
						<td> <?php echo $subtotal ?></td>
					</tr>
					<tr>
						<td> SHIPPING COST: </td>
						<td><?php echo $order->shippingCost ?> </td>
					</tr>
					<tr>
						<td> TAX : </td>
						<td> <?php echo $order->taxAmount ?> </td>
					</tr>
					<tr>
						<td> DISCOUNT : </td>
						<td> <?php echo $discount ?></td>
					</tr>
					<tr>
						<td> <b> GRAND TOTAL :</b> </td>
						<td> <b> <?php echo $order->grandTotal ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
