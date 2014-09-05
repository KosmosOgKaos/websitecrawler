<?php

	require_once dirname(__FILE__).'/bootstrap.php';
	set_time_limit(0);
	$searchQueries = array("http://www.officialcharts.com/all-the-number-ones-singles-list/_/1960/",
	);
	
	foreach( $searchQueries as $query )
	{
		//Búa til client
		$client = new Zend_Http_Client( $query );
	
		//Hringja og fá niðurstöður
		$result = $client->request('GET');
	
		//Taka niðurstöður og búa til object til að gera fyrirspurnir á (HTML)
		$dom = new Zend_Dom_Query($result->getBody());
	
		//Niðurstöður sem byggja á öllum a inni í divum
		$nodeList = $dom->query("table.chart > tr.entry");
		
		//Búa til db adapter
		$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
		
		foreach ($nodeList as $item)
		{
			$dateString = $item->childNodes->item(0)->nodeValue;
			$year = substr($dateString, 6, 4 );
			$month = substr($dateString, 3, 2 );
			$day = substr( $dateString, 1, 2 );
			$reversedDate = "$year-$month-$day";
			
			$adapter->insert("TopChart", array(
				'first_on_list'	=> $reversedDate,
				'performer' 	=> strtolower($item->childNodes->item(2)->nodeValue),
				'song'			=> strtolower($item->childNodes->item(4)->nodeValue),
				'weeks'			=> $item->childNodes->item(6)->nodeValue
			) );
		}
	}