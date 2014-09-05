<?php
require_once dirname(__FILE__).'/bootstrap.php';
set_time_limit(0);
$searchQueries = array(
	"http://whalewatching.is/whale-diary-archive/2014/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/2.aspx",
	"http://whalewatching.is/whale-diary-archive/2014/1.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/12.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/11.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/10.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/2.aspx",
	"http://whalewatching.is/whale-diary-archive/2013/1.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/12.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/11.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/10.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/2.aspx",
	"http://whalewatching.is/whale-diary-archive/2012/1.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/12.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/11.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/10.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/2.aspx",
	"http://whalewatching.is/whale-diary-archive/2011/1.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/12.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/11.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/10.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/2.aspx",
	"http://whalewatching.is/whale-diary-archive/2010/1.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/12.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/11.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/10.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/2.aspx",
	"http://whalewatching.is/whale-diary-archive/2009/1.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/12.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/11.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/10.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/9.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/8.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/7.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/6.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/5.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/4.aspx",
	"http://whalewatching.is/whale-diary-archive/2008/3.aspx",
	"http://whalewatching.is/whale-diary-archive/2007/10.aspx"
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
		$adapter->insert('diary_entries', array(
			'href' => 'http://www.whalewatching.is' . $item->getAttribute('href')
		));
		echo "Inserted weblink: " . $item->getAttribute('href') . " into database\n";
	}
}