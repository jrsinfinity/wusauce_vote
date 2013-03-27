<?php

/*
Cleans up the input text and removes
leading or trailing spaces
*/
function clean_vote( $input ){
	// Trims a vote post request
	return trim( strip_tags( $input ) );
}

/*
Boolean - Checks whether a given text is a vote. 
*/
function valid_vote( $input ){
    if ( empty( $input ) ) {
        return false;
    }
    require('choices.php');
	return array_key_exists( $input , $choices );
}

/*
Returns available votes from the array
to text-to-voice optimized string
*/
function voice_choices( ){
	$voicemail = "Text the number to enter, or text help to see the choices.";
    require('choices.php');
    foreach ( $choices as $number => $choice ){
	    $voicemail .=  " Text " . $number . " for $choice.";
	}
	return $voicemail;
}


/*
Returns available votes from the array
to SMS-optimized string
*/
function sms_choices( ){
	$sms = "Text the number to vote:";
    require('choices.php');
	foreach ($choices as $number => $choice) {
	    $sms .=  " $number -> $choice, ";
	}
	return $sms;
}

/*
*  Sends a text message to a specific number via Twilio.
*  Requires a message, a registered Twilio phone number, and a recipient's phone number 
*/
function send_text( $to , $message ){
	// Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require "twilio/Services/Twilio.php";
 
    // Step 2: set AccountSid and AuthToken from www.twilio.com/user/account
    // See Readme to for details with using the Heroku shell to set these
    $AccountSid = getenv('TWILIO_ACCOUNT');
    $AuthToken = getenv('TWILIO_AUTH');

    $from = getenv('TWILIO_NUMBER');
    // Pulls the voting number from the heroku shell too
 
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
Make sure it's only digits - use this to 
store incoming numbers in teh dtabase
*/
function numeric_regex( $dirtyNumber ){
    return preg_replace( '/[^0-9.]*/','', $dirtyNumber );  
}

/*
Send a text to a user telling them that their vote is confirmed
*/
function confirm_new_vote( $number , $vote ){
    $team = $choices[ $number ];
    $message = "Your vote for " . $team . " has been recorded. Text 'Help' for all the choices.";
    return send_text( $number, $message );

}

/*
Send a text to a user telling them that their vote is updated
*/
function confirm_updated_vote( $number , $vote ){ 
    $team = $choices[ $number ];
    $message = "Your vote has been updated to " . $team . " Text 'Help' for all the choices.";
    send_text( $number , $message );

}

function send_voting_choices( $number ){
    return send_text( $number , sms_choices() );
}



/*
* Connect to DB
* Since this is Heroku, host, user, and pw are in the config file
*/
function dbOpen() {
  $url=parse_url( getenv( "CLEARDB_DATABASE_URL" ) );

    mysql_pconnect(
        $server = $url[ "host" ] ,
        $username = $url[ "user" ] ,
        $password = $url[ "pass" ] 
    );
    
    $db=substr( $url[ "path" ] , 1 );

    mysql_select_db($db);
}

?>