
<form action="<?php echo  $this->getUrl('loginPost');?>" method="POST">
    <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">Email Id :</td>
      <td><input type="email" name="login[email]" ></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="Password" name="login[password]" ></td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Login </button>
      </td>
    </tr>    
  </table>  
</form>
