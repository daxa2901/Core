<html>
<head>
<style>
 	form {
    
    width: 350px;
    background-color:#f1f1f1;
    margin-left: 500px;
    margin-top: 0px;
    padding-left: 00px;
  }

  input[type=text],select,input[type=number],input[type=float],input[type=date]{
    width: 300px;
    padding: 12px 20px;
    margin: 0px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  button {  
    color: white;
    padding: 14px 20px;
    margin: 18px 0;
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

</style>
</head>
<body>
	<?php
			include 'C:\xampp\htdocs\PHP\Practice\AdapterClass\Adapter.php';
			
			$pid=$_GET['id'];
			$row = $adapter-> fetchRow("select * from Product  where id=".$pid);

		  echo 
		  "<form action='Product-save.php' method='post'>

      <input type='hidden' value='".$row['id']."' name='id' required>
	 
      <label for='name'><b>Name</b></label><br>
      <input type='text' placeholder='Enter Product Name' value='".$row['name']."' name='name' required><br>

      <label for='price'><b>Price</b></label><br>
      <input type='float' placeholder='Enter Product Price' value='". $row['price'] ."' name='price' required><br>

      <label for='quantity'><b>Quantity</b></label><br>
      <input type='number' placeholder='Enter Product Quantity' value='".$row['quantity']."' name='quantity' required><br>

      <label for='created Date'><b>created At</b></label><br>
      <input type='date' placeholder='Enter created date'  value='".$row['createdAt']."' name='createdAt' required><br>

      <label for='updated Date'><b>update At</b></label><br>
      <input type='date' placeholder='Enter updated date'  value='".$row['updatedAt']."' name='updatedAt' required><br>

      <label for='Status'><b>Status</b></label><br>
      <select id='status' name='status'>";
				  if ($row['status'] == 1){
				  	echo "<option value='1'>InActive</option>";
				  	echo "<option value='2'>Active</option>";

				  }
				  else
				  {
				  	echo "<option value='2'>Active</option>";
				 		echo "<option value='1'>InActive</option>";

				  }
				echo "</select><br>";
      echo "<button type='submit' class='Registerbtn' value='Update' name='update'>Update</button>
    			 <a href = 'Product-grid.php'><button type='button' class='cancelbtn' value='Cancel' name='cancel'>Cancel</button></a>
     
  </form>
  </body>
  </html>";