<?php $products = $this->getMedias(); ?>

<div class='container text-center'>
	<h1> Product Media Details </h1> 
	<form action="<?php echo $this->getUrl('save');?>" method="POST">
		<button type="submit" class="btn btn-primary"> Update </button>

		<a href="<?php echo $this->getUrl('grid','product',null,true);?>"><button type="button" class="btn btn-danger">Cancel</button></a>
			

		<div class="container w-100 my-2">
			<table class="table table-light shadow-sm">
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
				    		<td><img src="<?php echo $row->getImageUrl();?>" alt =  "no"  height="50px" width="50px" /></td>
				    		<input type="hidden" name="media[mediaId][]"  value ="<?php echo $row->mediaId ?>">
				    		<td><input type="radio" name="media[base]"   value = "<?php echo $row->mediaId ?>" <?php if($row->base == $row->mediaId): ?> checked <?php endif; ?>></td>
				    		<td><input type="radio" name="media[thumb]"  value = "<?php echo $row->mediaId ?>" <?php if($row->thumb == $row->mediaId): ?> checked <?php endif; ?>></td>
				    		<td><input type="radio" name="media[small]"  value = "<?php echo $row->mediaId ?>" <?php if($row->small == $row->mediaId): ?> checked <?php endif; ?>></td>
				    		<td><input type="checkbox" name="media[gallery][<?php echo $row->mediaId ?>]" value = "<?php echo $row->mediaId ?>" <?php if($row->gallery == 1): ?> checked <?php endif; ?>></td>
				    		<td><input type="checkbox" name="media[status][<?php echo $row->mediaId ?>]" value = "<?php echo $row->mediaId ?>" <?php if($row->status == 1): ?> checked <?php endif; ?>></td>
				    		<td><input type="checkbox" name="media[remove][<?php echo $row->mediaId ?>]" value = "<?php echo $row->mediaId ?>" ></td>
				    	</tr>
				  	<?php endforeach; ?>
				<?php else: ?>
					<tr><td colspan='8'>No Record Available</td></tr>
				<?php endif; ?>
			</table>
		</div>
	</form>
	<div class="container w-50" >
		<form action="<?php echo $this->getUrl('save') ?>" method="POST" enctype="multipart/form-data" class="form-group">
			<table>
				<tr>
					<td><input type="file" name="media[fileName]" class="form-control my-2"></td>
					<td><button type="submit" value="upload" class="btn btn-primary mx-2">Upload </button></td>
				</tr>
		    </table>
		</form>
	</div>
</div>
