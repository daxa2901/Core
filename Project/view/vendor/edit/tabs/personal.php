<?php $vendor = $this->getVendor();?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class = "form-group w-100" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b><hr></td>
    </tr>
    <tr>
      <td>First Name :</td>
      <td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>" class="form-control"></td>
    </tr>
    
    <tr>
      <td>Last Name :</td>
      <td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Email :</td>
      <td><input type="text" name="vendor[email]" value="<?php echo $vendor->email; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Mobile :</td>
      <td><input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Status :</td>
      <td>
        <select name="vendor[status]" class="form-select">
          <?php foreach ($vendor->getStatus() as $key => $val): ?>
            <option <?php if($vendor->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    
    <tr>
      <td></td>
      <?php if($vendor->vendorId): ?>
        <input type="hidden" name="vendor[vendorId]" value="<?php echo $vendor->vendorId; ?>">
      <?php endif ?>
      <td>
        <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
        <button type="submit" name="submit" class="btn btn-primary my-2" name = 'save&next' value="save&next">Save & Next</button>
        <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger my-2">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</div>