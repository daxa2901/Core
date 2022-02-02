<html>
<head>
<style>
	form {
    
    width: 350px;
    background-color:#f1f1f1;
    margin-left: 500px;
    margin-top: 50px;
    padding-left: 20px;
  		 
  }


 
  input[type=text], input[type=number],input[type=date],select{
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
  .cancelbtn {
    
    
    background-color: #f44336;
    margin-left: 10px;
  }

  .Registerbtn
  {

    background-color: green;
  }
 
 </style>
</head>
<body>
<?php
			include 'C:\xampp\htdocs\PHP\Practice\AdapterClass\Adapter.php';
			$a = new Adapter();
			$conn=$a->connection();
			if(!$conn)
			{
				echo "can't connect  <br>";
			}

			$pid=$_GET['id'];
			$result = $a-> fetch("select * from Product  where id=".$pid);
  			while($row = $result->fetch_assoc())
  			{
				echo "<form action='Product-save.php' method='POST' enctype='multipart/form-data'>";
				echo "<div class='container text-align = center'>";
				
				 echo" <label for='pid'><b>ID</b></label><br>
				  <input type='number' placeholder='Enter Product ID' value='" . $row['id'] ."'name='id' required hidden><br>

				  <label for='name'><b>Name</b></label><br>
				  <input type='text' placeholder='Enter Product Name' value='".$row['name']."' name='name' required><br>

				  <label for='Price'><b>Price</b></label><br>
				  <input type='number' placeholder='Enter Product Price' value='".$row['price']."'name='price' required><br>


				  <label for='quantity'><b>Quantity</b></label><br>
				  <input type='number' placeholder='Enter Product Quantity' value='".$row['quantity']."'name='quantity' required><br>

				  <label for='createdAt'><b>Created At </b></label><br>
				  <input type='Date' placeholder='Enter Created Date'value='".$row['createdAt']."' name='createdAt' required><br>

				  <label for='updatedAt'><b>Updated At</b></label><br>
				  <input type='Date' placeholder='Enter Updated Date' value='".$row['updatedAt']."'name='updatedAt' required><br>
				  
				  <label for='status'><b>status </b></label><br>
				<select id='status' name='status'>
				  <option value=".$row['status'].">".$row['status']."</option>";
				  if ($row['status'] == 1){
				  	echo "<option value='2'>2</option>";

				  }
				  else
				  {
				  	  echo "<option value='1'>1</option>";

				  }
				  
				echo "</select><br>
				 <button type='submit' class='registerbtn' value='Update' name='update'>Update</button>
				<button type='submit' class='cancelbtn' value='Cancel' name='cancel'>Cancel</button>";
				echo "</div></body></html>";
				}

				
echo '</body></html>';
	mysqli_close($conn);

?>
