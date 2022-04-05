<?php $paymentMethod = $this->getPaymentMethod(); ?>

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
              <input type="text" class="form-control"  name="payment[name]" value="<?php echo $paymentMethod->name; ?>">
            </div>
            <div class="form-group">
              <label >Note :</label>
              <input type="text" class="form-control"  name="payment[note]" value="<?php echo $paymentMethod->note; ?>">
            </div>
            <div class="form-group">
              <label >Status :</label>
              <select name="payment[status]" class="form-control">
                <?php foreach ($paymentMethod->getStatus() as $key => $val): ?>
                  <option <?php if($paymentMethod->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>          
              </select>
            </div>
            <?php if($paymentMethod->methodId): ?>
                <input type="hidden" name="payment[methodId]" value="<?php echo $paymentMethod->methodId ?>" class="form-control">
            <?php endif; ?>
            <div class="card-footer">
             <button type="button" name="submit" class="btn btn-primary my-2" id="paymentSaveBtn">Save </button>
            <button type="button" class="btn btn-danger my-2" id="paymentCancelBtn">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
jQuery("#paymentSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#paymentCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

</script>