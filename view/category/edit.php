<?php
      global $adapter;      
      $pid=$_GET['id'];
      $query = "SELECT 
                  * 
      FROM Category WHERE categoryId=".$pid;
      $row = $adapter-> fetchRow($query);
?>

<html>
<head>
<style>
 	form {
    
    width: 650px;
    background-color:#f1f1f1;
    margin-left: 400px;
    margin-top: 20px;
  
  }

  input[type=text],select,input[type=number],input[type=float],input[type=date]{
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
    margin: 18px 15px;
    border: none;
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
  .container
  {
    padding-left: 30px;

  }

</style>
</head>
  <body>
    <form action="index.php?c=category&a=save" method="POST">
      <table border="1" width="100%" cellspacing="4">
        <tr>
          <td width="10%"> Name</td>
          <td><input type="text" name="category[name]" value="<?php echo $row['name'] ?>"></td>
        </tr>
        <input type="hidden" name="category[id]" value="<?php echo $row['categoryId'] ?>">
        <tr>
          <td width="10%">Status</td>
          <td>
            <select name="category[status]">
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
          <td>
            <button type="submit" name="submit" class="Registerbtn">Save </button>
            <a href="index.php?c=category&a=grid"><button type="button" class="cancelbtn">Cancel</button></a>
          </td>
        </tr>    
      </table>  
    </form>
    </body>
  </html>
