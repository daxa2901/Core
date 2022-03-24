<?php $result = $this->getCategory(); ?>
<?php $getCategoryToPath = $this->getCategoryToPath(); ?>
<div class = 'container text-center'>
	<h1> Category Details </h1> 
	<form action="<?php echo  $this->getUrl('add');?>" method="POST">
		<button type="submit" name="Add" class="btn btn-primary"> Add New </button>
	</form>
	
	<div class="container w-100 my-2">
		<table class="table table-light shadow-sm">
			<tr>
				<th> Id </th>
				<th> Base </th>
				<th> Thumb </th>
				<th> Small </th>
				<th> Name </th>
				<th> Created_At </th>
				<th> Updated_At </th>
				<th> Status </th>
				<th> Media </th>
				<th> Action </th>
			</tr>
			<?php if($result): ?>
				<?php foreach ($result as $row):?>
					<tr>
			    		<td><?php echo $row->categoryId ?></td>
			    		<td><?php if($row->base): ?>
				    		<img src="<?php echo $row->getBase()->getImageUrl();?>" alt =  "no"  height="50px" width="50px" />
				    	<?php else : ?>
				    		No Image 
				    	<?php endif; ?>
				    	</td>
			    		<td><?php if($row->thumb): ?>
				    		<img src="<?php echo $row->getThumb()->getImageUrl();?>" alt =  "no"  height="50px" width="50px" />
				    	<?php else : ?>
				    		No Image 
				    	<?php endif; ?>
				    	</td>
			    		<td><?php if($row->small): ?>
				    		<img src="<?php echo $row->getSmall()->getImageUrl();?>" alt =  "no"  height="50px" width="50px" />
				    	<?php else : ?>
				    		No Image 
				    	<?php endif; ?>
				    	</td>
			    		
			    		<td><?php echo $getCategoryToPath[$row->categoryId];?>
			    		</td>
			    		<td><?php echo $row->createdAt ?></td>
			    		<td><?php echo $row->updatedAt ?></td>
			    		<td>
				    		<?php echo $row->getStatus($row->status) ?>
			    		</td>
			    		<td><a href="<?php echo $this->getUrl('grid','category_media',['id'=>$row->categoryId,'p'=>1]);?>">Media</a> </td>

			    		<td>
			    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$row->categoryId]);?>">Delete</a> 
			    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$row->categoryId]);?>">Update</a>
			    		</td>
			   		</tr>
			  	<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan='10'>No Record Available</td>
				</tr>		
			<?php endif; ?>
		</table>
	</div>	
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