<?php

require_once("vendor/autoload.php");
include_once("controller/talk.php");

$controller = new TalkController();
$controller->display();
