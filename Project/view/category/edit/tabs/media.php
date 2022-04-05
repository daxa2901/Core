<?php $media = $this->getMedias(); ?>
<?php $category = $this->getCategory(); ?>
<div class='container text-center'>
		<button type="button" class="btn btn-primary" id="categoryMediaSaveBtn"> Update </button>
		<button type="button" class="btn btn-danger" id="categoryMediaCancelBtn">Cancel</button>
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
				<tbody>
				<?php if($media): ?>
				
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
				    	<?php if($category->categoryId): ?>
          				 <input type="hidden" name="category[categoryId]" value="<?php echo $category->categoryId ?>">
        				<?php endif; ?>
				  	<?php endforeach; ?>
				<?php else: ?>
					<tr><td colspan='8'>No Record Available</td></tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	<div class="container w-50">
		<form action="<?php echo $this->getUrl('save','category_media') ?>" method="POST" enctype="multipart/form-data">
		       <table>
				<tr>
    				<?php if($category->categoryId): ?>
      				 <input type="hidden" name="category[categoryId]" value="<?php echo $category->categoryId ?>">
    				<?php endif; ?>
					<td><input type="file" name="media[fileName]" class="form-control my-2" id="file"></td>
					<td><button type="button" value="upload" class="btn btn-primary mx-2" id="categoryMedia" >Upload </button></td>
				</tr>
		    </table>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery("#categoryMediaSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save','category_media')?>");
  admin.load();
});

 jQuery("#categoryMediaCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

jQuery("#categoryMedia").click(function () {
	var fileData = jQuery('#file')[0].files;
	var data = new FormData();
	data.append('file',fileData[0]);
	admin.setData(data)
  admin.setUrl("<?php echo $this->getUrl('save','category_media',['id'=>$category->categoryId])?>");
	admin.uploadImage();
});
</script>
    