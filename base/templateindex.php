<?php
$pageTitle = "Title";
$prependPath = ($_SERVER["HTTP_HOST"]=="robotics-staging"?"/var/www/robotics":"/var/www/hs/libertyrobotics");
$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);

include($prependPath."/base/head.html");
include("templatepage.php");
include($prependPath."/base/footer.html");
?>