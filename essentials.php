<?php

/*
*  Sends a text message to a specific number via Twilio.
*  Requires a message, a registered Twilio phone number, and a recipient's phone number 
*/
function sendText( $from, $to, $message ){

	// Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require "twilio/Services/Twilio.php";
 
    // Step 2: set AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = <Your Twilio Account ID>;
    $AuthToken = <Your Twilio AuthToken>;
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio( $AccountSid, $AuthToken );
 
    // Step 4: make an array of people to end to.
    $sms = $client->account->sms_messages->create( 
        $from,    // our number
        $to,      // their number 
        $message  // the message being sent
    );
    return true;
}

/*
*  Make sure it's only digits
*/
function numClean( $dirtyNumber ){
    return preg_replace( '/[^0-9.]*/','', $dirtyNumber );  
}

/*
* Connect to DB
* Since this is Heroku, host, user, and pw are in the config file
*/
function dbOpen() {
  $url=parse_url( getenv( "<database name>" ) );

    mysql_pconnect(
        $server = $url[ "host" ] ,
        $username = $url[ "user" ] ,
        $password = $url[ "pass" ] 
    );
    
    $db=substr( $url[ "path" ] , 1 );

    mysql_select_db($db);
}
?>