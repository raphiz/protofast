<?php
require_once "protofast/HTMLPage.php";
use protofast\HTMLPage;

$site = new HTMLPage();
$site->setTitle("Home");
$site->render();
