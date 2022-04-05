<?php $media = $this->getMedias(); ?>
<?php $product = $this->getProduct(); ?>

<div class='container text-center'>
		<button type="button" class="btn btn-primary" id="productMediaSaveBtn"> Update </button>
		<button type="button" class="btn btn-danger" id="productMediaCancelBtn">Cancel</button>
		<div class="container w-100 my-2">
			<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
				<thead>
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
				</thead>
				<?php if($media): ?>
					<tbody>
					<?php foreach ($media as $row): ?>		
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
				  	<?php if($product->productId): ?>
          				 <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
        			<?php endif; ?>
				<?php else: ?>
					<tr><td colspan='8'>No Record Available</td></tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	
	<div class="container w-50" >
		<form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST" enctype="multipart/form-data" class="form-group" id = "mediaForm">
			<table>
				<tr>
					<td><input type="file" name="media[fileName]" class="form-control my-2" id="file"></td>
					<td><button type="button" value="upload" class="btn btn-primary mx-2" id="productMedia">Upload </button></td>
				</tr>
		    </table>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery("#productMediaSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save','product_media')?>");
  admin.load();
});

 jQuery("#productMediaCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

jQuery("#productMedia").click(function () {
	var fileData = jQuery('#file')[0].files;
	var data = new FormData();
	data.append('file',fileData[0]);
	admin.setData(data)
  admin.setUrl("<?php echo $this->getUrl('save','product_media',['id'=>$product->productId])?>");
	admin.uploadImage();
});
</script>
    