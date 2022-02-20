<form action="index.php?c=product&a=save" method="POST">
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
        <a href="index.php?c=product&a=grid"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
