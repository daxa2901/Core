<?php $vendor = $this->getVendor();?>
  <div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div>
            </div>
            <div class="form-group">
              <label >First Name :</label>
              <input type="text" class="form-control"  name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>">
            </div>
            <div class="form-group">
              <label>Last Name :</label>
              <input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>" class="form-control">
           </div>
          <div class="form-group">
            <label>Email : </label>
            <input type="text" name="vendor[email]" value="<?php echo $vendor->email; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label>  Mobile : </label>
            <input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label>Status : </label>
          </div>
          <div class="form-group">
            <select name="vendor[status]" class="form-control">
              <?php foreach ($vendor->getStatus() as $key => $val): ?>
                <option <?php if($vendor->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php if($vendor->vendorId): ?>
            <input type="hidden" name="vendor[vendorId]" value="<?php echo $vendor->vendorId; ?>">
          <?php endif ?>
          <div class="card-footer">
            <button type="button" name="submit" class="btn btn-primary my-2" id="vendorSaveBtn">Save </button>
            <button type="button" name="submit" class="btn btn-primary my-2" id = "customerSaveNext" value="saveAndNext">Save & Next</button>
            <button type="button" class="btn btn-danger my-2" id="vendorCancelBtn">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
  jQuery("#vendorSaveBtn").click(function () {
    admin.setForm(jQuery("#indexForm"));
    // alert("<?php echo $this->getEdit()->getEditUrl()?>");
    admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
    admin.load();
  });

   jQuery("#vendorCancelBtn").click(function () {
    admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
    admin.load();
  });

   
jQuery("#customerSaveNext").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save',null,['tab'=>'address'])?>");
  admin.load();
});

</script>
