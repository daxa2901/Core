<?php Ccc::loadClass('Model_Core_View'); ?>
<?php 
class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
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
			unset($ket,$this->children);
		}
		return $this;
	}
	
	public function resetChildren()
	{
		$this->children = [];
		return $this;
	}

}