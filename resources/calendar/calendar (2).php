<?php
$pageTitle = "Calendar";
$prependPath = ($_SERVER["HTTP_HOST"]=="robotics-staging"?"/var/www/robotics":"/var/www/hs/libertyrobotics");
include($prependPath."/base/htmlhead.php");
include($prependPath."/base/header.php");
include($prependPath."/base/standardfunctions.php");
textSizer();
			writeTitle($pageTitle,1);
?>

<br/>
<iframe src="../gcalendar-wrapper.php?showPrint=0&amp;showCalendars=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23ddd&amp;src=student.liberty.k12.mo.us_f47mlc5mm1l8i8sarm0bk86i2c%40group.calendar.google.com&amp;color=%233366ff&amp;ctz=America%2FChicago" style=" border-width:0 " width="100%" height="600" frameborder="0" scrolling="no"></iframe>

<?php
include($prependPath."/base/footer.php");
?>