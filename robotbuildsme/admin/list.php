<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once('../common.php');

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
include('../classes/robotbuildsme_entry_collection.php');

$dbh = returnDBH();

$rbmcoll = new robotbuildsme_entry_collection();
$rbmcoll->setDBH($dbh);
//$rbmcoll->publicOnly = true;
$rbmcoll->generateConditionalArray();
$rbmcoll->generateQueryFromCondArray();
$rbmcoll->getResults();

$rc = $rbmcoll->getObjects();
$pgCustomFooterScript = '   $(\'a.ajaxlink\').bind(\'click\', function(event) {
                            event.preventDefault();
                            $.get(this.href,{}, function(response) {
                                   responseFunction(response,event);
                                });
                            });
                        $(\'a.ajaxlinkjson\').bind(\'click\', function(event) {
                            event.preventDefault();
                            $.get(this.href,{}, function(response) {
                                   responseFunction(response,event);
                                },\'json\');
                            });';
include('../base/stylehelperBase.php');
writeHtmlHead();
writeBeginningBody();
?>
<div class="row-fluid">
    <ul class="breadcrumb">
        <li><a href="/robotbuildsme/index.php">Robot Builds Me</a> <span class="divider">/</span></li>
        <li class="active"><a href="/robotbuildsme/admin/list.php">Admin - View Entries</a> <span class="divider">/</span></li>

    </ul>
</div>
<?php
if(count($rc) > 0)
{
    ?>
    <div class="row-fluid">
    <div class="span10">
        <?php
        foreach($rc as $rbm)
        {
            $link = "view.php?id=" . $rbm->id;
            $editLnk = "edit.php?id=" . $rbm->id;
            $svcLnk;
            $svcTxt;
            if($rbm->approvedToBePublic = "t")
            {
                $svcLnk = "svc.php?id=" . $rbm->id . "&command=unpublish";
                $svcTxt = "Retract";
            }
            else
            {
                $svcLnk = "svc.php?id=" . $rbm->id . "&command=publish";
                $svcTxt = "Publish";
            }
        ?>
        <div class="row-fluid">
            <div class="span9">
                <h3><?= $rbm->personType; ?> - <?= $rbm->person_name; ?> - <?= $rbm->team_number; ?></h3>
                <div>(<?= $rbm->returnShortDate(); ?>)</div>
                <p><?= $rbm->shortenEntryText(); ?></p>
                <p><a class="btn" href="<?= $link; ?>">View details &raquo;</a> 
                    <a class="btn" href="<?= $editLnk; ?>">Edit entry</a>
                    <a class="btn ajaxlinkjson" href="<?= $svcLnk; ?>"><?= $svcTxt; ?></a>
                </p>
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
}
else
{
    ?>

    <?php
}
?>
<script type="text/javascript">
function responseFunction(dataIn, evtIn)
{
    var objNode = evtIn.currentTarget;
    var stateSet = dataIn.state;
    if(stateSet == "published")
    {
        var linkurl = "svc.php?id=" + dataIn.id + "&command=unpublish";
        $(objNode).html("Retract");
        //$(objNode).href = linkurl;
        $(objNode).attr('href', linkurl);
        
    }
    else
    {
        var linkurl = "svc.php?id=" + dataIn.id + "&command=publish";
        $(objNode).html("Publish");
        //$(objNode).href = linkurl;
        $(objNode).attr('href', linkurl);
    }
    //alert(dataIn);
}
</script>
<?php
writeEndingBody();
writeEndingHtml();

closeConnection($dbh);
?>