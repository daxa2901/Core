<?php

#Local variable which will point to value.
echo ' simple variable';
$p1 = 10; // address 1

echo '<br>';
echo $p1;

$p2 = $p1; // address 1

echo '<br>';
echo $p2;

$p2 = 20;  //address 2

echo '<br>';
echo $p2; 	//it will print 20

echo '<br>';
echo $p1;	//it will print 10


class B {
	public $price = 0;
	public $name = 10;
	public function setPrice($price)
	{
		$this->price = $price;
		return $this;
	}
	public function getPrice()
	{
		return $this->price;
	}
}


$obj = new B();


// class variable with an object
//objects are reference variable
echo 'class variable with an object'; 
$obj->price = 10;

echo '<br>';
echo $obj->price;

$obj2 = $obj; // copy

echo '<br>';
echo $obj2->price;

$obj2->price = 20;

echo '<br>';
echo $obj2->price;

echo '<br>';
echo $obj->price;

// class method with an object
echo '<br>class method with an object'; 

echo $obj->price;
echo '<br>';
print_r($obj->setPrice(20));  //obj price set to 20

echo '<br>';
echo $obj->getPrice();  // print 20

$obj2 = $obj;  // copy obj to obj2

echo '<br>';
echo $obj2->getPrice(); // print 20 

$obj2->setPrice(40);   // change price of obj2

echo '<br>';
echo $obj2->getPrice(); // print 20

echo '<br>';
echo $obj->getPrice();	// print 20

?>