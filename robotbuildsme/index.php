<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('common.php');

include('base/stylehelperBase.php');
$pgCustomFooterScript = "$('.myCarousel').carousel();";
$pgNavActive = "Home";
writeHtmlHead();
writeBeginningBody();
?>
    
      <!-- Jumbotron -->
      <div class="jumbotron">
          <!--<h1>Robot Builds Me!</h1>-->
          <p>
              <img src="http://www.liberty.k12.mo.us/hs/libertyrobotics/robotbuildsme/imgs/the_website_builds_me.jpg" />
          </p>
        <!--<h1>Marketing stuff!</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <a class="btn btn-large btn-success" href="#">Get started today</a>-->
      </div>

      <hr>

      <!-- Example row of columns -->
      <!--<div class="row-fluid">
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
      </div>-->
<!--      <div class="row-fluid">
          <div class="span12">
              <div id="myCarousel" class="carousel slide">
                     Carousel items 
                    <div class="carousel-inner">
                        <div class="active item">
                                  <div class="row-fluid">
                                        <div class="span4">
                                        <h2>Coach - 1764</h2>
                                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                        <p><a class="btn" href="#">View details &raquo;</a></p>
                                        </div>
                                        <div class="span4">
                                        <h2>Heading</h2>
                                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                        <p><a class="btn" href="#">View details &raquo;</a></p>
                                    </div>
                                        <div class="span4">
                                        <h2>Heading</h2>
                                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                                        <p><a class="btn" href="#">View details &raquo;</a></p>
                                        </div>
                                    </div>
                        </div>
                        <div class="item">
                            
                        </div>
                        <div class="item">
                            
                        </div>
                    </div>
                     Carousel nav 
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
          </div>
      </div>-->
      <!--<div class="row-fluid">
          <div class="span12">
              <pre>
                <?php
    include_once('classes/dbconn.inc.php');
    include_once('classes/queryhelper.php');
    include_once('classes/robotbuildsme_entry.php');
    include_once('classes/robotbuildsme_entry_collection.php');
    $dbh = returnDBH();
    $rc = new robotbuildsme_entry_collection();
    $rc->table = "entry_summary_top5";
    $rc->setDBH($dbh);
    $rc->publicOnly = true;
    $rc->generateConditionalArray();
    $rc->generateQueryFromCondArray();
    $rc->getResults();
    $eobj = $rc->getObjects(); 
        //print_r($eobj);
     $totalEntriesToRender = 3;
     $entriesToGrabPerRow = 3;
     $currentEntriesPntr = 0;
                ?>
              </pre>
          </div>
      </div>-->
<div class="row-fluid">
    <?php
    for($i=0; $i<$entriesToGrabPerRow; $i++)
    {
        $e = $eobj[$i];
        $title = $e->personType . " - " . $e->team_number;
        if($e->personType == "Other")
        {
            $title = $e->other . " - " . $e->team_number;
        }
        $link = "view_entry.php?id=" . $e->id;
        $body = $e->entry;
        $body = $e->shortenEntryText();
        ?>
        <div class="span4">
          <h2><?= $title; ?></h2>
          <p><?= $body; ?></p>
          <p><a class="btn" href="<?= $link; ?>">View details &raquo;</a></p>
        </div>
        <?php    
    }
    ?>
</div>


<?php
writeEndingBody();
writeEndingHtml();
?>

