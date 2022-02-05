<html>
<head>
<style> 
  form {
    
    width: 650px;
    background-color:#f1f1f1;
    margin-left: 400px;
    margin-top: 50px;
    padding-left: 10px;
  }

  input[type=text],select,input[type=number],input[type=float],input[type=date]{
    width: 300px;
    padding: 12px 20px;
    margin: 8px 0;
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
  .container {
    padding: 16px;
  }

</style>
</head>
<body>
  <form action="Product.php?a=saveAction" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="product[name]"></td>
    </tr>
    <tr>
      <td width="10%"> Price</td>
      <td><input type="float" name="product[price]"></td>
    </tr>
    <tr>
      <td width="10%"> Quantity</td>
      <td><input type="number" name="product[quantity]"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="product[status]">
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="Product.php?a=gridAction"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>