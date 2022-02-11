<?php
      global $adapter;
      $pid=$_GET['id'];
      $query = "SELECT * FROM Customer  
            WHERE customerId=".$pid;
      $row = $adapter-> fetchRow($query);
      $query2 = "SELECT 
                  a.* 
                FROM 
              Address a 
                JOIN 
              Customer c ON a.customerId = c.customerId WHERE a.customerId =".$pid;  
      $row2 = $adapter-> fetchRow($query2);     
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
  <form action="index.php?a=save" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b></td>
    </tr>
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="customer[firstName]" value="<?php echo $row['firstName'] ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="customer[lastName]" value="<?php echo $row['lastName'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="customer[email]" value="<?php echo $row['email'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">Mobile</td>
      <td><input type="text" name="customer[mobile]" value="<?php echo $row['mobile'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="customer[status]">

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
      <td colspan="2"><b>Address Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" name="address[address]" value="<?php echo $row2['address'] ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" name="address[city]" value="<?php echo $row2['city'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" name="address[state]" value="<?php echo $row2['state'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" name="address[postalCode]" value="<?php echo $row2['postalCode'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" name="address[country]" value="<?php echo $row2['country'] ?>"></td>
    </tr>
    <tr>    
      <td>
        <?php if($row2['billing'] == '1'): ?>
          <input type="checkbox" name="address[billing]" value=1 checked>Billing Addres</td>
        <?php else: ?>
          <input type="checkbox" name="address[billing]" value=1>Billing Addres</td>
        <?php endif; ?>

      <td>
        <?php if($row2['shipping'] == '1'): ?>
          <input type="checkbox" name="address[shipping]" checked value=1> Shipping Address</td>
        <?php else: ?>
          <input type="checkbox" name="address[shipping]" value=1> Shipping Address</td>
        <?php endif; ?>

    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="customer[customerId]" value="<?php echo $row['customerId'] ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Update </button>
        <a href="index.php?c=customer&a=grid"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>