<?php $product = $this->getProduct(); ?>
  <div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div class="form-group">
              <label >Name :</label>
              <input type="text"  class="form-control " name="product[name]" value="<?php echo $product->name ?>">
            </div> 
            <div class="form-group">
              <label >Price :</label>
              <input type="text"  class="form-control " name="product[price]" value="<?php echo $product->price ?>">
            </div>
            <div class="form-group">
              <label >Cost :</label>
              <input type="float"  class="form-control " name="product[cost]" value="<?php echo $product->cost ?>">
            </div>
            <div class="form-group">
              <label >Sku :</label>
              <input type="text"  class="form-control " name="product[sku]" value="<?php echo $product->sku ?>">
            </div>
            <div class="form-group">
              <label >Tax Percentage :</label>
              <input type="float"  class="form-control " name="product[tax]" value="<?php echo $product->tax ?>">
            </div>
            <div class="form-group">
              <label >Discount :</label>
              <input type="float"  class="form-control " name="product[discount]" value="<?php echo $product->discount ?>">
            </div> 
            <div class="form-group">
              <label >Discount Mode:</label>
              <select name="product[discountMode]" class="form-control ">
                <?php foreach ($product->getDiscountMode() as $key => $val): ?>
                  <option <?php if($product->discountMode == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>          
              </select>
            </div>
            <div class="form-group">
              <label >Quantity :</label>
              <input type="float"  class="form-control " name="product[quantity]" value="<?php echo $product->quantity ?>">
            </div>
            <div class="form-group">
              <label >Status :</label>
              <select name="product[status]" class="form-control ">
                <?php foreach ($product->getStatus() as $key => $val): ?>
                  <option <?php if($product->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>          
              </select>
            </div>
            <?php if($product->productId): ?>
              <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
            <?php endif; ?>
            <div class="card-footer">
              <button type="button" name="submit" class="btn btn-primary my-2" id="productSaveBtn">Save </button>
              <button type="button" name="submit" class="btn btn-primary my-2" id = "productSaveNext" value="saveAndNext">Save & Next</button>
              <button type="button" class="btn btn-danger my-2" id = "productCancelBtn">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
jQuery("#productSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#productCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});
jQuery("#productSaveNext").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save',null,['tab'=>'category'])?>");
  admin.load();
});

</script>
    