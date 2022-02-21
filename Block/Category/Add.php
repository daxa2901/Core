<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Add extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/add.php');
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