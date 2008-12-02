<?php

$Module = array( "name" => "Leasing price" );

$ViewList = array();
$ViewList["getprice"] = array( 	'functions' 	=> array( 'getprice' ),
								"script" 		=> "getprice.php", 
								"params" 		=> array( 	"price" ));
	
$FunctionList['getprice'] = array( );

?>
