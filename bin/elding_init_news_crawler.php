<?php
require_once dirname(__FILE__).'/bootstrap.php';
set_time_limit(0);
$searchQueries = array(
	"http://www.whalewatching.is/news/news-archive.aspx"
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
	$nodeList = $dom->query(".main-content-col .item h3 a");

	//Búa til db adapter
	$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();

	//Loopa í gegnum a til að fá href
	foreach ($nodeList as $item){
		$adapter->insert('news_entries', array(
			'href' => 'http://www.whalewatching.is' . $item->getAttribute('href')
		));
		echo "Inserted weblink: " . $item->getAttribute('href') . " into database\n";
	}
}