<?php  $salseman = $this->getSalseman(); ?>
  <div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div class="form-group">
              <label >First Name :</label>
              <input type="text"  class="form-control " name="salseman[firstName]" value="<?php echo $salseman->firstName ?>">
            </div> 
            <div class="form-group">
              <label >Last Name :</label>
              <input type="text"  class="form-control " name="salseman[lastName]" value="<?php echo $salseman->lastName ?>">
            </div>
            <div class="form-group">
              <label>Mobile :</label>
              <input type="tel"  class="form-control " name="salseman[mobile]" value="<?php echo $salseman->mobile ?>">
            </div>
            <div class="form-group">
              <label>Email :</label>
              <input type="email"  class="form-control " name="salseman[email]" value="<?php echo $salseman->email ?>">
            </div>
            <div class="form-group">
              <label>Percentage :</label>
              <input type="float"  class="form-control " name="salseman[percentage]" value="<?php echo $salseman->percentage ?>">
            </div> 
            <div class="form-group">
              <label>Status :</label>
              <select name="salseman[status]" class="form-control">
              <?php foreach ($salseman->getStatus() as $key => $val): ?>
                  <option <?php if($salseman->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
              <?php endforeach; ?>
              </select>
            </div> 
            <?php if($salseman->salsemanId): ?>
              <input type="hidden" name="salseman[salsemanId]" value="<?php echo $salseman->salsemanId ?>">
            <?php endif; ?>
            <div class="card-footer">
              <button type="button" name="submit" class="btn btn-primary my-2" id="salsemanSaveBtn">Save </button>
              <button type="button" name="submit" class="btn btn-primary my-2" id="salsemanSaveNext">Save & Next </button>
              <button type="button" class="btn btn-danger my-2" id = "salsemanCancelBtn">Cancel</button>
          </div>
          </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
jQuery("#salsemanSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#salsemanCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});
jQuery("#salsemanSaveNext").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save',null,['tab'=>'customer'])?>");
  admin.load();
});

</script>