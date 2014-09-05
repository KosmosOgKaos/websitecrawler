<?php
	set_time_limit(0);
	require_once dirname(__FILE__).'/bootstrap.php';
	//Búa til gangatengingu við gagnagrunn
	$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
	echo "Starting\n";
	$uris = $adapter->fetchAll( 'SELECT * FROM Location');
	foreach( $uris as $uri )
	{	
		$url = "http://is.visiticeland.com/Leitarnidurstodur/Skodaferdathjonustu/" . $uri['safename'];	
		echo "Er að vinna með vefslóðina: " . $url . "\n";
		
		$adapter->insert('LinkCollection', array( 	
				'href' => $url,
				'id_location' => $uri['id']
			));
	}