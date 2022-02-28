<?php $products = $this->getMedias(); ?>

<div class='container' style="text-align: center; ">
<h1> Product Media Details </h1> 
<form action=<?php echo $this->getUrl('save');?> method="POST">
	<button type="submit" class="Registerbtn"> Update </button>

	<a href="<?php echo $this->getUrl('grid','product',null,true);?>"><button type="button" class="cancel">Cancel</button></a>
		

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
					<td><?php echo $row->mediaId ?></td>
		    		<td><img src="<?php echo  Ccc::getModel('Product_Media')->getResource()->getMediaPath().'/'.$row->media ?>" alt =  "no"  height="50px" width="50px" /></td>
		    		<input type="hidden" name="media[mediaId][]"  value ="<?php echo $row->mediaId ?>">
		    		<td><input type="radio" name="media[base]"   value = "<?php echo $row->mediaId ?>" <?php if($row->base == 1): ?> checked <?php endif; ?>></td>
		    		<td><input type="radio" name="media[thumb]"  value = "<?php echo $row->mediaId ?>" <?php if($row->thumb == 1): ?> checked <?php endif; ?>></td>
		    		<td><input type="radio" name="media[small]"  value = "<?php echo $row->mediaId ?>" <?php if($row->small == 1): ?> checked <?php endif; ?>></td>
		    		<td><input type="checkbox" name="media[gallery][<?php echo $row->mediaId ?>]" value = "<?php echo $row->mediaId ?>" <?php if($row->gallery == 1): ?> checked <?php endif; ?>></td>
		    		<td><input type="checkbox" name="media[status][<?php echo $row->mediaId ?>]" value = "<?php echo $row->mediaId ?>" <?php if($row->status == 1): ?> checked <?php endif; ?>></td>
		    		<td><input type="checkbox" name="media[remove][<?php echo $row->mediaId ?>]" value = "<?php echo $row->mediaId ?>" ></td>
		    	</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='8'>No Record Available</td></tr>
		<?php endif; ?>
	</form>
	</table>
	<br><br>
	<div align="center" >
	<form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST" enctype="multipart/form-data" style="margin-left: 0;">
	        <input type="file" name="media[fileName]" value="">
	        <button type="submit" value="upload" class="Registerbtn">Upload </button>
	</form>
</div>
</div></div>
