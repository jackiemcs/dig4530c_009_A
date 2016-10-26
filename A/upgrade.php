<?PHP
require_once("includes/config.php");

//check if the set variable exists
if (isset($_GET['upgrade']))
{
  $functions->upgrade();
}

?>