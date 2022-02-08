<?php
echo "Function 1: __autoload — Attempt to load undefined class<br>";
echo "<br>======================================<br>";
echo "Function 2: class_alias — Creates an alias for a class<br>";
class foo { }

class_alias('foo', 'bar');

$a = new foo;
$b = new bar;

// the objects are the same
var_dump($a == $b, $a === $b);
echo "<br>";
var_dump($a instanceof $b);
echo "<br>";

// the classes are the same
var_dump($a instanceof foo);
echo "<br>";
var_dump($a instanceof bar);
echo "<br>";

var_dump($b instanceof foo);
echo "<br>";
var_dump($b instanceof bar);
echo "<br>======================================<br>";

echo "Function 3: class_exists — Checks if the class has been defined<br>";
var_dump(class_exists('a'));
echo "<br>======================================<br>";


echo "Function 4: get_called_class — The Late Static Binding class name<br>";	

class a {
    static public function test() {
        var_dump(get_called_class());
    }
}

class b extends a {
}

a::test();
echo "<br>";
b::test();
echo "<br>======================================<br>";

echo "Function 5: get_class_methods — Gets the class methods' names<br>";

class myclass {
    // constructor
    function __construct()
    {
        return(true);
    }

    // method 1
    function myfunc1()
    {
        return(true);
    }

    // method 2
    function myfunc2()
    {
        return(true);
    }
}

$class_methods = get_class_methods('myclass');
// or
$class_methods = get_class_methods(new myclass());

foreach ($class_methods as $method_name) {
    echo "$method_name<br>";
}
echo "<br>======================================<br>";
echo "Function 6:get_class_vars — Get the default properties of the class<br>";

class My {

    var $var1; // this has no default value...
    var $var2 = "xyz";
    var $var3 = 100;
    private $var4;

    // constructor
    function __construct() {
        // change some properties
        $this->var1 = "foo";
        $this->var2 = "bar";
        return true;
    }

}

$my_class = new My();

$class_vars = get_class_vars('My');

foreach ($class_vars as $name => $value) {
    echo "$name : $value<br>";
}
echo "<br>======================================<br>";

echo "Function 7:get_class — Returns the name of the class of an object<br>";
echo get_class($my_class);
echo "<br>======================================<br>";

echo "Function 8:get_declared_classes — Returns an array with the name of the defined classes<br>";
print_r(get_declared_classes());
echo "<br>======================================<br>";

echo "Function 9: get_declared_interfaces — Returns an array of all declared interfaces<br>";
print_r(get_declared_interfaces());
echo "<br>======================================<br>";

echo "Function 10:get_declared_traits — Returns an array of all declared traits<br>";
print_r(get_declared_traits());
echo "<br>======================================<br>";

echo "Function 11: get_mangled_object_vars — Returns an array of mangled object properties
<br>";

class X
{
    public $public = 1;

    protected $protected = 2;

    private $private = 3;
}

class Y extends X
{
    private $private = 4;
}

$object = new Y;
$object->dynamic = 5;
$object->{'6'} = 6;

var_dump(get_mangled_object_vars($object));

class AO extends ArrayObject
{
    private $private = 1;
}

$arrayObject = new AO(['x' => 'y']);
$arrayObject->dynamic = 2;
echo "<br>";
var_dump(get_mangled_object_vars($arrayObject));
echo "<br>======================================<br>";

echo "Function 12: get_object_vars — Gets the properties of the given object
<br>";

class Z {
    private $a;
    public $b = 1;
    public $c;
    private $d;
    static $e;
   
    public function test() {
        var_dump(get_object_vars($this));
    }
}

$test = new Z;
var_dump(get_object_vars($test));
echo "<br>";
$test->test();
echo "<br>======================================<br>";

echo "Function 13:get_parent_class — Retrieves the parent class name for object or class<br>";
class parentClass{}
class childCLass extends parentClass{}
$c = new childCLass();
print_r(get_parent_class($c));
echo "<br>======================================<br>";

echo "Function 14:interface_exists — Checks if the interface has been defined<br>";
if (interface_exists('MyInterface')) {
    
        echo "Exists";
}
else{
	echo "Not Exists";
}
echo "<br>======================================<br>";

echo "Function 16:is_a — Checks if the object is of this class or has this class as one of its parents<br>";
class WidgetFactory
{
  var $oink = 'moo';
}

// create a new object
$WF = new WidgetFactory();

if (is_a($WF, 'WidgetFactory')) {
  echo "yes, \$WF is still a WidgetFactory\n";
}
echo "<br>======================================<br>";

echo "Function 17:is_subclass_of — Checks if the object has this class as one of its parents or implements it<br>";
class parentClass1{}
class childCLass1 extends parentClass1{}
$c = new childCLass1();
if(is_subclass_of($c, 'parentClass1')){
	echo "Exists";
}
echo "<br>======================================<br>";

echo "Function 18:method_exists — Checks if the class method exists<br>";
class Demo{

	public function myFunction()
	{
		pass;
	}
}
var_dump(method_exists('Demo','myFunction'));

echo "<br>======================================<br>";

echo "Function 19:property_exists — Checks if the object or class has a property<br>";

class myClass1 {
    public $mine;
    private $xpto;
    static protected $test;

    static function test() {
        var_dump(property_exists('myClass1', 'xpto')); //true
    }
}

var_dump(property_exists('myClass1', 'mine'));   //true
var_dump(property_exists(new myClass1, 'mine')); //true
var_dump(property_exists('myClass1', 'xpto'));   //true
var_dump(property_exists('myClass1', 'bar'));    //false
var_dump(property_exists('myClass1', 'test'));   //true
myClass1::test();
echo "<br>======================================<br>";

echo "Function 20:trait_exists — Checks if the trait exists<br>";
trait World {

    private static $instance;
    protected $tmp;

    public static function World()
    {
        self::$instance = new static();
        self::$instance->tmp = get_called_class().' '.__TRAIT__;
       
        return self::$instance;
    }

}

if ( trait_exists( 'World' ) ) {
   
    class Hello {
        use World;

        public function text( $str )
        {
            return $this->tmp.$str;
        }
    }

}

echo Hello::World()->text('!!!'); 
echo "<br>======================================<br>";
?>