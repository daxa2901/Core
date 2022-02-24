<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 
class Model_Core_Row
{

	protected $data = [];
	protected $resourceClassName= null;

	public function __construct()
	{
		
	}
	
	public function setResourceClassName($resourceClassName)
	{
		$this->resourceClassName = $resourceClassName;
		return  $this;
	}

	public function getResourceClassName()
	{
		return $this->resourceClassName;
	}
	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function resetData()
	{
		$this->data = [];
		return $this;
	}

	public function __set($key,$value)
	{
		$this->data[$key] = $value;
		return $this;	
	}

	public function __get($key)
	{
		if(!array_key_exists($key,$this->data))
		{
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		if(array_key_exists($key,$this->data))
		{
			unset($this->data[$key]);
		}
		return $this;
	}

	public function getResource()
	{
		return Ccc::getModel($this->getResourceClassName());
	}

	public function save()
	{
		if(array_key_exists($this->getResource()->getPrimaryKey(),$this->data))
		{
			$id = $this->data[$this->getResource()->getPrimaryKey()]; 
			unset($this->data[$this->getResource()->getPrimaryKey()]); 
			$this->getResource()->update($this->data,$id);
		}
		else
		{
			$id = $this->getResource()->insert($this->data);
		}
		return $id;
	}

	public function delete()
	{
		if(!array_key_exists($this->getResource()->getPrimaryKey(),$this->data))
		{
			return false;
		}
		$id =$this->data[$this->getResource()->getPrimaryKey()];
		return $this->getResource()->delete($id);

	}

	public function fetchAll($query)
	{
		$rows = $this->getResource()->fetchAll($query);
		if(!$rows)
		{
			return $rows;	
		}
		foreach ($rows as &$row) 
		{
			$row = (new $this())->setData($row)	;
		}
		return $rows;
	}

	public function fetchRow($query)
	{
		$row = $this->getResource()->fetchRow($query);
		if(!$row)
		{
			return $row;
		}
		return (new $this())->setData($row);
		
	}

	public function load($id,$column = null)
	{
		if(!$column)
		{
			$column= $this->getResource()->getPrimaryKey();
		}
		return $this->fetchRow("SELECT * FROM ".$this->getResource()->getTableName(). " WHERE ".$column." = ".$id);
	}
}
