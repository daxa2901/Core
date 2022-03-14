<?php $products = $this->getProducts(); ?>
<div class='container' style="text-align: center; ">
<h1> Product Details </h1> 
<form action=<?php echo $this->getUrl('add');?> method="POST">
	<button type="submit" name="Add" class="Registerbtn"> Add New </button>
</form>

<div id='info'>
<table border=1 width=100%>
	<tr>
		<th> Id </th>
		<th> Base </th>
		<th> Thumb </th>
		<th> Small </th>
		<th> Name </th>
		<th> Price </th>
		<th> Quantity </th>
		<th> Sku </th>
		<th> Created_At </th>
		<th> Updated_At </th>
		<th> Status </th>
		<th> Media </th>
		<th> Action </th>
	</tr>
	<?php if($products): ?>
	
		<?php foreach ($products as $row): ?>		
			<tr>
	    		<td><?php echo $row->productId ?></td>
		    	<td><?php if($row->base): ?>
		    		<img src="<?php echo  Ccc::getModel('Product_Media')->getResource()->getMediaPath().'/'.$row->baseImage ?>" alt =  "no"  height="50px" width="50px" />
		    	<?php else : ?>
		    		No Image 
		    	<?php endif; ?>
		    	</td>
	    		<td><?php if($row->thumb): ?>
		    		<img src="<?php echo  Ccc::getModel('Product_Media')->getResource()->getMediaPath().'/'.$row->thumbImage ?>" alt =  "no"  height="50px" width="50px" />
		    	<?php else : ?>
		    		No Image 
		    	<?php endif; ?>
		    	</td>
	    		<td><?php if($row->small): ?>
		    		<img src="<?php echo  Ccc::getModel('Product_Media')->getResource()->getMediaPath().'/'.$row->smallImage ?>" alt =  "no"  height="50px" width="50px" />
		    	<?php else : ?>
		    		No Image 
		    	<?php endif; ?>
		    	</td>
	    		<td><?php echo $row->name ?></td>
	    		<td><?php echo $row->price ?></td>
	    		<td><?php echo $row->quantity ?></td>
	    		<td><?php echo $row->sku ?></td>
	    		<td><?php echo $row->createdAt ?></td>
	    		<td><?php echo $row->updatedAt ?></td>
	    		<td><?php echo  $row->getStatus($row->status) ?> </td>
	    		<td><a href="<?php echo $this->getUrl('grid','product_media',['id'=>$row->productId],true);?>">Media</a> </td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$row->productId]);?>">Delete</a> 
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$row->productId]);?>">Update</a>
	    		</td>
	    	</tr>
	  	<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan=14>No Record Available</td></tr>
	<?php endif; ?>

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

