<?php 
#Understand the variable declaration,assignment and output with echo , print_r() and var_dup()
echo '<pre>';

$var = 'name';

$arr = [
 	'name' => 'Ak',
 	'dob' => 202012
];

class A {
 	public $price = 0;
}

$obj = new A;

echo $var;		// To directly print string or number

echo '<br>';
print_r($arr);	// To Print array or object

echo '<br>'; 	
var_dump($var); // For getting information about type of variable like int string float boolean array and object

echo '<br>';
var_dump($arr);

echo '<br>';
print_r($obj);


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


?>