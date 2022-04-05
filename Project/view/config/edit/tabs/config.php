<?php $config = $this->getConfig(); ?>
<div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div class="form-group">
              <label >Name :</label>
              <input type="text" class="form-control"  name="config[name]" value="<?php echo $config->name; ?>">
            </div>
            <div class="form-group">
              <label >Code :</label>
              <input type="text" class="form-control"  name="config[code]" value="<?php echo $config->code; ?>">
            </div>
            <div class="form-group">
              <label >Value :</label>
              <input type="text" class="form-control"  name="config[value]" value="<?php echo $config->value; ?>">
            </div>
            <div class="form-group">
              <label >Status :</label>
               <select name="config[status]" class="form-control">
                <?php foreach ($config->getStatus() as $key => $val): ?>
                  <option <?php if($config->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <?php if($config->configId): ?>
                <input type="hidden" name="config[configId]" value="<?php echo $config->configId ?>">
            <?php endif; ?>
        
            <div class="card-footer">
            <button type="button" name="submit" class="btn btn-primary my-2" id="configSaveBtn">Save </button>
            <button type="button" class="btn btn-danger my-2" id = "configCancelBtn">Cancel</button>
          </div>
          </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
jQuery("#configSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#configCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

</script>