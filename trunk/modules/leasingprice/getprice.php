<?php

include_once( "kernel/common/template.php" );
include_once( "extension/nmleasingprice/classes/leasingprice.php" );

// initiate objects
$tpl 		=& templateInit();
$module =& $Params["Module"];
$http 		=& eZHTTPTool::instance();
$leasingprice = new leasingPrice;

// get params
$price		= $Params['price'];

// set data in template

$tpl->setVariable( "price", $price);
$tpl->setVariable( "leasingprice", $leasingprice->calculateLeasingPrice($price));

$Result['content'] =& $tpl->fetch( "design:leasingprice/getprice.tpl" );
$pathArray[] = array('text' => 'Tekst', 'url' => false);
$Result['path'] =  $pathArray;



?>