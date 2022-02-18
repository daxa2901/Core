<?php 
  $result = $this->getCategoryToPath();

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
  <form action="index.php?c=category&a=save" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="category[name]"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="category[status]">
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
    <tr>
      <td width="10%">Parent Category</td>
      <td>
        <select name="category[parentId]">
          <option value=>Root</option>
            <?php foreach ($result as $key=>$value):?>
                <option value=<?php echo $key?>><?php echo $value; ?></option>
            <?php endforeach;?>
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
  </html