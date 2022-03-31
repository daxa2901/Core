<?php Ccc::loadClass('Model_Core_View'); ?>
<?php 
class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	protected $layout =null;

	public function __construct()
	{
	}

	public function getBlock($key)
	{
		$block = $this->getChild($key);
		if ($block) 
		{
			return $block;
		}
		$block = Ccc::getBlock($key);
		if ($block) 
		{
			$block->setLayout($this->getLayout());
			return $block;
		}
		return null;
	}
	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function setChildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($object,$key=null)
	{
		if(!$key)
		{
			$key = get_class($object);
		}
		$object->setLayout($this->getLayout());	
		$this->children[$key] = $object;
		return $this;
	}

	public function getChild($key)
	{
		if (!array_key_exists($key,$this->children)) 
		{
			return null;
		}
		return $this->children[$key];
	}

	public function removeChild($key)
	{
		
		if (array_key_exists($key,$this->children)) 
		{
			unset($key,$this->children);
		}
		return $this;
	}
	
	public function resetChildren()
	{
		$this->children = [];
		return $this;
	}

}