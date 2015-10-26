<?php 
include('utilities.php');
// An example callback function

$a[0]='user_function';
$a[1]='user_function_one';
$class=new MyClass($a);
$class->get($a);


function user_function($a) {
    echo 'hello world From My custom! '.$a.'<br />';
    MyClass::addHTML();
}

function user_function_one($a) {
    echo 'hello world From My No.1 custom! '.$a.'<br />';
    MyClass::addHTML();
}

// An example callback method
class MyClass {

    public $arguments; 
    
    function __construct($a){
     $this->arguments=$a;  
     echo_array($a);  
    }
    
   static function myCallbackMethod($a) {
      for ($i=0;$i<count($a);$i++){
       $z[]=call_user_func($a[0],'aaaa'); 
       }
    }
    
    static function addHTML(){
    echo 'adding HTML';
    }
    
    public function get($a){
      self::myCallbackMethod($a);
    }
}


// Type 4: Static class method call (As of PHP 5.2.3)
call_user_func('MyClass::myCallbackMethod',$a);
?>
