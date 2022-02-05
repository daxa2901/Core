<?php
      global $adapter;
      $pid=$_GET['id'];
      $query = "SELECT * FROM Product WHERE id=".$pid;
      $row = $adapter-> fetchRow($query);
?>
<html>
<head>
<style>
form {
    
    width: 350px;
    background-color:#f1f1f1;
    margin-left: 500px;
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
   <form action='Product.php?a=saveAction' method='post'>
        <div class='container'>
          <label for='name'><b>Name</b></label><br>
          <input type='text' placeholder='Enter Product Name' value="<?php echo $row['name'] ?>" name='product[name]' required><br>

          <label for='price'><b>Price</b></label><br>
          <input type='float' placeholder='Enter Product Price' value="<?php echo $row['price'] ?>" name='product[price]' required><br>

          <label for='quantity'><b>Quantity</b></label><br>
          <input type='number' placeholder='Enter Product Quantity' value="<?php echo $row['quantity']?>" name='product[quantity]' required><br>

          <label for='Status'><b>Status</b></label><br>
          <select id='status' name='product[status]'>
    				  <?php if ($row['status'] == 1): ?>
    				  	<option value='1'>InActive</option>
    			      <option value='2'>Active</option>
    				  <?php else:?>
    				  	<option value='2'>Active</option>
    				 		<option value='1'>InActive</option>
              <?php endif ?>
    				</select><br>
            <input type='hidden' value="<?php echo $row['id']?>" name='product[id]'required>

            <button type='submit' class='Registerbtn' value='Update' name='update'>Update</button><a href = 'Product.php?a=gridAction'><button type='button' class='cancelbtn' value='Cancel' name='cancel'>Cancel</button></a>
        </div>  
    </form>
  </body>
</html>