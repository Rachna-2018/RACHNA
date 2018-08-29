<?php

$method = $_SERVER['REQUEST_METHOD'];
//process only when method id post
if($method == 'POST')
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$com = $json->queryResult->parameters->command;
	$com = strtolower($com);
	
		
	if ($com == 'locality')
	{
		$ENT_ROOM= $json->queryResult->parameters->ENT_ROOM;
		$ENT_ROOM= strtoupper($ENT_ROOM);
		$ENT_LOC= $json->queryResult->parameters->ENT_LOC;
		$ENT_LOC= strtoupper($ENT_LOC);
		$ENT_OP= $json->queryResult->parameters->ENT_OP;
		$ENT_OP= strtoupper($ENT_OP);
		$ROOMS= $json->queryResult->parameters->ROOMS;
		//$ROOMS = strtoupper($ROOMS);
		if($ENT_ROOM == "") {$ENT_ROOM = 'BEDROOM';}
		if($ENT_LOC == "") {$ENT_LOC = 'LOCATION';}
		if($ENT_OP == "") {$ENT_OP = '0';}
		//$userespnose = array("PLEASE IGNORE", "IGNORE","IGNORE IT", "ANY VALUE", "ANY" , "NO IDEA");
		//if (in_array($ROOMS, $userespnose)) {$ROOMS = 0;}
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
		//$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/HADS_2013_DYN.xsjs?ENT_OP=WHICH&ENT_LOC=LOCATION&ENT_ROOM=BEDROOM&ENT_BUILT=0&ENT_SAL=0&COMMAND=locality&AREA_NUM=0&ROOMS=5&BUILT_YEAR=0&LOWSAL=0&HIGHSAL=0";
		$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/Dyn_xsjs_chatbot.xsjs?ENT_OP=$ENT_OP&ENT_LOC='$ENT_LOC'&ENT_ROOM='$ENT_ROOM'&ENT_BUILT='0'&ENT_SAL='0'&COMMAND=$com&AREA_NUM=0&ROOMS=$ROOMS&BUILT_YEAR=0&LOWSAL=0&HIGHSAL=0";
		
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		if($ROOMS == 0) {$room_text = "Houses ";}else {$room_text = "$ROOMS bedroom houses ";}
		$speech = $room_text."are available in following metro areas : \n" ;
		foreach ($someobj["results"] as $value) 
		{
			$speech .= $value["LOCATIONS"];
			$speech .= "\r\n";
			
			
       		 }
			$speech .="\r\n\n Which metro area will you prefer to get more info\n";
	}
	else if ($com == 'gethousesal')
	{
			
		$ENT_LOC= $json->queryResult->parameters->ENT_LOC;
		$ENT_LOC= strtoupper($ENT_LOC);
		$ENT_SAL = $json->queryResult->parameters->ENT_SAL;
		$ENT_SAL= strtoupper($ENT_SAL);
		$ENT_OP= $json->queryResult->parameters->ENT_OP;
		$ENT_OP= strtoupper($ENT_OP);
		$LOWSAL= $json->queryResult->parameters->lowsal;
		$LOWSAL= strtoupper($LOWSAL);
		$HIGHSAL= $json->queryResult->parameters->highsal;
		$HIGHSAL= strtoupper($HIGHSAL);
		
		if($ENT_LOC == "") {$ENT_LOC = 'LOCATION';}
		if($ENT_OP == "") {$ENT_OP = 'MANY';}
		if($ENT_SAL =="") {$ENT_SAL = 'INCOME';}
		
		$userespnose = array("PLEASE IGNORE", "IGNORE","IGNORE IT", "ANY VALUE", "ANY" , "NO IDEA");
		if (in_array($LOWSAL, $userespnose) or in_array($HIGHSAL, $userespnose)) {$LOWSAL = 0; $HIGHSAL = 0;}
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
		//$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/HADS_2013_DYN.xsjs?ENT_OP=HOW%20MANY&ENT_LOC=LOCATION&ENT_ROOM=0&ENT_BUILT=0&ENT_SAL=EARN&COMMAND=gethousesal&AREA_NUM=0&ROOMS=0&BUILT_YEAR=0&LOWSAL=15000&HIGHSAL=20015";
    		$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/Dyn_xsjs_chatbot.xsjs?ENT_OP='$ENT_OP'&ENT_LOC='$ENT_LOC'&ENT_ROOM='0'&ENT_BUILT='0'&ENT_SAL='$ENT_SAL'&COMMAND=$com&AREA_NUM=0&ROOMS=0&BUILT_YEAR=0&LOWSAL=$LOWSAL&HIGHSAL=$HIGHSAL";
		
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		//$speech = "houses are available in metro areas $json" ;
		foreach ($someobj["results"] as $value) 
		{
			$speech .= $value["HOUSE_COUNT"]. " houses available in ".$value["METRO3"]." area";
			$speech .= "\r\n";
			
			
       		 }
		$speech .="\r\n\n Which area will you prefer to get more info\n";
	}
	else if ($com == 'getcount')
	{
		$ENT_ROOM= $json->queryResult->parameters->ENT_ROOM;
		$ENT_ROOM= strtoupper($ENT_ROOM);
		$ENT_LOC= $json->queryResult->parameters->ENT_LOC;
		$ENT_LOC= strtoupper($ENT_LOC);
		$ENT_OP= $json->queryResult->parameters->ENT_OP;
		$ENT_OP= strtoupper($ENT_OP);
		$ENT_BUILT= $json->queryResult->parameters->ENT_BUILT;
		$ENT_BUILT= strtoupper($ENT_BUILT);
		$ROOMS= $json->queryResult->parameters->ROOMS;
		$AREA_NUM= $json->queryResult->parameters->AREA_NUM;
		$BUILT_YEAR= $json->queryResult->parameters->BUILT_YEAR;
		$LOWSAL= $json->queryResult->parameters->lowsal;
		$HIGHSAL= $json->queryResult->parameters->highsal;
		$ENT_SAL = $json->queryResult->parameters->ENT_SAL;
		$ENT_SAL= strtoupper($ENT_SAL);
		
		if($ENT_SAL =="") {$ENT_SAL = 'INCOME';}
		if($ENT_ROOM == "") {$ENT_ROOM = 'BEDROOM';}
		if($ENT_LOC == "") {$ENT_LOC = 'LOCATION';}
		if($ENT_OP == "") {$ENT_OP = 'MANY';}
		if($ENT_BUILT == "") {$ENT_BUILT = 'BUILT';}
				
		$AREA_NUM= strtoupper($AREA_NUM);
		$ROOMS= strtoupper($ROOMS);
		$BUILT_YEAR= strtoupper($BUILT_YEAR);
			
		$LOWSAL=strtoupper($LOWSAL);
		$HIGHSAL=strtoupper($HIGHSAL);
		
		$userespnose = array("PLEASE IGNORE", "IGNORE","IGNORE IT", "ANY VALUE", "ANY" , "NO IDEA");
		if (in_array($AREA_NUM, $userespnose)) {$AREA_NUM = 0;}
		if (in_array($ROOMS, $userespnose)) {$ROOMS = 0;}
		if (in_array($BUILT_YEAR, $userespnose)) {$BUILT_YEAR = 0;}
		if (in_array($LOWSAL, $userespnose) or in_array($HIGHSAL, $userespnose)) {$LOWSAL = 0; $HIGHSAL = 0;}
		
		if($LOWSAL == "" or $HIGHSAL == "") {$LOWSAL = 0; $HIGHSAL = 0;}
			
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
		$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/Dyn_xsjs_chatbot.xsjs?ENT_OP='$ENT_OP'&ENT_LOC='$ENT_LOC'&ENT_ROOM='$ENT_ROOM'&ENT_BUILT='$ENT_BUILT'&ENT_SAL='$ENT_SAL'&COMMAND=getcount&AREA_NUM=$AREA_NUM&ROOMS=$ROOMS&BUILT_YEAR=$BUILT_YEAR&LOWSAL=$LOWSAL&HIGHSAL=$HIGHSAL";
		
		//$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/HADS_2013.xsjs?cmd=$com&getRooms=$room&getBuilt=$year&getLoc=$loc";
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		 $area_text = " in $AREA_NUM metro area location";
		 $year_text = " built in $BUILT_YEAR year ";
		 $room_text = " having $ROOMS bedrooms ";
		$sal_text = " who earns between $LOWSAL and $HIGHSAL";
		if($AREA_NUM == 0 AND $BUILT_YEAR == 0 AND $ROOMS == 0)
		{
			$display_text = "";
		}
		else if($AREA_NUM != 0 AND $BUILT_YEAR != 0 AND $ROOMS != 0)
		{
			$display_text = $area_text.$year_text.$room_text;
		}
		else if($AREA_NUM != 0 AND $BUILT_YEAR == 0 AND $ROOMS == 0)
		{
			$display_text = $area_text;
		}
		else if($AREA_NUM == 0 AND $BUILT_YEAR != 0 AND $ROOMS == 0)
		{
			$display_text = $year_text;
		}
		else if($AREA_NUM == 0 AND $BUILT_YEAR == 0 AND $ROOMS != 0)
		{
			$display_text = $room_text;
		}
		else if($AREA_NUM != 0 AND $BUILT_YEAR != 0 AND $ROOMS == 0)
		{
			$display_text = $area_text.$year_text;
		}
		else if($AREA_NUM == 0 AND $BUILT_YEAR != 0 AND $ROOMS != 0)
		{
			$display_text = $year_text.$room_text;
		}
		else if($AREA_NUM != 0 AND $BUILT_YEAR == 0 AND $ROOMS != 0)
		{
			$display_text = $area_text.$room_text;
		}
		if($HIGHSAL == 0 and $LOWSAL == 0) {$sal_text = " "; }
		$display_text .= $sal_text;
		foreach ($someobj["results"] as $value) 
		{
			
			$speech = $value["AVAILCOUNT"]." houses are available " .$display_text;
			
			
			
       		 }
	}
	else if($com == 'closedeal')
	{
		$Emailid = $json->queryResult->parameters->Emailid;
		$rooms = $json->queryResult->parameters->ROOMS;
		$builtyear = $json->queryResult->parameters->BUILT_YEAR;
		$name = $json->queryResult->parameters->name;
		$area_num = $json->queryResult->parameters->AREA_NUM;
		$app_date = $json->queryResult->parameters->app_date;
		$app_time = $json->queryResult->parameters->app_time;
		
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
    		$json_url    = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/deal_info.xsjs?COMMAND=$com&EMAIL=$Emailid&CUST_NAME=$name&AREA_NUM='$area_num'&ROOMS='$rooms'&BUILT_YEAR='$builtyear'&APP_DATE=$app_date&APP_TIME=$app_time";
		$app_date = date_create($app_date);
		$app_time = date_create($app_time);
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		
		foreach ($someobj["results"] as $value) 
		{
			//$speech .= $value["DEAL_NO"]. "  ".$value["EMAIL"]."  ".$value["CUST_NAME"]. "  ".$value["AREA_NUM"]. "  ".$value["ROOMS"]. "  ".$value["BUILT_YEAR"];
			//$speech .= "\r\n";
			$speech = $value["CUST_NAME"].", Your appointment has booked with booking id ".$value["DEAL_NO"]." on ".date_format($app_date,'l jS \of F Y')." at ".date_format($app_time,'h:i:s A');
				$speech .= "\r\n Other details will be sent on Email\r\n";
			
			
       		}	
	}
	else if ($com == 'chkfamily')
	{
		$Family_num= $json->queryResult->parameters->Familynumber;
		
		$ROOMS= $json->queryResult->parameters->ROOMS;
		
		if ($Family_num >= 10)
		{ $rm = 8;}
		else if($Family_num >= 8)
		{ $rm = 7;}
		else if($Family_num >= 6)
		{ $rm = 5;}
		else if($Family_num >=4)
		{$rm = 4;}
		else {$rm = 3;}
		$json->queryResult->parameters->ROOMS = $rm;
		$VRoom = $rm;
		
			$speech = "I would suggest $VRoom BHK house for you.";
			$speech .= "\r\n";
			
			
       		
	
	}
	else if($com == 'getschool')
	{
		$AGE1 = $json->queryResult->parameters->AGE1;
		$AGE2 = $json->queryResult->parameters->AGE2;
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
    		$json_url    = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/deal_info.xsjs?COMMAND=$com&EMAIL=$Emailid&CUST_NAME=$name&AREA_NUM='$area_num'&ROOMS='$rooms'&BUILT_YEAR='$builtyear'&APP_DATE=$app_date&APP_TIME=$app_time";
		$app_date = date_create($app_date);
		$app_time = date_create($app_time);
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		
		foreach ($someobj["results"] as $value) 
		{
			//$speech .= $value["DEAL_NO"]. "  ".$value["EMAIL"]."  ".$value["CUST_NAME"]. "  ".$value["AREA_NUM"]. "  ".$value["ROOMS"]. "  ".$value["BUILT_YEAR"];
			//$speech .= "\r\n";
			$speech = $value["CUST_NAME"].", Your appointment has booked with booking id ".$value["DEAL_NO"]." on ".date_format($app_date,'l jS \of F Y')." at ".date_format($app_time,'h:i:s A');
				$speech .= "\r\n Other details will be sent on Email\r\n";
			
			
       		}
		
	}
	
	$response = new \stdClass();
    	$response->fulfillmentText = $speech;
    	$response->source = "webhook";
	echo json_encode($response);

}
else
{
	echo "Method not allowed";
}

?>
