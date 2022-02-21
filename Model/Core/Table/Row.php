<?php Ccc::loadClass('Model_Core_Table'); ?>
<?php 
class Model_Core_Table_Row{
	protected $data = [];
	protected $tableClassName= null;

	public function setTableClassName($getTableClassName)
	{
		$this->tableClassName = $tableClassName;
		return  $this;
	}

	public function getTableClassName()
	{
		return $this->tableClassName;
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
		if(!array_key_exists($key,$this->$data))
		{
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		if(!array_key_exists($key,$this->data))
		{
			return null;
		}
		unset($this->data[$key]);
	}

	public function getTable()
	{
		return New Model_Core_table();
	}
	public function save()
	{
		 $this->getTable()->insert($data);
	}

}
