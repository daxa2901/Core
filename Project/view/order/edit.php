<?php $order = $this->getOrder() ?>

<div class="container my-4 text-center">
	<form action="<?php echo  $this->getUrl('save');?>" method="POST">
		<table class="w-50 border" cellspacing="21">
			<tbody>
				<tr>
					<td> Order Status :</td>
					<td>
						<select name="order[status]">
				          	<?php foreach ($order->getStatus() as $key => $val): ?>
				            	<option <?php if($order->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
				        	 <?php endforeach; ?>          
	        			</select>
					</td>
				</tr>
				<tr>
					<td> Order State :</td>
					<td>
						<select name="order[state]">
				          	<?php foreach ($order->getState() as $key => $val): ?>
				            	<option <?php if($order->state == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
				        	 <?php endforeach; ?>          
	        			</select>
	        			<input type="hidden" name="order[orderId]" value="<?php echo $order->orderId ?>">
					</td>
				</tr>
				<tr>
					<td colspan="2"><button type="submit" name="submit" class="btn btn-primary">Save </button>
					<a href=<?php echo  $this->getUrl('grid',null,['id'=>null]);?>><button type="button" class="btn btn-danger">Cancel</button></a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>