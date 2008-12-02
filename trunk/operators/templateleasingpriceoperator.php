<?php

include_once( "extension/nmleasingprice/classes/leasingprice.php" );

class TemplateLeasingPriceOperator
{
    /*!
      Konstruktor, gjør i utgangspunktet ingenting.
    */
    function TemplateLeasingPriceOperator()
    {
    }

    /*!
     
eturn an array with the template operator name.
    */
    function operatorList()
    {
        return array( 'leasing' );
    }
    /*!
     \return true to tell the template engine that the parameter list exists per operator type,
             this is needed for operator classes that have multiple operators.
    */
    function namedParameterPerOperator()
    {
        return true;
    }    /*!
     See eZTemplateOperator::namedParameterList
    */
    function namedParameterList()
    {
        return array( 'leasing' => array(  ) );
    }
    /*!
     Eksekverer PHP-funksjonen for operatoren cleanup og modifiserer \a $operatorValue.
    */
    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
    	// initiate objects
		$leasingPrice = new leasingPrice;
		
		// get progress
		$progress = $leasingPrice->calculateLeasingPrice($operatorValue);
		
		// assign progress to operator value
		$operatorValue = $progress;
    }
}

?>
