<?php
class Model_Core_Table{
	protected $table = null;
	protected $primaryKey = null;

	public function getTable()
	{
		return $this->table;
	}

	public function setTable($table)
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

	public function insert(array $data)
	{
		
	}

	public function update($id)
	{
		
	}

	public function delete($id)
	{
		if(!is_array($id))
		{
			$query = 'DELETE FROM '.$this->table.' WHERE '.$this->primaryKey.' = '.$id;
		}
		else
		{
			$query = 'DELETE FROM '.$this->table.' WHERE ';
			foreach ($id as $key => $value) 
			{
				$query = $query.$key.'='.$value;
			}	
		}
		
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

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	
}
?>