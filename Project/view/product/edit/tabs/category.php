<?php $product = $this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>
<?php $categoryPath = $this->getCategoryToPath(); ?>
<?php $categoryProductPair = $this->getCategoryProductPair(); ?>
<div class="container w-100 my-3 shadow-lg bg-light">
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
  <thead>
      <tr>
        <th class="col-sm-5">Checkbox :</th>
        <th class="col-sm-5">categoryId :</th>
        <th class="col-sm-5">Category : <?php echo $product->productId ?></th>
      </tr>
  </thead>
    <tbody>
         <?php if($categories): ?>
          <?php foreach($categories as $category): ?>
            <tr>
               <td><input type="checkbox" name="category[]" value="<?php echo $category->categoryId ?>"
                <?php if($categoryProductPair):
                  if(in_array($category->categoryId, $categoryProductPair)): ?> 
                    checked 
                  <?php endif; ?>
                <?php endif; ?>></td>
               <td><?php echo $category->categoryId ?></td>
               <td><?php echo $categoryPath[$category->categoryId] ?></td>
            </tr>
          <?php endforeach; ?>

        <tr>
      <td colspan="3" class="text-center">
     <?php if($product->productId): ?>
       <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
      <?php endif; ?>
    <button type="button" name="submit" class="btn btn-primary my-2" id="productCategorySaveBtn">Save </button>
    <button type="button" name="submit" class="btn btn-primary my-2" id = "categorySaveNext" value="saveAndNext">Save & Next</button>
    <button type="button" class="btn btn-danger my-2" id="productCategoryCancelBtn">Cancel</button></a>
  </td>
</tr>    
<?php else: ?>
    <tr><td colspan="3"> No Category Avaialbe</td></tr>
<?php endif; ?>
</tbody>
  </table>  
  </div>
</form>
</div>

<script type="text/javascript">
jQuery("#productCategorySaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('saveCategory')?>");
  admin.load();
});

 jQuery("#productCategoryCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});
jQuery("#categorySaveNext").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('saveCategory',null,['tab'=>'media'])?>");
  admin.load();
});

</script>
    

