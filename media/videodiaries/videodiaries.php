

<div class="container-fluid marketing">
   <?php

   
$alignRight = false;
   
   ?>
    <div class="container">
      <div class="row-fluid">
        <div data-spy="affix" class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
            <!--
          <li><a href="#1"><i class="icon-chevron-right"></i>January 23</a></li>
          <li><a href="#2"><i class="icon-chevron-right"></i>January 17</a></li>
          <li><a href="#3"><i class="icon-chevron-right"></i>January 9</a></li>
          <li><a href="#4"><i class="icon-chevron-right"></i>January 7-8</a></li>
            -->
            <?php 
            for($i=0; $i<$vidCounter; $i++)
            {
                ?>
            <li><a href="#<?=$i; ?>"><i class="icon-chevron-right"></i><?= $vidKeys[$i]; ?></a></li>
                <?php
            }
            ?>
        </ul>
      </div>
        <div class="offset3 span9">
		<div class="page-header">
			<h1><?php echo $pageTitle?></h1>
		</div>
            
                <?php
                for($i=0; $i<$vidCounter; $i++)
                {
                    ?>
            <div class="featurette <?php if($alignRight) { echo "featurette-right"; }?>" id="<?= $i; ?>">
                <div class="<?php if(!$alignRight) { echo "pull-right video"; } else { echo "pull-left"; } ?>">
                    <iframe width="640" height="360" src="http://www.youtube.com/embed/<?= $videoArray[$vidKeys[$i]]; ?>?feature=player_detailpage" ></iframe>
                </div>
               <h2 class="featurette-heading"><?= $vidKeys[$i]; ?></h2>
	      <p class="lead">Click to view the team's video diary for <?= $vidKeys[$i]; ?>.</p>
            </div>
                    <?php
                    if($alignRight == true)
                    {
                        $alignRight = false;
                    }
                    else {
                        $alignRight = true;
                    }
                    if($i != $endCount)
                    {
                        ?>
                        <hr class="featurette-divider">
                        <?php
                    }
                }
                ?>
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/.fluid-container-->
	</div><!--/Marketing-->