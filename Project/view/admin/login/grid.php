<div class="container w-50 my-3 shadow-lg bg-light">
  <h1 class="text-center">Login</h1>
<form action="<?php echo  $this->getUrl('loginPost');?>" method="POST" class="p-2">
    <table class="form-group w-100" cellspacing="4">
    <tr>
      <td >Email Id :</td>
      <td><input type="email" name="login[email]" class="form-control"></td>
    </tr>
    <tr>
      <td >Password :</td>
      <td><input type="Password" name="login[password]" class="form-control "></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="btn btn-primary my-2">Login </button>
      </td>
    </tr>    
  </table>  
</form>
</div>