<?php $paymentMethods = $this->getPaymentMethods(); ?>
<div class='container text-center'>
	<h1> Payment Method Details </h1> 
	<form action=<?php echo $this->getUrl('add');?> method="POST">
		<button type="submit" name="Add" class="btn btn-primary"> Add New </button>
	</form>
	
<div class="container w-100 my-2">
<table class="table table-light shadow-sm">
	
	<tr>
		<th> Id </th>
		<th> Name </th>
		<th> Note </th>
		<th> Status </th>
		<th> Created_At </th>
		<th> Updated_At </th>
		<th> Action </th>
	</tr>
	<?php if($paymentMethods): ?>
	
		<?php foreach ($paymentMethods as $paymentMethod): ?>		
			<tr>
	    		<td><?php echo $paymentMethod->methodId ?></td>
	    		<td><?php echo $paymentMethod->name ?></td>
	    		<td><?php echo $paymentMethod->note ?></td>
	    		<td><?php echo $paymentMethod->getStatus($paymentMethod->status); ?></td>
	    		<td><?php echo $paymentMethod->createdAt ?></td>
	    		<td><?php echo $paymentMethod->updatedAt ?></td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$paymentMethod->methodId],false);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$paymentMethod->methodId],false);?>">Update</a>
	    		</td>
	    	</tr>
	  	<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan='8'>No Record Available</td></tr>
	<?php endif; ?>

</table>
</div>
<script type="text/javascript">
function changeURL(val) 
{
	window.location = "<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart(),'ppc'=>null]);?>&ppc="+val; 
}

</script>
<div class="container">
	<table align = "center"  class="pagination w-50 border-none">
		<tr>
			<td> 
				<select name="perPageCountOption" onchange="changeURL(this.value)" id='ppc' class="form-select">
						<option value="">select Per Page Count Option</option>
					<?php foreach ($this->getPager()->getPerPageCountOption() as $key => $value) : ?>
						<option value="<?php echo $value ?>" <?php if($this->getPager()->getPerPageCount() == $value):  ?> selected <?php endif; ?>> <?php echo $value ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()]) ?>" <?php if(!$this->getPager()->getStart()): ?> style = "pointer-events : none;" <?php endif; ?> class = "btn btn-default">Start</a></td>
			<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()]) ?>"<?php if(!$this->getPager()->getPrev()): ?> style = "pointer-events : none;"<?php endif; ?> class = "btn btn-default">Previous</a></td>
			<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getCurrent()]) ?>" class = "btn btn-default" > Current</a></td>
			<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()]) ?>" <?php if(!$this->getPager()->getNext()): ?> style = "pointer-events : none;" <?php endif; ?> class = "btn btn-default">Next</a></td>
			<td><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()]) ?>" <?php if(!$this->getPager()->getEnd()): ?> style = "pointer-events : none;" <?php endif; ?> class = "btn btn-default">End</a></td>
		</tr>
	</table>	
</div>