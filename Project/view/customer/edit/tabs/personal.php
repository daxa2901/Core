<?php $customer = $this->getCustomer();?>

<script type="text/javascript">
  jQuery("#customerSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#customerCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

jQuery("#customerSaveNext").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save',null,['tab'=>'address'])?>");
  admin.load();
});

</script>
<div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div class="form-group">
              <label >First Name :</label>
              <input type="text" class="form-control"  name="customer[firstName]" value="<?php echo $customer->firstName; ?>">
            </div>
            <div class="form-group">
              <label >Last Name :</label>
              <input type="text" class="form-control"  name="customer[lastName]" value="<?php echo $customer->lastName; ?>" >
            </div>
            <div class="form-group">
              <label > Email :</label>
              <input type="Email" class="form-control"  name="customer[email]" value="<?php echo $customer->email; ?>" >
            </div>
            <div class="form-group">
              <label >Mobile :</label>
              <input type="tel" class="form-control"  name="customer[mobile]" value="<?php echo $customer->mobile; ?>" >
            </div>
            <div class="form-group">
              <label >Status :</label>
              <select name="customer[status]" class="form-control">
                <?php foreach ($customer->getStatus() as $key => $val): ?>
                  <option <?php if($customer->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          <div class="card-footer">
            <?php if($customer->customerId): ?>
              <input type="hidden" class="form-control"  name="customer[customerId]" value="<?php echo $customer->customerId; ?>" >
            <?php endif; ?>
            <button type="button" name="submit" class="btn btn-primary my-2" id="customerSaveBtn">Save </button>
            <button type="button" name="submit" class="btn btn-primary my-2" id = "customerSaveNext" value="saveAndNext">Save & Next</button>
            <button type="button" class="btn btn-danger my-2" id = "customerCancelBtn">Cancel</button>
          </div>
      </div>
    </div>
  </div>
</div>
