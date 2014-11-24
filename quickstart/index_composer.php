<?php
require_once "./vendor/autoload.php";
use protofast\HTMLPage;

$site = new HTMLPage();
$site->setTitle("Home");
$site->render();

?>
