<?php
	global $adapter; 
	$query = "SELECT 
				* 
			FROM Customer";
	$query2 = "SELECT a.address 
			FROM Customer c 
				JOIN  
			address a ON c.customerId = a.customerId";
	$result = $adapter-> fetchAll($query);
	$address = $adapter-> fetchAll($query2);

?>
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
	<form action="index.php?c=customer&a=add" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>

	<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Id </th>
			<th> First Name </th>
			<th> Last Name </th>
			<th> Email </th>
			<th> Mobile </th>
			<th> Status </th>
			<th> Address </th>
			<th> Create Date </th>
			<th> Update Date </th>
			<th> Action </th>
		</tr>
		<?php if($result):
			foreach ($result as $index => $value): ?>
				 
				<tr>
		      		<td><?php echo $result[$index]["customerId"] ?></td>
		    		<td><?php echo $result[$index]["firstName"] ?></td>
		    		<td><?php echo $result[$index]["lastName"] ?></td>
		    		<td><?php echo $result[$index]["email"] ?></td>
		    		<td><?php echo $result[$index]["mobile"] ?></td>
		    		<td>
			    		<?php if ($result[$index]['status'] == 1):
			    			echo 'Active';
			    		else:
			    			echo 'InActive';
			    		endif; ?>
		    		</td>
		    		<td> <?php echo $address[$index]['address'] ?> </td>
		    		<td><?php echo $result[$index]["createdDate"] ?></td>
		    		<td><?php echo $result[$index]["updatedDate"] ?></td>
		    		<td>
		    			<a href="index.php?a=delete&id=<?php echo $result[$index]['customerId'] ?>">Delete</a> 
		    			<a href="index.php?a=edit&id=<?php echo $result[$index]['customerId']?>">Update</a></td>
		   		</tr>
		 <?php endforeach;?>
		<?php else:?>
			<tr><td colspan='10'>No Record Available</td></tr>			
		<?php endif; ?>
 
	</table>
	</div>
</body>
</html>