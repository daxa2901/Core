<?php $product = $this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>
<?php $categoryPath = $this->getCategoryToPath(); ?>
<?php $categoryProductPair = $this->getCategoryProductPair(); ?>

<form action="<?php echo  $this->getUrl('save');?>"  method='post'>
<table class="form-group w-100 border" cellspacing="4">
    <tr>
      <td> Name</td>
      <td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
    </tr>
    <tr>
      <td> Price</td>
      <td><input type="float" name="product[price]" value="<?php echo $product->price ?>"></td>
    </tr>
    <tr>
      <td> Cost</td>
      <td><input type="float" name="product[cost]" value="<?php echo $product->cost ?>"></td>
    </tr>
    <tr>
      <td> Sku</td>
      <td><input type="float" name="product[sku]" value="<?php echo $product->sku ?>"></td>
    </tr>
    <tr>
      <td> Tax Percentage</td>
      <td><input type="float" name="product[tax]" value="<?php echo $product->tax ?>"></td>
    </tr>
    <tr>
      <td> Discount </td>
      <td><input type="float" name="product[discount]" value="<?php echo $product->discount ?>"><br>
        <input type="radio" <?php if($product->discountMode == get_class($product)::DISCOUNT_PERCENTAGE): ?> checked <?php endif ?> required name="product[discountMode]" value="1"> Percentage &nbsp;&nbsp;&nbsp; 
        <input type="radio" <?php if($product->discountMode == get_class($product)::DISCOUNT_AMOUNT): ?> checked <?php endif ?> required name="product[discountMode]" value="2"> Amount</td>
    </tr>
    <tr>
      <td> Quantity</td>
      <td><input type="number" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
    </tr>
    <tr>
      <td>Status</td>
      <td>
        <select name="product[status]">
          <?php foreach ($product->getStatus() as $key => $val): ?>
            <option <?php if($product->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    </tr>
    <tr>
            <?php if($categories): ?>
      <td width="=10%"> Category</td>
      <td width="=10%"> 
          <table border="1">
            <tr>
              <th>Checkbox</th>
              <th>categoryId</th>
              <th>Category</th>
            </tr>
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
          </table>
      </td>
            <?php endif; ?>
    </tr>
    <?php if($product->productId): ?>
      <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
    <?php endif; ?>
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href=<?php echo  $this->getUrl('grid',null,['id'=>null]);?>><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </div>
  </table>  
</form>
