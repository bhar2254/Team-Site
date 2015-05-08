<?php
include('../classes/dbconn.inc.php');
//This services will take the input and return the json encoded data.

if(!empty($_GET['teamnumber']))
{
   $dbh = returnDBH();
   $teamnumber = htmlspecialchars(chop($_GET['teamnumber']), ENT_QUOTES);
   $query = "SELECT teamnumber, teamname, location, sponsors FROM teaminfo";
   $query .= " WHERE teamnumber ='$teamnumber'";
   $exec = pg_exec($dbh, $query);
   $numrows = pg_numrows($exec);
   if($numrows > 0)
   {
       if($numrows == 1)
       {
           $res = pg_fetch_all($exec);
           $r = $res[0];
           echo json_encode($r);
       }
   }
   closeConnection($dbh); 
}

?>
