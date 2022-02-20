<?php  $row = $this->getData('admin'); ?>
<form action="index.php?c=admin&a=save" method="POST">
<table border="1" width="100%" cellspacing="4">
  <tr>
    <td width="10%">First Name</td>
    <td><input type="text" name="admin[firstName]" value="<?php echo $row['firstName'] ?>"></td>
  </tr>
  <tr>
    <td width="10%">Last Name</td>
    <td><input type="text" name="admin[lastName]" value="<?php echo $row['lastName'] ?>"></td>
  </tr>
  <tr>
    <td width="10%">Email</td>
    <td><input type="text" name="admin[email]" value="<?php echo $row['email'] ?>"></td>
  </tr>
  <tr>
    <td width="10%">Password</td>
    <td><input type="Password" name="admin[password]" value="<?php echo $row['password'] ?>"></td>
  </tr>
  <tr>
    <td width="10%">Mobile</td>
    <td><input type="text" name="admin[mobile]" value="<?php echo $row['mobile'] ?>"></td>
  </tr>
  <tr>
    <td width="10%">Status</td>
    <td>
      <select name="admin[status]">

        <?php if ($row['status' ] == 1):?>
            <option value='1'>Active</option>
            <option value='2'>InActive</option>
        <?php else: ?>
            <option value='2'>InActive</option>
                  <option value='1'>Active</option>
        <?php endif;?>
      </select>
    </td>
  </tr>
  <tr>
    <td width="25%">&nbsp;</td>
    <input type="hidden" name="admin[adminId]" value="<?php echo $row['adminId'] ?>">
    <td>
      <button type="submit" name="submit" class="Registerbtn">Update </button>
      <a href="index.php?c=admin&a=grid"><button type="button" class="cancelbtn">Cancel</button></a>
    </td>
  </tr>    
</table>  
</form>
