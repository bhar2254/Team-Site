<?php
$pageTitle = "Contact Us";
$prependPath = "/var/www/robotics";
$prependCSSPath = null;

include($prependPath."/base/head.html");
include("phpmailer/class.phpmailer.php");
include("contactus.php");
include($prependPath."/base/footer.html");
?>