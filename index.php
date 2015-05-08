<?php
$pageTitle = "Home";
$prependPath = "/var/www/robotics";
$prependCSSPath = null;

include($prependPath."/base/head.html");
include($prependPath."/media/videodiaries/vid-diary-index.php");
include($prependPath."/carousel.php");
include($prependPath."/base/footer.html");
?>