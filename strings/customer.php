<?php
class Customer
{
  private $name;

  function set_name( $value )
  {
    $this->name = $value;
  }

  function get_name()
  {
    return $this->name;
  }
}

class Logged
{
  private $obj;
  private $test;

  function __call( $method, $args )
  {
    //echo( "$method( ".join( ",", $args )." )\n" );
    
    
return call_user_func_array(array(&$this->obj,
   $method), $args );
  }

  function __construct( $obj ,$test)
  {
    $this->obj = $obj;
    echo $test;;
  }
}

$c1 = new Logged( new Customer() ,'testing.... ');
$c1->set_name( "Jack" ); //sets the name;
$name = $c1->get_name();
echo( "name = $name\n" );
?>