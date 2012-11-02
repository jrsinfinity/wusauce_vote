<?php

/*
*  Handles incoming text messages from Twilio.
*  Retreives with POST:
*
*   From:  the number that sent the message
*   To:    the Twilio number that it was sent to
*   Body:   what the message says
*   FromCity:   the city associated with the phone number
*   FromState:  the state associated with the phone number
*/

// We need to send a good XML response to make it work with Twilio
    header( "content-type: text/xml" );
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

// essentials.php contains everything else I have provided
require_once( 'essentials.php' );

// securely parse input.
dbOpen();
$from = numClean( mysql_real_escape_string( htmlspecialchars( trim( strip_tags( $_POST[ 'From' ] ) ) ) ) );    // SENDER (their number)
$ourPhone = numClean( mysql_real_escape_string( htmlspecialchars( trim( strip_tags( $_POST[ 'To' ] ) ) ) ) );  // RECEIVER (our number)
$message = mysql_real_escape_string( htmlspecialchars( trim( strip_tags( $_POST[ 'Body' ] ) ) ) );
$city = mysql_real_escape_string( htmlspecialchars( trim( strip_tags( $_POST[ 'FromCity' ] ) ) ) );
$state = mysql_real_escape_string( htmlspecialchars( trim( strip_tags( $_POST[ 'FromState' ] ) ) ) );
mysql_close();

// We now have the incoming information

/*
*  BEGIN PHP APPLICATION
*/

// I recommend making sure you have everything before getting started...
if ( !$from || !$ourPhone || !$message ){

	// missing crucial data
	echo "Incomplete query";
	exit();
}
?>