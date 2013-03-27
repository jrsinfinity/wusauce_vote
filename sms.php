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

require_once( 'application.php' );

// securely parse input.
$from = (string)numeric_regex( $_REQUEST[ 'From' ] );  // SENDER (their number)
$message =  (string)clean_vote( $_REQUEST[ 'Body' ] );
// This is the heart of the whole application!
if ( valid_vote( $message ) ){
	vote( $from, $message); 
}
elseif ( !empty($from) ){ 
	send_voting_choices( $from );
} else {
	// no number specified - incorrect API call
	exit();
}


?>