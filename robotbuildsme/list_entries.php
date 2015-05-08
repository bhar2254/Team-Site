<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('common.php');
//We will get the robot builds me stuff.  Then we will attend to the page renderings.
include('classes/dbconn.inc.php');
include('classes/queryhelper.php');
include('classes/robotbuildsme_entry.php');
include('classes/robotbuildsme_entry_collection.php');
$dbh = returnDBH();

$rbmc = new robotbuildsme_entry_collection();
$rbmc->setDBH($dbh);
$rbmc->publicOnly = true;
$totalEntCount = 0;

$teamnumber = htmlspecialchars(chop($_POST['teamnumber']), ENT_QUOTES);
$personType = htmlspecialchars(chop($_POST['personType']), ENT_QUOTES);
$entry = htmlspecialchars(chop($_POST['entry']),ENT_QUOTES);

$rbmc->teamnumber = $teamnumber;
$rbmc->personType = $personType;
$rbmc->entry = $entry;

$rbmc->generateCountQuery();
$rbmc->executeCountQuery();
$totalEntCount = $rbmc->numrows;

$pageItemLimit = 20;
$pageNum = 1;
$rbmc->limitResultsTo = $pageItemLimit;
$rbmc->softbystr = "\"createdDate\" DESC";
if(!empty($_GET['pagenum']))
{
    $pageNum = $_GET['pagenum'];
}
$rbmc->generateConditionalArray();
$rbmc->generateQueryFromCondArray();
$rbmc->getResults();

$rc = $rbmc->getObjects();
if(isset($_GET['jsonout']))
{
    if(count($rc) > 0)
    {
        $jsonOut = "{\"entries\":[";
        $ekc = count($rc) - 1;
        for($i=0; $i<count($rc); $i++)
        {
            //Now that we have a good loop.
            $r = $rc[$i];
            $r->noEmail = true;
            $r->noLocation = true;
            $r->noCreatedIP = true;
            $r->noName = true;
            $jsonOut .= $r->encodeToJSON();
            if($i != $ekc)
            {
                $jsonOut .= ",";
            }
            
        }
        $jsonOut .= "]}";
        echo $jsonOut;
    }
    else
    {
        
    }
    exit;
}
include_once('base/stylehelperBase.php');


$pgTitle = "Robot Builds Me | View Entries";
$pgNavActive = "View";

writeHtmlHead();
writeBeginningBody();
?>
<div class="row-fluid">
    <div class="span10">
        <?php
        foreach($rc as $rbm)
        {
            $link = "view_entry.php?id=" . $rbm->id;
        ?>
        <div class="row-fluid">
            <div class="span9">
                <h3><?= $rbm->personType; ?> - <?= $rbm->team_number; ?></h3>
                <div>(<?= $rbm->returnShortDate(); ?>)</div>
                <p><?= $rbm->shortenEntryText(); ?></p>
                <p><a class="btn" href="<?= $link; ?>">View details &raquo;</a></p>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>
    <div class="span3">
        
    </div>
</div>
<?php
writeEndingBody();
writeEndingHtml();
?>
