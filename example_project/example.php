<?php
require_once "../protofast.php";
use protofast\HTMLPage;

$site = new HTMLPage();

$site->setTitle("Example Page");

$site->replace("PAGE_DESCRIPTION", "This is an Example site");

// No additional stylesheets are added since protofast automagically checks
// for equally called files in the stylesheets/js directory

$site->render();

?>
