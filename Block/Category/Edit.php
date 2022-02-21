<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit.php');
	}

	public function getCategory()
	{
		return $this->getData('category');
	}

	public function getCategoryPathPair()
	{
        global $adapter;
        $categoryPathPair = $adapter->fetchPair('SELECT categoryId,categoryPath FROM Category');
		return $categoryPathPair;
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