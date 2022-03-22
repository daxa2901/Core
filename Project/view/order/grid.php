<?php $orders = $this->getOrders(); ?>

<div class='container text-center'>
	<h1 class="text-center mt-2"> Order Details </h1> 
	<form action="<?php echo $this->getUrl('grid','cart');?>" method="POST" >
		<button type="submit" name="Add" class="btn btn-primary my-2 "> Add New </button>
	</form>
</div>
<div class="container w-100 mx-auto my-3 ">
	<table class="w-100">
		<thead>
			<tr class="border">
				<th> Order Id</th>
				<th> First Name</th>
				<th> Last Name</th>
				<th> Email</th>
				<th> Mobile </th>
				<th> State </th>
				<th> Status </th>
				<th> Grand Total </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			<?php if($orders): ?>
				<?php foreach($orders as $order): ?>
					<tr class="border">
						<td> <?php echo $order->orderId; ?></td>
						<td> <?php echo $order->firstName; ?></td>
						<td> <?php echo $order->lastName; ?></td>
						<td> <?php echo $order->email; ?></td>
						<td> <?php echo $order->mobile; ?></td>
						<td> <?php echo $order->getState($order->state); ?></td>
						<td> <?php echo $order->getStatus($order->status); ?></td>
						<td> <?php echo $order->grandTotal; ?></td>
						<td> <a href="<?php echo $this->getUrl('edit',null,['id'=>$order->orderId]);?>">View</a></td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr class="border text-center">
					<td colspan="8"> No Orders Available </td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>