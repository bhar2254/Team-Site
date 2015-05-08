<?php

/*
 * This is the ajax service which will do simple ajax actions for publishing entries.
 */
session_start();
    if(isset($_SESSION['userobj']))
    {
        $u = unserialize($_SESSION['userobj']);
        
    }
    else
    {
        echo "Please login to the site";
        session_destroy();
        exit;
    }

include('../classes/dbconn.inc.php');
include('../classes/queryhelper.php');
include('../classes/robotbuildsme_entry.php');
include('../classes/robotbuildsme_entry_comment.php');
include('../classes/robotbuildsme_entry_collection.php');

$dbh =  returnDBH();
//This is a test of the record.
$id = $_GET['id'];
$command = $_GET['command'];

if($id)
{
    $id = htmlspecialchars(chop($id), ENT_QUOTES);
    
}
$jsonOut = array();

$jsonOut['responseCode'] = "error";
switch($command)
{
    case "publish" :
        if($id)
        {
            $rbm = new robotbuildsme_entry();
            $rbm->setDBH($dbh);
            $rbm->id = $id;
            $rbm->publishItem();
            $jsonOut['responseCode'] = "success";
            $jsonOut['id'] = $rbm->id;
            $jsonOut['state'] = "published";
            //$jsonOut['debug'] = (string)var_export($rbm,true);
            //var_dump($rbm);
        }
        break;
    case "unpublish" :
        if($id)
        {
            $rbm = new robotbuildsme_entry();
            $rbm->setDBH($dbh);
            $rbm->id = $id;
            $rbm->retractItem();
            $jsonOut['responseCode'] = "success";
            $jsonOut['id'] = $rbm->id;
            $jsonOut['state'] = "retract";
            //$jsonOut['debug'] = (string)var_export($rbm,true);
            //var_dump($rbm);
            
            
            
        }
        break;
    default :
        $jsonOut['responseMessage'] = "The command not recognized";
        break;
}
echo json_encode($jsonOut);
closeConnection($dbh);
?>
