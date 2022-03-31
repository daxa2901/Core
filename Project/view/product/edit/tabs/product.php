<?php $product = $this->getProduct(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
<table class="form-group w-100" cellspacing="4">
    <form action="<?php echo  $this->getUrl('save');?>" method="POST">
    <tr>
      <td> Name :</td>
      <td><input type="text"  class="form-control " name="product[name]" value="<?php echo $product->name ?>"></td>
    </tr>
    <tr>
      <td> Price :</td>
      <td><input type="float"  class="form-control " name="product[price]" value="<?php echo $product->price ?>"></td>
    </tr>
    <tr>
      <td> Cost :</td>
      <td><input type="float" class="form-control " name="product[cost]" value="<?php echo $product->cost ?>"></td>
    </tr>
    <tr>
      <td> Sku</td>
      <td><input type="float" class="form-control " name="product[sku]" value="<?php echo $product->sku ?>"></td>
    </tr>
    <tr>
      <td> Tax Percentage :</td>
      <td><input type="float" class="form-control " name="product[tax]" value="<?php echo $product->tax ?>"></td>
    </tr>
    <tr>
      <td> Discount :</td>
      <td><input type="float" class="form-control " name="product[discount]" value="<?php echo $product->discount ?>"></td>
    </tr>
    <tr>
      <td> Discount Mode :</td>
      <td><select name="product[discountMode]" class="form-select ">
          <?php foreach ($product->getDiscountMode() as $key => $val): ?>
            <option <?php if($product->discountMode == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    </tr>
    <tr>
      <td> Quantity :</td>
      <td><input type="number" class="form-control " name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
    </tr>
    <tr>
      <td>Status :</td>
      <td>
        <select name="product[status]" class="form-select dropdown ">
          <?php foreach ($product->getStatus() as $key => $val): ?>
            <option <?php if($product->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    </tr>
    
    <?php if($product->productId): ?>
      <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
    <?php endif; ?>
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
        <a href=<?php echo  $this->getUrl('grid',null,['id'=>null]);?>><button type="button" class="btn btn-danger my-2">Cancel</button></a>
      </td>
    </tr>    
  </div>
</form>
  </table>  
</div>
