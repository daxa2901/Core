<?php  $row = $this->getAdmin(); ?>
<form action="<?php echo  $this->getUrl('save');?>" method="POST">
<table border="1" width="100%" cellspacing="4">
  <tr>
    <td width="10%">First Name</td>
    <td><input type="text" name="admin[firstName]" value="<?php echo $row->firstName ?>"></td>
  </tr>
  <tr>
    <td width="10%">Last Name</td>
    <td><input type="text" name="admin[lastName]" value="<?php echo $row->lastName ?>"></td>
  </tr>
  <tr>
    <td width="10%">Email</td>
    <td><input type="text" name="admin[email]" value="<?php echo $row->email ?>"></td>
  </tr>
  <tr>
    <td width="10%">Password</td>
    <td><input type="Password" name="admin[password]" value="<?php echo $row->password ?>"></td>
  </tr>
  <?php if(!$row->password): ?>
    <tr>
      <td width="10%">Confirm Password</td>
      <td><input type="Password" name="admin[confirmPassword]" ></td>
    </tr>
  <?php endif; ?>   
  <tr>
    <td width="10%">Mobile</td>
    <td><input type="text" name="admin[mobile]" value="<?php echo $row->mobile ?>"></td>
  </tr>
  <tr>
    <td width="10%">Status</td>
    <td>
      <select name="admin[status]">
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
      <button type="submit" name="submit" class="Registerbtn">Save </button>
      <a href="<?php echo  $this->getUrl('grid',null,null,true);?>"><button type="button" class="cancelbtn">Cancel</button></a>
    </td>
  </tr>    
</table>  
</form>
