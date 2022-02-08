<?php
	global $adapter; 
	$query = "SELECT 
				* 
			FROM Category";
	$result = $adapter->fetchAll($query);
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
	<h1> Category Details </h1> 
	<form action="index.php?c=category&a=add" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>
	<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Id </th>
			<th> Name </th>
			<th> Created_At </th>
			<th> Updated_At </th>
			<th> Status </th>
			<th> Action </th>
		</tr>
		<?php if($result): ?>
			<?php foreach ($result as $row):?>
				<tr>
		      		<td> <?php echo $row["categoryId"] ?></td>
		    		<td><?php echo $row["name"] ?></td>
		    		<td><?php echo $row["createdAt"] ?></td>
		    		<td><?php echo $row["updatedAt"] ?></td><td>
		    		<?php if ($row['status'] == 1): 
		    			echo ' Active ';
		    		else:
		    			echo ' InActive ';
		    		endif;?>
		    		</td>
		    		<td><a href="index.php?c=category&a=delete&id=<?php echo $row['categoryId'] ?>">Delete</a> 
		    		<a href="index.php?c=category&a=edit&id=<?php echo $row['categoryId'] ?>">Update</a></td>
		   		</tr>
		  <?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan='8'>No Record Available</td>
			</tr>		
		<?php endif; ?>
	</table>
	</div>
</body>
</html>
