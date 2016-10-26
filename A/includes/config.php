<?PHP
require_once("functions.php");

$functions = new functions();

//Site name here
$functions->SetWebsite('http://sulley.cah.ucf.edu/~dig4530c_009/');

//email address to get notifications
$functions->SetEmail('mybarra@knights.ucf.edu');

//Database login details here:
$functions->InitDB(
	/*hostname*/'sulley.cah.ucf.edu',
	/*username*/'dig4530c_009',
	/*password*/'knights123!',
	/*database name*/'dig4530c_009',
	/*table name*/'users'
	);

//Random String for Security
$functions->SetRandomKey('qSRcVS6DrTzrPvr');
?>