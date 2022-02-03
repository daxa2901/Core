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
	<?php
			global $adapter;
			$pid=$_GET['id'];
			$row = $adapter-> fetchRow("select * from Product  where id=".$pid);

		  echo 
		  "<form action='Product.php?a=saveAction' method='post'>
          <div class='container'>
            <label for='name'><b>Name</b></label><br>
            <input type='text' placeholder='Enter Product Name' value='".$row['name']."' name='name' required><br>

            <label for='price'><b>Price</b></label><br>
            <input type='float' placeholder='Enter Product Price' value='". $row['price'] ."' name='price' required><br>

            <label for='quantity'><b>Quantity</b></label><br>
            <input type='number' placeholder='Enter Product Quantity' value='".$row['quantity']."' name='quantity' required><br>

            <label for='Status'><b>Status</b></label><br>
            <select id='status' name='status'>";
      				  if ($row['status'] == 1):
      				  	echo "<option value='1'>InActive</option>
      				  	      <option value='2'>Active</option>";
      				  else:
      				  	echo "<option value='2'>Active</option>
      				 		      <option value='1'>InActive</option>";
                endif;
      				echo "</select><br>";
              echo "<input type='hidden' value='".$row['id']."' name='id' required>";

               echo "<button type='submit' class='Registerbtn' value='Update' name='update'>Update</button> <a href = 'Product.php?a=gridAction'><button type='button' class='cancelbtn' value='Cancel' name='cancel'>Cancel</button></a>
             </div>  
          </form>
     </body>
  </html>";
?>