<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Grid extends Block_Core_Template
{
	protected $collections = null;
	protected $columns = [];
	protected $actions= [];

	public function __construct()
	{
		$this->setTemplate('view/core/grid.php');
		$this->prepareCollections();
		$this->prepareColumns();
		$this->prepareActions();
	}
	public function getLogin()
	{
		return Ccc::getModel('Admin_Login')->isLoggedIn();
	}
	
	public function getColumnValue($row,$key,$column)
	{
		if ($key == 'status') 
		{
			return $row->getStatus($row->$key);
		}
		if ($key == 'base') 
		{
			return ($row->base) ?  "<img src=".$row->getBase()->getImageUrl()." alt =  'no'  height='50px' width='50px' />" : 'No Image';
		}
		if ($key == 'thumb') 
		{
			return ($row->thumb) ?  "<img src=".$row->getThumb()->getImageUrl()." alt =  'no'  height='50px' width='50px' />" : 'No Image';
		}
		if ($key == 'small') 
		{
			return ($row->small) ?  "<img src=".$row->getSmall()->getImageUrl()." alt =  'no'  height='50px' width='50px' />" : 'No Image';
		}
		return $row->$key;
	}
	public function setTitle($title)
	{
		$this->pageTitle = $title;
		return $this;	
	}

	public function getTitle()
	{
		return $this->pageTitle;	
	}

	public function prepareCollections()
	{
		return $this;
	}
	
	public function prepareColumns()
	{
		return $this;
	}
	
	public function prepareActions()
	{
		return $this;
	}

	public function setColumns(array $columns)
	{
		$this->columns = $columns;
		return $this; 
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function addColumn($key,$column)
	{
		$this->columns[$key] = $column;
		return $this;
	}

	public function getColumn($key)
	{
		if (!array_key_exists($key,$this->columns)) 
		{
			return null;
		}
		return $this->columns[$key];
	}

	public function removeColumns($key)
	{
		
		if (array_key_exists($key,$this->columns)) 
		{
			unset($key,$this->columns);
		}
		return $this;
	}
	
	public function resetColumns()
	{
		$this->columns = [];
		return $this;
	}

	public function setActions(array $columns)
	{
		$this->actions = $actions;
		return $this; 
	}

	public function getActions()
	{
		return $this->actions;
	}

	public function addAction($action,$key)
	{
		$this->actions[$key] = $action;
		return $this;
	}

	public function getAction($key)
	{
		if (!array_key_exists($key,$this->actions)) 
		{
			return null;
		}
		return $this->actions[$key];
	}

	public function removeAction($key)
	{
		
		if (array_key_exists($key,$this->actions)) 
		{
			unset($key,$this->actions);
		}
		return $this;
	}
	
	public function resetActions()
	{
		$this->actions = [];
		return $this;
	}
	
	public function setCollections(array $collections)
	{
		$this->collections = $collections;
		return $this;
	}

	public function getCollections()
	{
		return $this->collections;
	}

}