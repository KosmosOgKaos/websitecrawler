<?php
	set_time_limit(0);
	require_once dirname(__FILE__).'/bootstrap.php';
	//Búa til gangatengingu við gagnagrunn
	$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
	echo "Starting\n";
	$uris = $adapter->fetchAll( 'SELECT * FROM LinkCollection WHERE visited = FALSE');
	foreach( $uris as $uri )
	{		
		echo "Er að vinna með vefslóðina: " . $uri['href'] . "\n";
		//Byrja á því að athuga hvort gögnin séu nú þegar til í gagnagrunninum.
		$locationTemp = $adapter->fetchRow( 
			'SELECT location_id 
			FROM LocationTranslate 
			WHERE location_id = ' .$uri['id_location'] . '
			AND region = "is_IS"');
		
		if( !$locationTemp['location_id'] > 0 ){
			//Búa til client
			$client = new Zend_Http_Client($uri['href']);
			
			//Hringja og fá niðurstöður
			$result = $client->request('GET');
			
			//Taka niðurstöður og búa til object til að gera fyrirspurnir á (HTML)
			$dom = new Zend_Dom_Query($result->getBody());
			
			//Query all the tags to gather the data available
			$nameNodeList 		= $dom->query("h1");
			$name 				= $nameNodeList->current()->nodeValue;
		
			echo "Fyrirtækið / staðurinn heitir: $name\n";
			
			$textNodeList			= $dom->query("div.service-view div p");
			$textStringFormatted = "";
			foreach( $textNodeList as $item ){
				$textStringFormatted .= "<p>" . trim( $item->nodeValue ) . "</p>";
			}

			$adapter->insert( 'LocationTranslate', array(
				'location_id'	=>	$uri['id_location'],
				'region'		=>	'is_IS',
				'name'			=> trim( $name ),
				'description'	=> $textStringFormatted,
				'source_url'	=> $uri['href']
			) );
			echo "Set inn location translate gögn í gagnagrunn.\n";

			echo "-------------------------------------------------------------\n";
			
		}
		else
		{
			echo "Þessi vefslóð er nú þegar til í gagnagrunninum\n";
			echo "-------------------------------------------------------------\n";
			
		}	
		
		//Finally, update the LinkCollection to set the URL as visited
		$adapter->update( 'LinkCollection', array(
				'visited'	=> TRUE
			), "id = {$uri['id']}" );
	}
	