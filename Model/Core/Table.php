<?php Ccc::loadClass('Model_Core_Table_Row'); ?>
<?php 
class Model_Core_Table
{
	protected $table = null;
	protected $primaryKey = null;
	protected $rowClassName = null;

	public function getTable()
	{
		return $this->table;
	}

	public function setTableName($table)
	{
		$this->table = $table;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getRow()
	{
		return new Model_Core_Table_Row();
	}


	public function insert(array $data)
	{
		$temp = [];
		foreach ($data as $col => $value) 
		{
			$temp[$col] = "'".$value."'";	
		}
		$query = "INSERT INTO ".$this->getTable()." (".implode(',',array_keys($temp)).") VALUES (".implode(',',array_values($temp)).")";
		return $this->getAdapter()->insert($query);
	}

	public function update($data,$id)
	{
		$whereClause = null;
		$fields = null;		
		if(!is_array($id))
		{
			$whereClause = $this->getPrimaryKey() ." = '".$id."'";
		}
		else
		{
			foreach ($id as $key => $value) 
			{
				$whereClause = $whereClause . $key . " = '".$value."' and ";
			}
			$whereClause = rtrim($whereClause,' and ');

			
		}
		foreach ($data as $col => $value) 
		{
			if($col != 'parentId')
				{
					$fields = $fields . $col . " = '".$value."',";

				}
				else
				{
					$fields = $fields . $col . ' = '.$value.',';

				}
		}
		$fields = rtrim($fields,',');
		$query = "UPDATE ".$this->table." SET ".$fields." WHERE ".$whereClause;
		return $this->getAdapter()->update($query);
	}

	public function delete($id)
	{
		$whereClause = null;
		if(!is_array($id))
		{
			$whereClause = $this->primaryKey. " = '".$id."'";

		}
		else
		{
			foreach ($id as $key => $value) 
			{
				$whereClause = $whereClause . $key . " = '".$value."' and ";
			}
			$whereClause = rtrim($whereClause,' and ');
		}
		$query = 'DELETE FROM '.$this->getTable().' WHERE '.$whereClause;
		return $this->getAdapter()->delete($query);	

	}

	public function fetchRow($query)
	{
		return $this->getAdapter()->fetchRow($query);	
	}

	public function fetchAll($query)
	{
		return $this->getAdapter()->fetchAll($query);
	}

	public function load($id)
	{
		$rowData = "SELECT * FROM ".$this->getTable()."WHERE ". $this->getPrimaryKey()." = ".$id;
		if (!$rowData) {
			return false;
		}
		$row = $this->getRow();
		$row->setData($rowData);
		return $row;
	}
	
	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
}
