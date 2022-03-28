<?php  $row = $this->getAdmin(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  
    <table class="form-group w-100" cellspacing="4">
      <tr>
        <td>First Name :</td>
        <td><input type="text" name="admin[firstName]" value="<?php echo $row->firstName ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Last Name :</td>
        <td><input type="text" name="admin[lastName]" value="<?php echo $row->lastName ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Email :</td>
        <td><input type="text" name="admin[email]" value="<?php echo $row->email ?>" class="form-control"></td>
      </tr>
      <?php if(!$row->password): ?>
        <tr>
          <td>Password :</td>
          <td><input type="Password" name="admin[password]" value="<?php echo $row->password ?>" class="form-control"></td>
        </tr>
        
        <tr>
          <td>Confirm Password :</td>
          <td><input type="Password" name="admin[confirmPassword]" ></td>
        </tr>
      <?php endif; ?>   
      <tr>
        <td>Mobile :</td>
        <td><input type="text" name="admin[mobile]" value="<?php echo $row->mobile ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Status :</td>
        <td>
          <select name="admin[status]" class="form-select">
            <?php foreach ($row->getStatus() as $key => $val): ?>
              <option <?php if($row->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="25%">&nbsp;</td>
        <?php if($row->adminId): ?>
        <input type="hidden" name="admin[adminId]" value="<?php echo $row->adminId ?>">
        <?php endif; ?>
        <td>
          <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
          <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger my-2">Cancel</button></a>
        </td>
      </tr>    
    </table>  
</div>