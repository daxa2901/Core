<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Layout extends Block_Core_Template
{
	protected $children = [];
	protected $header = null;
	protected $content = null;
	protected $footer = null;

	public function __construct()
	{
		$this->setTemplate('view/core/layout.php');
	}

	public function setChildren($children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($object,$key)
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

	public function getHeader()
	{
		$child = $this->getChild('header');
		if (!$child) 
		{
			$child = Ccc::getBlock('Core_Layout_Header');
			$this->addChild($child,'header');	
		}
		return $child;
	}
	
	public function getFooter()
	{
		$child = $this->getChild('footer');
		if (!$child) 
		{
			$child = Ccc::getBlock('Core_Layout_Footer');
			$this->addChild($child,'footer');	
		}
		return $child;
	}
	
	public function getContent()
	{
		$child = $this->getChild('content');
		if (!$child) 
		{
			$child = Ccc::getBlock('Core_Layout_Content');
			$this->addChild($child,'content');	
		}
		return $child;
	}

}