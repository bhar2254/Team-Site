<?php
function returnDBH()
{
    $dbh = pg_connect("host=10.9.10.28 user=robotbuildsme_web password=5cit0bOr35! dbname=robot_builds_me");
    return $dbh;
}
function closeConnection(&$dbhIn)
{
    pg_close($dbhIn);
}
?>
