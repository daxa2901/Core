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

<script type="text/javascript">
function changeURL(val) 
{
	window.location = "<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart(),'ppc'=>null]);?>&ppc="+val; 
}

</script>
<table  align="center" cellspacing="20">
	<tr>
		<td> 
			<select name="perPageCountOption" onchange="changeURL(this.value)" id='ppc'>
					<option value="">select Per Page Count Option</option>
				<?php foreach ($this->getPager()->getPerPageCountOption() as $key => $value) : ?>
					<option value="<?php echo $value ?>" <?php if($this->getPager()->getPerPageCount() == $value):  ?> selected <?php endif; ?>> <?php echo $value ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()]) ?>" <?php if(!$this->getPager()->getStart()): ?> style = "pointer-events : none;" <?php endif; ?>>Start</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()]) ?>"<?php if(!$this->getPager()->getPrev()): ?> style = "pointer-events : none;"<?php endif; ?>>Previous</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getCurrent()]) ?>">Current</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()]) ?>" <?php if(!$this->getPager()->getNext()): ?> style = "pointer-events : none;" <?php endif; ?>>Next</a></td>
		<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()]) ?>" <?php if(!$this->getPager()->getEnd()): ?> style = "pointer-events : none;" <?php endif; ?>>End</a></td>
	</tr>
</table>	


