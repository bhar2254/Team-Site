<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('../classes/dbconn.inc.php');

   $dbh = returnDBH();
   $teamnumber = htmlspecialchars(chop($_GET['teamnumber']), ENT_QUOTES);
   $query = "SELECT teamnumber, teamname, location, sponsors FROM teaminfo";
   
   $exec = pg_exec($dbh, $query);
   
   $numrows = pg_num_rows($exec);
   header('Content-type: application/json');
   $outJson = array();
   $teamList = array();
   if($numrows)
   {
       $res = pg_fetch_all($exec);
       foreach($res as $r)
       {
           $teamList[] = $r;
       }
       //$r = $res[0];
       //echo json_encode($r);
   }
   $outJson['teams'] = $teamList;
   $outJson['teamcount'] = count($teamList);
   echo json_encode($outJson);
   
   closeConnection($dbh);
?>
