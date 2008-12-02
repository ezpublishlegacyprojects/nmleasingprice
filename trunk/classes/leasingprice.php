<?php
class leasingPrice 
{
	
	function leasingPrice()
	{
		
	}
	
	function getFactor ($price) 
	{
		// initiate objects
		$leasingINI =& eZINI::instance( 'leasingprice.ini' );
		
		// get settings
		$leasingPriceNodeID				= $leasingINI->variable( 'Common', 'leasingPriceNodeID' );
		$leasingPriceClassID			= $leasingINI->variable( 'Common', 'leasingPriceClassID' );
		
		// fetch project tasks
		$params = array('ClassFilterType' 	=> 'include',
						'ClassFilterArray' 	=> array( $leasingPriceClassID ));

		$leasingPriceList =& eZContentObjectTreeNode::subTree( $params, $leasingPriceNodeID );
		
		// going through each factor-range
		foreach ($leasingPriceList as $leasingPrice) 
		{
			$leasingPriceDataMap 		= $leasingPrice->dataMap();
			$from_price					= $leasingPriceDataMap["fra_sum"]->content();
			$to_price					= $leasingPriceDataMap["til_sum"]->content();
			$factor						= $leasingPriceDataMap["faktor"]->content();
			$checkfactor = $this->checkFactor($price, $from_price, $to_price);
			if ($checkfactor == true) 
			{
				return $factor;
				die;
			}
		}
	}
	function checkFactor($checkPrice, $range_start, $range_end) 
	{
		if ( ( $checkPrice >= $range_start ) AND ( $checkPrice <= $range_end )  ) 
		{
			return true;
			
		} else {
			return false;
		}
	}
	function calculateLeasingPrice($price) {
		if ($price > 0)
		{
			$fetchfactor = $this->getFactor($price);
			$leasingprice = $price*$fetchfactor;
			$leasingprice=$leasingprice/100;
			return $leasingprice;
		} else {
			return 0;
		}
	}
}
?>