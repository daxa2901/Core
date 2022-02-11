<?php

class Controller_Category{
	public function gridAction()
	{
		require_once('view/category/grid.php');
	}

	public function addAction()
	{
		require_once('view/category/add.php');
	}

	public function editAction()
	{
 		require_once('view/category/edit.php');
	}

	public function saveAction()
	{
		try 
		{
			if (!isset($_POST['category'])) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			global $adapter;
			global $date;
			$row = $_POST['category'];
			$path = '';

			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				
				$query = "UPDATE Category 
				SET name='".$row['name']."',
					updatedAt='".$date."',
					status='".$row['status']."'
				WHERE categoryId='".$row['id']."'";
				$update = $adapter->update($query);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}
				$result = $this->updatePathIntoCategory($row['id'],$row['parentId']);
				
			}
			else
			{
				if ($row['parentId'] == 'NULL') 
				{
					$query = "INSERT INTO Category(name,createdAt,status) 
					VALUES('".$row['name']."',
						   '".$date."',
						   '".$row['status']."')";
				}
				else
				{
					$query = "INSERT INTO Category(name,createdAt,status,parentId) 
					VALUES('".$row['name']."',
							'".$date."',
							'".$row['status']."',
							'".$row['parentId']."')";
				}
				$insert=$adapter->insert($query);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$row=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId=".$insert);
				if ($row['parentId'] == NULL) 
				{
					$path = $insert;
				}
				else
				{
					$result=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
					$path = $result['categoryPath'].'/'.$insert;

				}
				$query = "UPDATE Category SET categoryPath = '".$path."' WHERE categoryId = ".$insert;
				$update = $adapter->update($query);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}				
			}
		$this->redirect("index.php?c=category&a=grid");
		
		} catch (Exception $e) {
			$this->redirect("index.php?c=category&a=grid");	
		}
	}
	
	public function updatePathIntoCategory($categoryId,$parentId)
	{
		global $adapter;
		global $date;

		$category=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$categoryId);
		$categoryPath=$adapter->fetchAll("SELECT * FROM Category WHERE categoryPath LIKE '".$category['categoryPath'].'/%'."' ORDER BY categoryPath");
		if($parentId == 'NULL')
		{
			$query = "UPDATE Category 
			SET parentId=".null.", 
			categoryPath= '".$categoryId."' 
			WHERE categoryId=".$categoryId;
		}
		else
		{
			$parent=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parentId);
			$query = "UPDATE Category 
			SET parentId=".$parentId.", 
			categoryPath= '".$parent['categoryPath'].'/'.$categoryId."' 
			WHERE categoryId=".$categoryId;
		}
		$update = $adapter->update($query);
		if(!$update)
		{
			throw new Exception("System is unable to update.", 1);
		}	
		foreach ($categoryPath as $row) 
		{
			$parent=$adapter->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
			$newPath = $parent['categoryPath'].'/'.$row['categoryId'];

			$query = "UPDATE Category
				SET categoryPath = '".$newPath."',
					updatedAt = '".$date."'
					WHERE categoryId = ".$row['categoryId'];
			$update = $adapter->update($query);
			if(!$update)
			{
				throw new Exception("System is unable to update.", 1);
			}	

		}
		$this->redirect("index.php?c=category&a=grid");
	}

	public function deleteAction()
	{
		try 
		{
			if (!isset($_GET['id'])) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			global $adapter;
			$id=$_GET['id'];
			$query = "DELETE FROM Category WHERE categoryId = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.", 1);
				
			}
			$this->redirect("index.php?c=category&a=grid");		
		} catch (Exception $e) {
			$this->redirect("index.php?c=category&a=grid");		
		}
			
	}

	public function redirect($url)
	{
	
		header('location:'.$url);	
		exit();			
	}


	public function errorAction()
	{
		echo "error";
	}
	public function taskAction()
	{	
		global $adapter;
		$result=$adapter->fetchOne('SELECT categoryPath FROM Category where categoryId = 149');
	}

	public function getCategoryToPath()
    {
    	global $adapter;
        $categoryName=$adapter->fetchPair('SELECT categoryId,name FROM Category');
        $categoryPath=$adapter->fetchPair('SELECT categoryId,categoryPath FROM Category');
        $categories=[];
        foreach ($categoryPath as $key => $value) 
        {
                $explodeArray=explode('/', $value);
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) 
                {
                    if(array_key_exists($value,$categoryName))
                    {
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        }
        return $categories;

    }

	
}

?>