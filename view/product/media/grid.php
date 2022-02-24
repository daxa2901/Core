<?php $products = $this->getProducts(); ?>
<div class='container' style="text-align: center; ">
<h1> Product Media Details </h1> 
<form action=<?php echo $this->getUrl('save');?> method="POST">
	<button type="submit" class="Registerbtn"> Update </button>

<!-- <a href="<?php $this->getUrl('grid','product',null,true);?>"><button type="button" class="cancel">Cancel</button></a> -->
		

<div id='info'>
<table border=1 width=100%>
	<tr>
		<th> Id </th>
		<th> Image </th>
		<th> Base </th>
		<th> Thumb </th>
		<th> Small </th>
		<th> Gallery </th>
		<th> Status </th>
		<th> Remove </th>
	</tr>
	<?php if($products): ?>
	
		<?php foreach ($products as $row): ?>		
			<tr>
	    		<td><?php echo $row->imageId ?></td>
	    		<td><?php echo $row->image ?></td>
	    		<input type="hidden" name="media[imageId][]" id = "imageId" value =" <?php echo $row->imageId ?>"  >
	    		<td><input type="radio" name="media[base][<?php echo $row->imageId ?>]" id = "base"  value = "12<?php echo $row->base ?>" <?php if($row->base == 1): ?> checked <?php endif; ?></td>
	    		<td><input type="radio" name="media[thumb][<?php echo $row->imageId ?>]" id = "thumb" value = "1" <?php if($row->thumb == 1): ?> checked <?php endif; ?>></td>
	    		<td><input type="radio" name="media[small][<?php echo $row->imageId ?>]" id = "small" value = "1" <?php if($row->small == 1): ?> checked <?php endif; ?>></td>
	    		<td><input type="checkbox" name="media[gallery][<?php echo $row->imageId ?>]" id = "gallery" value = "1" <?php if($row->gallery == 1): ?> checked <?php endif; ?>></td>
	    		<td><input type="checkbox" name="media[status][<?php echo $row->imageId ?>]" id = "status" value = "1" <?php if($row->status == 1): ?> checked <?php endif; ?>></td>
	    		<td><input type="checkbox" name="media[remove][<?php echo $row->imageId ?>]" id ="remove" ></td>
	    	</tr>
	  	<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan='8'>No Record Available</td></tr>
	<?php endif; ?>
</form>
</table>
</div>
