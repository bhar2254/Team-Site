<?php
$prependPath = ($_SERVER["HTTP_HOST"]=="robotics-staging"?"/var/www/robotics":"/var/www/hs/libertyrobotics");
if (isset($_GET['file'])) {
$file = $_GET['file'];
$filename = $_GET['file'];
$fsize = filesize($file);
if (file_exists($file) && is_readable($file) && preg_match('/\.pdf$/',$file)) {
header('Content-type: application/pdf');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Length: ".$fsize); 
readfile($file);
} elseif (file_exists($file) && is_readable($file) && preg_match('/\.wmv$/',$file)) {
header('Content-type: video/x-ms-wmv');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Length: ".$fsize); 
readfile($file);
} elseif (file_exists($file) && is_readable($file) && preg_match('/\.pptx$/',$file)) {
header('Content-type: application/vnd.openxmlformats-officedocument.presentationml.presentation');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Length: ".$fsize); 
readfile($file);
}

} else {
header("HTTP/1.0 404 Not Found");
echo "<h1>Error 404: File Not Found: <br /><em>$filename</em></h1>";
}
?>