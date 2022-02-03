<html>
<head>

	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	<style>	
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
	<h1> Category Details </h1> 
	<form action="Category-add.php" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>
	<?php
	include 'C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php';
 
	$result = $adapter-> fetchAll("Select * from Category");

	echo "<div id='info'>";
	echo '<table border=1 width=100%>';
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
			foreach ($result as $row) {
		
			echo '<tr>';
		    echo  '	<td>' . $row["id"] . '</td>
		    		<td>' . $row["name"] . '</td>
		    		<td>' . $row['price'] .'</td>
		    		<td>' . $row["quantity"] .'</td>
		    		<td>' . $row["createdAt"] . '</td>
		    		<td>' . $row["updatedAt"] .'</td><td>';
		    		if ($row['status'] == 1){
		    			echo ' InActive ';
		    		}
		    		else
		    		{
		    			echo ' Active ';

		    		}
		    		echo '</td><td><a href="Category-delete.php?id='.$row['id'].'">Delete</a> 
		    		<a href="Category-edit.php?id='.$row['id'].'">Update</a></td>
		    		</tr>' ;
		  }
		}
 
	echo '</table></div></body></html>';

?>