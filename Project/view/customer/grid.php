<?php $customers = $this->getCustomers(); ?>

<div class='container' style="text-align: center; ">
<h1> Customer Details </h1> 
<form action="<?php echo  $this->getUrl('add');?>" method="POST">
<button type="submit" name="Add" class="Registerbtn"> Add New </button>
</form>

<script type="text/javascript">
	function changeURL() 
	{
		const pprValue = document.getElementById('ppc').selectedOptions[0].value;
		let href = window.location.href;
		if(!href.includes('ppc'))
		{
		  	href+='&ppc=20';
		}
		const myArray = href.split("&");
		for (i = 0; i < myArray.length; i++)
		{
			if(myArray[i].includes('p='))
			{
			  	myArray[i]='p=1';
			}
			if(myArray[i].includes('ppc='))
			{
			  	myArray[i]='ppc='+pprValue;
			}
		}
			const str = myArray.join("&");
			location.replace(str);
	}

</script>
<table  align="center" cellspacing="20">
	<tr>
		<td> 
			<select name="perPageCountOption" onchange="changeURL()" id='ppc'>
					<option value="">select Per Page Count Option</option>
				<?php foreach ($this->getPager()->getPerPageCountOption() as $key => $value) : ?>
					<option value="<?php echo $value ?>"> <?php echo $value ?></option>
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

<div id='info'>
	<table border=1 width=100%>
	<tr>
		<th> Id </th>
		<th> First Name </th>
		<th> Last Name </th>
		<th> Email </th>
		<th> Mobile </th>
		<th> Status </th>
		<th> Address </th>
		<th> Create Date </th>
		<th> Update Date </th>
		<th> Action </th>
	</tr>
	<?php if($customers):?>
		<?php foreach ($customers as $row): ?>
			 
			<tr>
	      		<td><?php echo $row->customerId; ?></td>
	    		<td><?php echo $row->firstName; ?></td>
	    		<td><?php echo $row->lastName; ?></td>
	    		<td><?php echo $row->email; ?></td>
	    		<td><?php echo $row->mobile; ?></td>
	    		<td><?php echo  $row->getStatus($row->status) ?> </td>
	    		<td> <?php echo $row->address;?> </td>
	    		<td><?php echo $row->createdDate; ?></td>
	    		<td><?php echo $row->updatedDate; ?></td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$row->customerId]);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$row->customerId]);?>">Update</a>
	    		</td>
	   		</tr>
	 	<?php endforeach;?>
	<?php else:?>
		<tr><td colspan='10'>No Record Available</td></tr>			
	<?php endif; ?>

	</table>
</div>
