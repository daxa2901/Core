<?php $product = $this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>
<?php $categoryPath = $this->getCategoryToPath(); ?>
<?php $categoryProductPair = $this->getCategoryProductPair(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
<form action="<?php echo  $this->getUrl('saveCategory');?>"  method='post' class="p-2">
<table class="form-group w-100" cellspacing="4">
            <tr>
              <th class="col-sm-5">Checkbox :</th>
              <th class="col-sm-5">categoryId :</th>
              <th class="col-sm-5">Category :</th>
            </tr>
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
      <td width="25%">&nbsp;</td>
      <td>
         <?php if($product->productId): ?>
           <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
          <?php endif; ?>
        <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
        <a href=<?php echo  $this->getUrl('grid',null,['id'=>null]);?>><button type="button" class="btn btn-danger my-2">Cancel</button></a>
      </td>
    </tr>    
    <?php else: ?>
        <tr><td colspan="3"> No Category Avaialbe</td></tr>
    <?php endif; ?>
  </div>
  </table>  
</form>
</div>
