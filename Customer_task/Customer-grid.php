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
	<h1> Customer Details </h1> 
	<form action="Customer.php?a=addAction" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>
<?php
	global $adapter; 
	$result = $adapter-> fetchAll("Select * from Customer");

	echo "<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Id </th>
			<th> First Name </th>
			<th> Last Name </th>
			<th> Email </th>
			<th> Mobile </th>
			<th> Status </th>
			<th> Create Date </th>
			<th> Update Date </th>
			<th> Action </th>
		</tr>";
		if($result):
			foreach ($result as $row):
				echo '<tr>
		      		<td>' . $row["customer_id"] . '</td>
		    		<td>' . $row["firstName"] . '</td>
		    		<td>' . $row["lastName"] . '</td>
		    		<td>' . $row["email"] .'</td>
		    		<td>' . $row["mobile"] .'</td>
		    		<td>' . $row["createdDate"] .'</td>
		    		<td>' . $row["updatedDate"] .'</td><td>';
		    		if ($row['status'] == 1):
		    			echo 'InActive';
		    		else:
		    			echo 'Active';
		    		endif;
		    		echo '</td><td>
		    			<a href="Customer.php?a=deleteAction&id='.$row['customer_id'].'">Delete</a> 
		    			<a href="Customer.php?a=editAction&id='.$row['customer_id'].'">Update</a></td>
		   		</tr>' ;
		  endforeach;
		else:
			echo "<tr><td colspan='8'>No Record Available</td></tr>";			
		endif;
 
	echo "</table></div></body></html>";

?>