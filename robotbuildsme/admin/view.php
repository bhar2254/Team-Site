<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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
include('../common.php');
include('../classes/dbconn.inc.php');
include('../classes/queryhelper.php');
include('../classes/robotbuildsme_entry.php');

$pageTitle = "The Robot Builds Me";
$dbh = returnDBH();
$rbmEntry;
$id = $_GET['id'];

$exists = false;
if(!empty($id))
{
    $id = htmlspecialchars(chop($id), ENT_QUOTES);
    $rbmEntry = new robotbuildsme_entry();
    $rbmEntry->setDBH($dbh);
    $rbmEntry->id = $id;
    $rbmEntry->retrieveRecordByID();
    
    $exists = $rbmEntry->doesRecordExist();
    
}

include('../base/stylehelperBase.php');
writeHtmlHead();
writeBeginningBody();
?>
<div class="row-fluid">
    <ul class="breadcrumb">
        <li><a href="/robotbuildsme/index.php">Robot Builds Me</a> <span class="divider">/</span></li>
        <li><a href="/robotbuildsme/admin/list.php">Admin - View Entries</a> <span class="divider">/</span></li>
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
                <label class="control-label">Name</label>
                <div class="controls">
                    <?= $rbmEntry->person_name; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <?= $rbmEntry->emailAddress; ?>
                </div>
            </div>
            <div class="control-group">
                
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
closeConnection($dbh);
?>
