<?php
set_time_limit(0);
require_once dirname(__FILE__).'/bootstrap.php';
//Búa til gangatengingu við gagnagrunn
$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
echo "Starting\n";
$uris = $adapter->fetchAll( 'SELECT * FROM diary_entries where visited = 0');
foreach( $uris as $uri )
{
	echo "Er að vinna með vefslóðina: " . $uri['href'] . "\n";

	//Búa til client
	$client = new Zend_Http_Client($uri['href']);

	//Hringja og fá niðurstöður
	$result = $client->request('GET');

	//Taka niðurstöður og búa til object til að gera fyrirspurnir á (HTML)
	$dom = new Zend_Dom_Query($result->getBody());

	//Query all the tags to gather the data available
	$titleNode			= $dom->query(".news-item h2");
	$title 				= $titleNode->current()->nodeValue;
	$bodyNodeList		= $dom->query(".news-item p");
	$imageLocation		= $dom->query(".news-item p a img");
	$imageHref			= $dom->query(".news-item p a");
	$images				= $dom->query("#pics a");

	//Extracting the dates out of the title and removing it from the title


	$title = substr( $title, 0, $pos + 4 );
	$date = strtotime( $date );
	$textStringFormatted = "";

	foreach( $bodyNodeList as $item ){
		if( strpos( $item->nodeValue, "Tour" ) === 0 )
		{
			$textStringFormatted .= "<h2>" . trim( $item->nodeValue ) . "</h2>";
		}
		else if( strpos( $item->nodeValue, "-" ) === 0 )
		{
			$textStringFormatted .= "<p class='reported-by'>" . trim( $item->nodeValue ) . "</p>";
		}
		else if( strlen( $item->nodeValue ) > 0 )
		{
			$textStringFormatted .= "<p>" . trim( $item->nodeValue ) . "</p>";
		}
	}

	try{
		$adapter->insert( 'diary_entry', array(
			'title'		=> trim( $title ),
			'body'		=> trim( $textStringFormatted ),
			'date'		=> $date
		));
	}
	catch( Exception $e){
		echo $title . " has malformed data";
		$adapter->update( 'diary_entries', array(
			'visited'	=> 1
		), "id = {$uri['id']}" );
		echo "-------------------------------------------------------------\n";
		continue;
	}


	$insertedID = $adapter->lastInsertId( 'diary_entry' );

	foreach( $images as $item ){
		$imageLocation = $item->getAttribute('href');
		$adapter->insert( 'diary_picture', array(
			'fullpath'	=> $imageLocation,
			'name'		=> substr(strrchr($imageLocation, "/"), 1)
		) );

		$pictureID = $adapter->lastInsertId( 'diary_picture' );

		$adapter->insert( 'diary_has_pictures', array(
			'pictures_id'	=> $pictureID,
			'diary_id'	=> $insertedID
		) );
	}

	//Finally, update the LinkCollection to set the URL as visited
	$adapter->update( 'diary_entries', array(
		'visited'	=> 1
	), "id = {$uri['id']}" );

	echo "-------------------------------------------------------------\n";
}
	