
<?php $configs = $this->getConfigs(); ?>
<div class='container text-center'>
<h1> Config Details </h1> 
<form action="<?php echo $this->getUrl('add');?>" method="POST" id='addNew'>
	<button type="button" name="Add" class="btn btn-primary" onclick="core.config.addNew()"> Add New </button>
</form>

<div class="container w-100 my-2">
<table class="table table-light shadow-sm" id="configTable2">

	<tr>
		<th> Id </th>
		<th> Name </th>
		<th> Code </th>
		<th> Value </th>
		<th> Status </th>
		<th> Created_At </th>
		<th> Action </th>
	</tr>
		
	<?php if($configs): ?>
	
		<?php foreach ($configs as $config): ?>		
			<tr>
	    		<td><?php echo $config->configId ?></td>
	    		<td><?php echo $config->name ?></td>
	    		<td><?php echo $config->code ?></td>
	    		<td><?php echo $config->value ?></td>
	    		<td><?php echo $config->getStatus($config->status); ?></td>
	    		<td><?php echo $config->createdAt ?></td>
	    		<td>
	    			<a href="<?php echo $this->getUrl('delete',null,['id'=>$config->configId]);?>" id='delete'>Delete</a>
	    			<a href="<?php echo $this->getUrl('edit',null,['id'=>$config->configId]);?>" id= 'update'>Update</a>
	    			</form>
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

$(document).on('click','#delete',function () {
	event.preventDefault();
	$.ajax({
		  type: 'GET',
		  url: jQuery(this).attr('href'),
		  success: function(data) {
		  	$('#layout').load("<?php echo $this->getUrl('grid');?>");
		},
		dataType : 'json'
		});

});

$(document).on('click','#update',function () {
	event.preventDefault();
	$.ajax({
			  type: 'GET',
			  url: jQuery(this).attr('href'),
			  success: function(data) {
			  	$('#layout').html(data);
			},
			dataType : 'html'
			});

});

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
