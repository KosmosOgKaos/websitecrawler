<?php
set_time_limit(0);
require_once dirname(__FILE__).'/bootstrap.php';
//Búa til gangatengingu við gagnagrunn
$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
echo "Starting\n";
$uris = $adapter->fetchAll( 'SELECT * FROM news_entries where visited = 0');
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
	$imageLocation		= $dom->query(".news-item p img");
	$images				= $dom->query("#pics a");

	$textStringFormatted = "";

	foreach( $bodyNodeList as $item ){
		if( strlen( $item->nodeValue ) > 0 )
		{
			$textStringFormatted .= "<p>" . trim( $item->nodeValue ) . "</p>";
		}
	}

	try{
		$location = $imageLocation->current();
		$adapter->insert( 'news_entry', array(
			'title'		=> trim( $title ),
			'body'		=> trim( $textStringFormatted ),
			'picture'	=> (isset( $location )) ? $imageLocation->current()->getAttribute('src') : null,
			'full_path' => (isset( $location )) ? substr(strrchr($imageLocation->current()->getAttribute('src'), "/"), 1) : null
		));
	}
	catch( Exception $e){
		echo $title . " has malformed data";
		$adapter->update( 'news_entries', array(
			'visited'	=> 1
		), "id = {$uri['id']}" );
		echo "-------------------------------------------------------------\n";
		continue;
	}


	$insertedID = $adapter->lastInsertId( 'news_entry' );

	foreach( $images as $item ){
		$imageLocation = $item->getAttribute('href');
		$adapter->insert( 'news_picture', array(
			'fullpath'	=> $imageLocation,
			'name'		=> substr(strrchr($imageLocation, "/"), 1)
		) );

		$pictureID = $adapter->lastInsertId( 'news_picture' );

		$adapter->insert( 'news_has_pictures', array(
			'pictures_id'	=> $pictureID,
			'news_id'	=> $insertedID
		) );
	}

	//Finally, update the LinkCollection to set the URL as visited
	$adapter->update( 'news_entries', array(
		'visited'	=> 1
	), "id = {$uri['id']}" );

	echo "-------------------------------------------------------------\n";
}
