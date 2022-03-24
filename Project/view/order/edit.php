<?php $order = $this->getOrder() ?>

<div class="container w-50 my-3 shadow-lg bg-light">
	<form action="<?php echo  $this->getUrl('save');?>" method="POST" class='p-3'>
		<table class="form-group w-100" cellspacing="21">
			<tbody>
				<tr>
					<td> Order Status :</td>
					<td>
						<select name="order[status] " class="form-select">
				          	<?php foreach ($order->getStatus() as $key => $val): ?>
				            	<option <?php if($order->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
				        	 <?php endforeach; ?>          
	        			</select>
					</td>
				</tr>
				<tr>
					<td> Order State :</td>
					<td>
						<select name="order[state]" class="form-select"	>
				          	<?php foreach ($order->getState() as $key => $val): ?>
				            	<option <?php if($order->state == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
				        	 <?php endforeach; ?>          
	        			</select>
	        			<input type="hidden" name="order[orderId]" value="<?php echo $order->orderId ?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
						<a href=<?php echo  $this->getUrl('grid',null,['id'=>null]);?>><button type="button" class="btn btn-danger my-2">Cancel</button></a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>