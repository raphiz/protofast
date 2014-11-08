<?php
require_once "../protofast.php";

$site = new HTMLPage();

$site->setTitle("Home");

$site->addStylesheet("stylesheets/specific_index.css");
$site->addScript("stylesheets/index_only.js");

$site->replace("PAGE_DESCRIPTION", "This is the index of the page");

$site->render();

?>
