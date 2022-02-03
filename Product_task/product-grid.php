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
	<h1> Product Details </h1> 
	<form action="Product.php?a=addAction" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>
	<?php
	global $adapter;
	$result = $adapter-> fetchAll("Select * from Product");

	echo "<div id='info'>
	<table border=1 width=100%>";
		echo '<tr>
			<th> Id </th>
			<th> Name </th>
			<th> Price </th>
			<th> Quantity </th>
			<th> Created_At </th>
			<th> Updated_At </th>
			<th> Status </th>
			<th> Action </th>
		</tr>';
		if($result):
		
			foreach ($result as $row):
		
				echo '<tr>';
		    	echo '<td>' . $row["id"] . '</td>
		    		<td>' . $row["name"] . '</td>
		    		<td>' . $row['price'] .'</td>
		    		<td>' . $row["quantity"] .'</td>
		    		<td>' . $row["createdAt"] . '</td>
		    		<td>' . $row["updatedAt"] .'</td><td>';
		    		if ($row['status'] == 1):
		    			echo ' InActive ';
		    		else:
		    			echo ' Active ';
		    		endif;
		    		echo '</td><td><a href="Product.php?a=deleteAction&id='.$row['id'].'">Delete</a> 
		    		<a href="Product.php?a=editAction&id='.$row['id'].'">Update</a></td>
		    		</tr>' ;
		  endforeach;
		else:
			echo "<tr><td colspan='8'>No Record Available</td></tr>";
		endif;
 
	echo '</table></div></body></html>';

?>