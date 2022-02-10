<html>
<head>
<style>
     
  form {
    
    width: 650px;
    background-color:#f1f1f1;
    margin-left: 400px;
    margin-top: 20px;
  
  }
  input[type=text],select,input[type=number],input[type=tel],input[type=date],input[type=email]{
    width: 300px;
    padding: 12px 20px;
    margin: 2px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }


  button {
    
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 85px;
  }

  button:hover {
    opacity: 0.8;
  }

  .Registerbtn
  {
    background-color: green;
  }

  .cancelbtn
  {
    background-color: red;
  }

</style>
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