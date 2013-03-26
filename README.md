WUSauce Voting

====================

This is a quick voting application I built for the 2013 WUSauce Dance-Off event. Instead of using paper ballots to take votes for the winning performer, I built a Twilio app that allows people to text in a number to vote (e.g. *Text 2 for this group*). All other incoming messages are responded to with the available choices. 

This software is built on the [Text Reject PHP Twilio API]() built by [Andrew Hess](https://github.com/andhess) and [Philip Thomas](http://philipithomas.com).

## Configuration Variables

In Heroku, use the [shell configuration variables](https://devcenter.heroku.com/articles/config-vars) to see the following based on your Twilio account: 

TWILIO_ACCOUNT as the public twilio key.
TWILIO_AUTH as the private twilio key. 
TWILIO_NUMBER as the number of the Twilio application (I formatted mine as an integer)
