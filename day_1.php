<?php 
#Understand the variable declaration,assignment and output with echo , print_r() and var_dup()
echo '<pre>';

$var = 'name';

$arr = [
 	'name' => 'Ak',
 	'dob' => 202012
];

echo $var;		// To directly print string or number
echo '<br>';
print_r($arr);	// To Print array or object

echo '<br>'; 	
var_dump($var); // For getting information about type of variable like int string float boolean array and object

 echo '<br>';
 var_dump($arr);


//Condition for false
 $var = 'name';

//There are 6 conditions which will be execute else part :- 0 , false, null , !true, '0', '', []
if($var) {
 	echo 'success';
}
else {
 	echo 'failed';
}



// Flow of program  will be in 3 part
// 1. input -> 2. process - > 3. output

// input,request,argument,param =>variable

// process,function, method, procedure, technique => method,function

// respose, return, output




// class A {
// 	public $price = 0;
// }

// $obj = new A;

// echo '<br>';
// print_r($obj);


// $p1 = 10; // a1

// echo '<br>';
// echo $p1;

// $p2 = $p1; // a1

// echo '<br>';
// echo $p2;


// $p2 = 20;  //a2

// echo '<br>';
// echo $p2;

// echo '<br>';
// echo $p1;







/*
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


echo $obj->price;

print_r($obj->setPrice(20));



echo '<br>';
echo $obj->getPrice();

$obj2 = $obj;

echo '<br>';
echo $obj2->getPrice();

$obj2->setPrice(40);


echo '<br>';
echo $obj2->getPrice();



echo '<br>';
echo $obj->getPrice();


// objects are reference variable 
// $obj->price = 10;

// echo '<br>';
// echo $obj->price;

// $obj2 = $obj; // copy

// echo '<br>';
// echo $obj2->price;

// $obj2->price = 20;

// echo '<br>';
// echo $obj2->price;


// echo '<br>';
// echo $obj->price;














?>