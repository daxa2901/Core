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
  <form action="Customer.php?a=saveAction" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b></td>
    </tr>
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="customer[firstName]"></td>
    </tr>
    
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="customer[lastName]"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="customer[email]"></td>
    </tr>
    <tr>
      <td width="10%">Mobile</td>
      <td><input type="text" name="customer[mobile]"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="customer[status]">
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2"><b>Address Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" name="address[address]"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" name="address[city]"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" name="address[state]"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" name="address[postalCode]"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" name="address[country]"></td>
    </tr>
    <tr>    
      <td><input type="checkbox" name="address[billing]" value="1">Billing Addres</td>
      <td><input type="checkbox" name="address[shipping]" value="1"> Shipping Address</td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="Customer.php?a=gridAction"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html