<html>
<head>

		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
		<style>
		#info{
			margin-left: 25%;

		} 		
		
		#info tr:nth-child(even){
			background-color:#eeee;
			
			
		}
		#info tr:nth-child(odd){
			background-color:#3498db;
			
		}
		
		#info th, #info td{
		padding:10;
		text-align:center;
		}
		#info a{
			color:black;
		}
		button {
	    
	    color: white;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    cursor: pointer;
	    width: 100px;
   	    }

	    button:hover {
	    opacity: 0.8;
	    }

	  .Registerbtn
	  {

	    background-color: green;
	  }
	  
</style>
</head>
<body>
	<div class='container' style="text-align: center; ">
<form action="Product-add.php" method="POST">
	<button type="submit" name="Add" class="Registerbtn"> Add Product</button>
</form>
	<?php
	include 'C:\xampp\htdocs\PHP\Practice\AdapterClass\Adapter.php';
	$a = new Adapter();
	$conn=$a->connection();
	if(!$conn)
	{
		echo "can't connect  <br>";
	}
	 
	$result = $a-> fetch("Select * from Product");

	echo "<div id='info'>";
	echo '<table border=1>';
		echo '<tr>';
			echo '<th> Id </th>';
			echo '<th> Name </th>';
			echo'<th> Price </th>';
			echo'<th> Quantity </th>';
			echo'<th> Created_At </th>';
			echo'<th> Updated_At </th>';
			echo'<th> Status </th>';
			echo'<th> Action </th>';
		echo '</tr>';
		if($result)
		{
		  while($row = $result->fetch_assoc()) {
		  	echo '<tr>';
		    echo  '<td>' . $row["id"] . '<td>' . $row["name"] . '<td>' . $row['price'] .'<td>' . $row["quantity"] .'<td>' . $row["createdAt"] . '<td>' . $row["updatedAt"] .'<td>' . $row["status"] .'<td><a href="Product-delete.php?id='.$row['id'].'">Delete</a> <a href="Product-edit.php?id='.$row['id'].'">Update</a></td></tr>' ;
		  }
		}

		else
		{
			echo "Can not find record";
		} 
	echo '</div></div></body></html>';

?>