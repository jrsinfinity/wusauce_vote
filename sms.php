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
$from = numeric_regex( $_POST[ 'From' ] );  // SENDER (their number)
$message =  clean_vote( $_POST[ 'Body' ] );

if ( valid_vote( $message ) ){
	vote( $number, $vote ); 
} else {
	send_voting_choices( $from );
}


?>