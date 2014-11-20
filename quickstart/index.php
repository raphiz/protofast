<?php
require_once "protofast/protofast.php";
use protofast\HTMLPage;

$site = new HTMLPage();
$site->setTitle("Home");
$site->render();

?>
