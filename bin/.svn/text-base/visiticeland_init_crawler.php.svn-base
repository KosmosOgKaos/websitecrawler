<?php
	require_once dirname(__FILE__).'/bootstrap.php';
	set_time_limit(0);
	$searchQueries = array( "http://visiticeland.com/SearchResults/?area=0&type=6&subtype=&keyword=By%20Keyword",
							"http://visiticeland.com/SearchResults/?area=0&type=4&subtype=&keyword=By%20Keyword",
							"http://visiticeland.com/SearchResults/?area=0&type=7&subtype=&keyword=By%20Keyword",
							"http://visiticeland.com/SearchResults/?area=0&type=1&subtype=&keyword=By%20Keyword",
							"http://visiticeland.com/SearchResults/?area=0&type=5&subtype=&keyword=By%20Keyword",
							"http://visiticeland.com/SearchResults/?area=0&type=3&subtype=&keyword=By%20Keyword" );
	
	foreach( $searchQueries as $query )
	{
		//Búa til client
		$client = new Zend_Http_Client( $query );
		
		//Hringja og fá niðurstöður
		$result = $client->request('GET');
		
		//Taka niðurstöður og búa til object til að gera fyrirspurnir á (HTML)
		$dom = new Zend_Dom_Query($result->getBody());
		
		//Niðurstöður sem byggja á öllum a inni í divum
		$nodeList = $dom->query(".search-results > div .item a.name");
		
		//Búa til db adapter
		$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
		
		//Loopa í gegnum a til að fá href
		foreach ($nodeList as $item){	
			$adapter->insert('LinkCollection', array( 	
				'href' => "http://visiticeland.com" . $item->getAttribute('href')
			));
			echo "Inserted weblink: http://visiticeland.com" . $item->getAttribute('href') . " into database\n";
		}
	}