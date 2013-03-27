<?php
/*
*  call.php contains anything that is to happen if the phone number is dialed
*  Here an automated response is played
*/

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    require('application.php');
?>

<Response>
    <Say><?php echo voice_choices(); ?></Say>
</Response>
