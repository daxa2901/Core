<?php
class Adapter
{
	public $servername = 'localhost';
	public $username = 'root';
	public $pass = '';
	public $db = 'Product';
	public $con;
	#Connection function
	public function connection()
	{
		$this->con= mysqli_connect($this->servername,$this->username,$this->pass,$this->db);
		if(!$this->con)
		{
			return false; 
		}
		else
		{
			return $this->con;
		}



	}
	# Insert Function
	public function insert($query)
	{
		$res=mysqli_query($this->con,$query);
		if(!$res)
		{

			return false;
		}
		else
		{
			$last_id = $this->con->insert_id;
			return $last_id;

		}
					
	}

	# Update Function
	public function update($query)
	{
		$res=mysqli_query($this->con,$query);
		if(!$res)
		{
			return false;
		}
		else
		{
			return true;
		}
					
	}

	#Delete Function
	public function delete($query)
	{
		$res=mysqli_query($this->con,$query);
		if (!$res)		{
			return false;
		}
		else
		{
			return true;
		}
					
	}

	#Fetch Function
	public function fetch($query)
	{
		$res=mysqli_query($this->con,$query);
		if ($res->num_rows > 0) {
	  		return $res;
		}

		else
		{
			return false;
		}
					
	}


} 


# Create object 
$a = new Adapter();

#Connection function call
/*$conn=$a->connection();
if($conn)
{
	echo "Connect Successfully <br>";
}
else
{
	echo "Can't connect ";
}

# Insert Function call
$ins = $a->insert("insert into Product(name,price,quantity,createdAt,updatedAt,status) values ('Redmi9',16000,50,'2020-02-01','2022-01-01',1)");
if($ins)
{
	echo "Last inserted record id =".$ins;
}
else
{
	echo "Can not insert record";
}
*/
# Update function call
#$upd = $a->update("update Product set name='realme'where id=1");
/*if($upd)
{
	echo "Record Updated Successfully";
}

else
{
	echo "Can not update record";
}
*/

# Delete function call
/*$del = $a->delete("delete from Product where id = 10"); 
if($del)
{

	echo "Deleted  Successfully";
}
else
{
	echo "Can not delete record";
}
*/

# Fetch function call
/*
$result = $a-> fetch("Select * from Product where id = 1");
if($result)
{
			while($row = $result->fetch_assoc()) {
	  			echo '<br> id = ' . $row['id'] . ', name = ' . $row['name']. ', price = ' . $row['price']. ', quantity = ' . $row['quantity']. ', createdAt = ' . $row['createdAt']. ', updatedAt = ' . $row['updatedAt']. ', status = ' . $row['status'];
			}
}
else
{
	echo "Can not find record";
}
*/
?>