<?php
$pageTitle = $_GET["title"];
$prependPath = "/var/www/robotics";
$prependCSSPath = null;

include($prependPath."/base/head.html");
include($prependPath."/media/galleries/" . $_GET["gallery"] . ".php");
include($prependPath."/base/footer.html");
?>