<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('common.php');
include('classes/dbconn.inc.php');
include('classes/queryhelper.php');
include('classes/robotbuildsme_entry.php');
$dbh = returnDBH();
$id = $_GET['id'];
$rbmEntry;
$exists = false;
if(!empty($id))
{
    $id = htmlspecialchars(chop($id), ENT_QUOTES);
    $rbmEntry = new robotbuildsme_entry();
    $rbmEntry->setDBH($dbh);
    $rbmEntry->id = $id;
    //$rbmEntry->retrieveRecordByID();
    $rbmEntry->retrieveRecordByID();
    $exists = $rbmEntry->doesRecordExist();
    $rbmEntry->noEmail = true;
    $rbmEntry->noName = true;
    $rbmEntry->noCreatedIP = true;
    
    if($rbmEntry->approvedToBePublic == "f")
    {
        $exists = false;
    }
    
}
if(isset($_GET['jsonout']))
{
    //Than we will export or encode only as json.
    if($exists)
    {
        echo $rbmEntry->encodeToJSON();
        $rbmEntry->addViewToPost();
    }
    else
    {
        $tmpOut = array("status"=>"Record Does not exists");
        echo json_encode($tmpOut);
    }
    exit;
}
include_once('base/stylehelperBase.php');
writeHtmlHead();
writeBeginningBody();

?>
<div class="row-fluid">
    <ul class="breadcrumb">
        <li><a href="index.php">Robot Builds Me</a> <span class="divider">/</span></li>
        <li><a href="list_entries.php">View Entries</a> <span class="divider">/</span></li>
        <?php
        if($exists)
        {
            ?><li class="active"><?= $rbmEntry->personType . " - " . $rbmEntry->team_number; ?></li><?php
        }
        else
        {
            ?><li class="active">Not Found</li><?php
        }
        ?>
    </ul>
</div>
<?php
if($exists)
{
?>
<div class="row-fluid">
    <div class="span10">
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Team Number</label>
                <div class="controls">
                    <?= $rbmEntry->team_number; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Team Name</label>
                <div class="controls">
                    <?= $rbmEntry->team_name; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Location</label>
                <div class="controls">
                    <?= $rbmEntry->location; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Member Type</label>
                <div class="controls">
                    <?= $rbmEntry->personType; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Submitted Date</label>
                <div class="controls">
                    <span title="<?= $rbmEntry->createdDate; ?>"><?= $rbmEntry->returnShortDate(); ?></span>
                </div>
            </div>
            
        </div>
    </div>
    <div class="span2">
        
    </div>

</div>
<div class="row-fluid">
    <div class="span10">
        <?= $rbmEntry->entry; ?>
    </div>
</div>
<?php
}
else
{
    ?>
<div class="row-fluid">
   <div class="span12">
        Entry Not Found
    </div>
</div>
<?php
}
writeEndingBody();
writeEndingHtml();

$rbmEntry->addViewToPost();
closeConnection($dbh);
exit;
?>
