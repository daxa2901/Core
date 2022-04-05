<?php $shippingMethod = $this->getShippingMethod(); ?>

  <div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div>
            </div>
            <div class="form-group">
              <label >Name :</label>
              <input type="text" class="form-control"  name="shipping[name]" value="<?php echo $shippingMethod->name; ?>">
            </div>
            <div class="form-group">
              <label >Note :</label>
              <input type="text" class="form-control"  name="shipping[note]" value="<?php echo $shippingMethod->note; ?>">
            </div>
            <div class="form-group">
              <label >Amount :</label>
              <input type="text" class="form-control"  name="shipping[amount]" value="<?php echo $shippingMethod->amount; ?>">
            </div>
            <div class="form-group">
              <label >Status :</label>
              <select name="payment[status]" class="form-control">
                <?php foreach ($shippingMethod->getStatus() as $key => $val): ?>
                  <option <?php if($shippingMethod->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>          
              </select>
            </div>
            <?php if($shippingMethod->methodId): ?>
                <input type="hidden" name="shipping[methodId]" value="<?php echo $shippingMethod->methodId ?>" class="form-control">
            <?php endif; ?>
            <div class="card-footer">
             <button type="button" name="submit" class="btn btn-primary my-2" id="shippingSaveBtn">Save </button>
              <button type="button" class="btn btn-danger my-2" id="shippingCancelBtn">Cancel</button></a>
          </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
jQuery("#shippingSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#shippingCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

</script>