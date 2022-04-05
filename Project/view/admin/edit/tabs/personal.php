<?php  $admin = $this->getAdmin(); ?>
<script type="text/javascript">
  jQuery("#adminSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#adminCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
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
              <input type="text" class="form-control"  name="admin[firstName]" value="<?php echo $admin->firstName; ?>">
            </div>
            <div class="form-group">
              <label >Last Name :</label>
              <input type="text" class="form-control"  name="admin[lastName]" value="<?php echo $admin->lastName; ?>">
            </div>
            <div class="form-group">
              <label >Email :</label>
              <input type="email" class="form-control"  name="admin[email]" value="<?php echo $admin->email; ?>">
            </div>
            <?php if(!$admin->password): ?>
              <div class="form-group">
                <label >Password :</label>
                <input type="Password" class="form-control"  name="admin[password]" value="<?php echo $admin->password; ?>">
              </div>
              <div class="form-group">
               <label >Confirm Password :</label>
                <input type="Password" class="form-control"  name="admin[confirmPassword]" value="<?php echo $admin->confirmPassword; ?>">
              </div>
            <?php endif; ?>
            <div class="form-group">
               <label >Mobile :</label>
                <input type="tel" class="form-control"  name="admin[mobile]" value="<?php echo $admin->mobile; ?>">
              </div>
            <div class="form-group">
              <label >Status :</label>
               <select name="admin[status]" class="form-control">
                <?php foreach ($admin->getStatus() as $key => $val): ?>
                  <option <?php if($admin->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="card-footer">
              <?php if($admin->adminId): ?>
                <input type="hidden" name="admin[adminId]" value="<?php echo $admin->adminId ?>">
              <?php endif; ?>
       
            <button type="button" name="submit" class="btn btn-primary my-2" id="adminSaveBtn">Save </button>
            <button type="button" class="btn btn-danger my-2" id = "adminCancelBtn">Cancel</button>
          </div>
          </div>
      </div>
    </div>
  </div>

