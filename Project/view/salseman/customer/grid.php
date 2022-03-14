<?php $customers = $this->getCustomers(); ?>

<div class='container' style="text-align: center; ">
<h1> Salseman Customer Details </h1> 
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

<form action=<?php echo $this->getUrl('save');?> method="POST">
	<button type="submit" class="Registerbtn"> Update </button>

	<a href="<?php echo $this->getUrl('grid','salseman',['id'=>null,'p'=>1]);?>"><button type="button" class="cancel">Cancel</button></a>
		

	<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Select Customers </th>
			<th> Id </th>
			<th> Name </th>
			<th> Manage Customer Price </th>
			
		</tr>
		<?php if($customers): ?>
			<?php foreach ($customers as $row): ?>		
				<tr>
		    		<td><input type="checkbox" name="customer[]"  value = "<?php echo $row->customerId ?>" <?php if($row->salsemanId): ?> checked disabled<?php endif; ?>></td>
					<td><?php echo $row->customerId ?></td>
					<td><?php echo $row->firstName .' '. $row->lastName ?></td>
					<td>
					<?php if($row->salsemanId): ?> 
	
						<a href="<?php echo $this->getUrl('grid','salseman_customer_price',['id'=>$row->salsemanId,'customerId'=>$row->customerId],true);?>">Manage Customer Price</a> 
					<?php endif; ?>
	    		</td>
		    		</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='4'>No Customer Available</td></tr>
		<?php endif; ?>
	</form>
	</table>
	
</div></div>
