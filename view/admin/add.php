<html>
<head>
  <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
  <form action="index.php?c=admin&a=save" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="admin[firstName]"></td>
    </tr>
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="admin[lastName]"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="admin[email]"></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="Password" name="admin[password]"></td>
    </tr>
    <tr>
      <td width="10%">Confirm Password</td>
      <td><input type="Password" name="admin[confirmPassword]"></td>
    </tr>
    <tr>
      <td width="10%">Mobile</td>
      <td><input type="text" name="admin[mobile]"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="admin[status]">
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="index.php?c=admin&a=grid"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html